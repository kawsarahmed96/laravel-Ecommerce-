<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ShippingAdress;
use App\Models\userDetail;
use App\Notifications\InvoicePaid;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    //checkout index

    public function checkOut()
    {

        $coupon_discount = 0.0;
        if (Session::has('applyCoupon')) {
            $coupon_discount = Session::get('applyCoupon')['coupon_discount'];
        }
        $shippingCharge = 0.0;
        if (Session::has('shippingCharge')) {
            $shippingCharge = Session::get('shippingCharge');
        }

        $cartTotal = Cart::where('user_id', Auth::id())->sum('total_price');
        return view('frontend.checkout', compact('cartTotal', 'coupon_discount', 'shippingCharge'));
    }

    // SSl Commmerz Method
    public function order(Request $request)
    {
        $couponCode = Session::has('applyCoupon') ? Session::get('applyCoupon')['coupon_code'] : null;

        if ($couponCode) {
            $coupon = Coupon::where('coupon_code', $couponCode)
                ->where('start_date', '<', Carbon::now())
                ->where('expire_date', '>', Carbon::now())->first();

            if (!$coupon) {

                return back()->redirect()->route('frontend.product.cart.list');
            }
        }

        $cartTotal  = Cart::where('user_id', Auth::id())->sum('total_price');
        $totalPrice = $cartTotal - (Session::has('applyCoupon') ? Session::get('applyCoupon')['coupon_discount'] : 0) + (Session::has('shippingCharge') ? Session::get('shippingCharge') : 0);

        $carts = Cart::with('product')->where('user_id', Auth::id())->get();

        foreach ($carts as $cart) {
            $inventory = Inventory::with('product')->where('product_id', $cart->product_id)
                ->where('color_id', $cart->color_id)
                ->where('size_id', $cart->size_id)->first();

            if ($inventory->quantity < $cart->quantity) {
                return redirect()->route('frontend.product.cart.list');
            }
        }

        $post_data                 = array();
        $post_data['total_amount'] = $totalPrice; # You cant not pay less than 10
        $post_data['currency']     = "BDT";
        $post_data['tran_id']      = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name']     = Auth::user()->name;
        $post_data['cus_email']    = Auth::user()->email;
        $post_data['cus_add1']     = 'Customer Address';
        $post_data['cus_add2']     = "";
        $post_data['cus_city']     = "";
        $post_data['cus_state']    = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country']  = "Bangladesh";
        $post_data['cus_phone']    = '8801XXXXXXXXX';
        $post_data['cus_fax']      = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name']     = "Store Test";
        $post_data['ship_add1']     = "Dhaka";
        $post_data['ship_add2']     = "Dhaka";
        $post_data['ship_city']     = "Dhaka";
        $post_data['ship_state']    = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone']    = "";
        $post_data['ship_country']  = "Bangladesh";

        $post_data['shipping_method']  = "NO";
        $post_data['product_name']     = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile']  = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";

        DB::beginTransaction();
        try {
            userDetail::create([

                'user_id' => Auth::id(),
                'phone'   => $request->billing_phone,
                'company' => $request->billing_company,
                'zipcode' => $request->billing_postcode,
                'address' => $request->billing_address_1,
                'city'    => $request->billing_city,

            ]);
            $order = Order::create([

                'user_id'         => Auth::id(),
                'transaction_id'  => $post_data['tran_id'],
                'coupon_id'       => Session::has('applyCoupon') ? Session::get('applyCoupon')['id'] : null,
                'coupon_discount' => Session::has('applyCoupon') ? Session::get('applyCoupon')['coupon_discount'] : null,
                'shipping_charge' => Session::has('applyCoupon') ? Session::get('shippingCharge') : null,
                'order_status'    => 'pending',
                'payment_status'  => 'unpaid',
                'total_price'     => $totalPrice,
                'note'            => $request->order_comments,

            ]);

            foreach ($carts as $cart) {

                OrderDetail::create([

                    'product_id' => $cart->product_id,
                    'order_id'   => $order->id,
                    'color_id'   => $cart->color_id,
                    'size_id'    => $cart->size_id,
                    'quantity'   => $cart->quantity,
                    'price'      => $cart->quantity,
                    'add_price'  => $cart->add_price,

                ]);

                $inventory = Inventory::where('product_id', $cart->product_id)
                    ->where('color_id', $cart->color_id)
                    ->where('size_id', $cart->size_id)
                    ->first();

                $inventory->update([
                    'quantity' => $inventory->quantity - $cart->quantity,
                ]);

                $cart->delete();
                $request->session()->forget('applyCoupon');
                $request->session()->forget('applyCoupon');

            }

            if ($request->shipping_phone) {
                ShippingAdress::create([

                    'order_id'      => $order->id,
                    'shipping_name' => $request->shipping_name,
                    'phone'         => $request->shipping_phone,
                    'company'       => $request->shipping_company,
                    'zipcode'       => $request->shipping_postcode,
                    'address'       => $request->shipping_address,
                    'city'          => $request->shipping_city,

                ]);

            }

            DB::commit();
        } catch (Exception $e) {

            return $e->getMessage();
            DB::rollBack();
        }

        // Mail::to(Auth::user()->email)->send(new OrderInvoice($order));

        $sslc = new SslCommerzNotification();

        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }
    }

    public function success(Request $request)
    {
        echo "Transaction is Successful";

        $tran_id = $request->input('tran_id');
        $amount  = $request->input('amount');

        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'order_status', 'payment_status', 'total_price')->first();

        if ($order_details->order_status == 'pending') {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, );

            // invoice no
            $invoice_no = 'stowaa-' . $order_details->id;

            if ($validation) {

                $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update([
                        'order_status'   => 'processing',
                        'payment_status' => 'paid',
                        'invoice_no'     => $invoice_no,
                    ]);

                $pdf = Pdf::loadView('mail.invoice', ['data' => $order_details]);

                $invoiceOutput = $pdf->output();

                $invoiceName = $order_details->id . '_invoice.pdf';

                Notification::send(Auth::user(), new InvoicePaid($invoiceOutput, $order_details, $invoiceName));

                echo "<br >Transaction is successfully Completed";
                return redirect()->route('frontend.index');
            }
        } else if ($order_details->order_status == 'processing' || $order_details->order_status == 'complete') {
            /*
            That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
             */
            echo "<br >Transaction is successfully Completed";
            return redirect()->route('frontend.index');

        } else {
            #That means something wrong happened. You can redirect customer to your product page.
            echo "Invalid Transaction";
        }
    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'order_status', 'payment_status', 'total_price')->first();

        if ($order_details->order_status == 'pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['order_status' => 'Failed']);
            echo "Transaction is Falied";
            return redirect()->route('frontend.index');

        } else if ($order_details->order_status == 'processing' || $order_details->order_status == 'complete') {
            echo "Transaction is already Successful";
            return redirect()->route('frontend.index');

        } else {
            echo "Transaction is Invalid";
        }
    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'order_status', 'payment_status', 'total_price')->first();

        if ($order_details->order_status == 'pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['order_status' => 'canceled']);
            echo "Transaction is Cancel";
            return redirect()->route('frontend.index');

        } else if ($order_details->order_status == 'processing' || $order_details->order_status == 'complete') {
            echo "Transaction is already Successful";
            return redirect()->route('frontend.index');

        } else {
            echo "Transaction is Invalid";
        }
    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('orders')
                ->where('transaction_id', $tran_id)

                ->select('transaction_id', 'order_status', 'payment_status', 'total_price')->first();

            if ($order_details->order_status == 'pending') {
                $sslc       = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount);
                if ($validation == true) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                     */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['order_status' => 'processing']);

                    echo "Transaction is successfully Completed";
                }
            } else if ($order_details->order_status == 'processing' || $order_details->order_status == 'complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
            }
        } else {
            echo "Invalid Data";
        }
    }
}

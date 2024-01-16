<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Shipping;
use App\Models\Inventory;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{

    public function index()
    {

        $cartTotal = Cart::where('user_id', Auth::id())->sum('total_price');
        
        $coupon_discount = 0.0;
        if (Session::has('applyCoupon')) {
            $coupon_discount = Session::get('applyCoupon')['coupon_discount'];
        }

        $shippings = Shipping::get();

        return view('frontend.cart_details', compact('cartTotal', 'coupon_discount', 'shippings'));
    }

    //store method

    public function store(Request $request)
    {

        $inventory = Inventory::where('product_id', $request->product_id)
            ->where('color_id', $request->color_id)
            ->where('size_id', $request->size_id)
            ->first();

        if ($request->requested_quantity > $inventory->quantity) {

            // Toastrt()->closeButton()->addWarning('Your requested Quantiy is Too much');
            back();
        }

        $product = Product::where('id', $request->product_id)->select('id', 'price', 'sale_price')->first();

        $salePrice = $product->sale_price ?? $product->price;

        $totalPrice = ($salePrice + $inventory->add_price) * $request->requested_quantity;

        Cart::create([
            'user_id'     => Auth::id(),
            'product_id'  => $product->id,
            'color_id'    => $request->color_id,
            'size_id'     => $request->size_id,
            'quantity'    => $request->requested_quantity,
            'price'       => $salePrice,
            'add_price'   => $inventory->add_price,
            'total_price' => $totalPrice,
        ]);

        return redirect()->route('frontend.shop.index');
    }

    public function destroy(Request $request, $id)
    {

        $cart = Cart::findOrfail($id);
        $cart->delete();

        return back();
    }

    public function quantityUpdate(Request $request)
    {
        Cart::where('user_id', $request->user_id)->where('id', $request->cart_id)->update([
            'quantity'    => $request->quantity,
            'total_price' => $request->total,
        ]);
    }

    public function applyCoupon(Request $request)

    {
        $request->session()->forget('applyCoupon');



        $coupon = Coupon::where('coupon_code', $request->coupon)
            ->where('start_date', '<', Carbon::now())
            ->where('expire_date', '>', Carbon::now())->first();

        if (!$coupon) {

            return back()->withInput(['coupon' => $request->coupon]);
        }
        $cartTotal = Cart::where('user_id', Auth::id())->sum('total_price');


        if ($cartTotal < $coupon->min_applicable_amount) {
            return back();
        }

        $useCoupn = Order::where('user_id', Auth::id())->where('coupon_id', $coupon->id)->count();
        if ($useCoupn && $useCoupn >= $coupon->limit) {
            return back();
        }

        $couponDetails = [
            'id' => $coupon->id,
            'coupon_discount' => $coupon->coupon_discount,
            'coupon_code' => $coupon->coupon_code,
        ];

        $request->session()->put('applyCoupon', $couponDetails);

        return back()->withInput(['coupon' => $request->coupon]);
    }



    public function getShippingCharbge(Request $request)
    {
        $shipping_charge =  Shipping::where('id', $request->shipping_charge_id)->first();
        $request->session()->put('shippingCharge', $shipping_charge->add_price);
        return response()->json($shipping_charge);
    }
}

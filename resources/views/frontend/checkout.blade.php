@extends('layouts.frontendapp')
@section('title', 'Shop')
@section('content')

    <main>


        <div class="sidebar-menu-wrapper">
            <div class="cart_sidebar">
                <button type="button" class="close_btn"><i class="fal fa-times"></i></button>
                <ul class="cart_items_list ul_li_block mb_30 clearfix">
                    <li>
                        <div class="item_image">
                            <img src="assets/images/cart/cart_img_1.jpg" alt="image_not_found">
                        </div>
                        <div class="item_content">
                            <h4 class="item_title">Yellow Blouse</h4>
                            <span class="item_price">$30.00</span>
                        </div>
                        <button type="button" class="remove_btn"><i class="fal fa-trash-alt"></i></button>
                    </li>
                    <li>
                        <div class="item_image">
                            <img src="assets/images/cart/cart_img_2.jpg" alt="image_not_found">
                        </div>
                        <div class="item_content">
                            <h4 class="item_title">Yellow Blouse</h4>
                            <span class="item_price">$30.00</span>
                        </div>
                        <button type="button" class="remove_btn"><i class="fal fa-trash-alt"></i></button>
                    </li>
                    <li>
                        <div class="item_image">
                            <img src="assets/images/cart/cart_img_3.jpg" alt="image_not_found">
                        </div>
                        <div class="item_content">
                            <h4 class="item_title">Yellow Blouse</h4>
                            <span class="item_price">$30.00</span>
                        </div>
                        <button type="button" class="remove_btn"><i class="fal fa-trash-alt"></i></button>
                    </li>
                </ul>

                <ul class="total_price ul_li_block mb_30 clearfix">
                    <li>
                        <span>Subtotal:</span>
                        <span>$90</span>
                    </li>
                    <li>
                        <span>Vat 5%:</span>
                        <span>$4.5</span>
                    </li>
                    <li>
                        <span>Discount 20%:</span>
                        <span>- $18.9</span>
                    </li>
                    <li>
                        <span>Total:</span>
                        <span>$75.6</span>
                    </li>
                </ul>
                <ul class="btns_group ul_li_block clearfix">
                    <li><a class="btn btn_primary" href="cart.html">View Cart</a></li>
                    <li><a class="btn btn_secondary" href="checkout.html">Checkout</a></li>
                </ul>
            </div>
            <div class="cart_overlay"></div>
        </div>

        <div class="breadcrumb_section">
            <div class="container">
                <ul class="breadcrumb_nav ul_li">
                    <li><a href="index-2.html">Home</a></li>
                    <li>Check Out</li>
                </ul>
            </div>
        </div>

        <section class="checkout-section section_space">
            <div class="container">
                <div class="row">
                    <div class="col col-xs-12">
                        <div class="woocommerce">

                            <div class="woocommerce-info">Have a coupon? <a href="#" class="showcoupon">Click here to
                                    enter your code</a></div>

                            <form name="checkout" method="post" action="{{ route('frontend.pay.order') }}"
                                class="checkout woocommerce-checkout" enctype="multipart/form-data">
                                @csrf
                                <div class="col2-set" id="customer_details">
                                    <div class="coll-1">
                                        <div class="woocommerce-billing-fields">
                                            <h3>Billing Details</h3>
                                            <p class="form-row form-row form-row-wide validate-required"
                                                id="billing_first_name_field">
                                                <label for="billing_first_name" class="">Name <abbr class="required"
                                                        title="required">*</abbr></label>
                                                <input type="text" class="input-text " name="billing_name" readonly
                                                    id="billing_name" placeholder="" value="{{ auth()->user()->name }}" />
                                            </p>

                                            <p class="form-row form-row form-row-first validate-required validate-email"
                                                id="billing_email_field">
                                                <label for="billing_email" class="">Email Address <abbr
                                                        class="required" title="required">*</abbr></label>
                                                <input type="email" class="input-text " name="billing_email" readonly
                                                    id="billing_email" value="{{ auth()->user()->email }}" />
                                            </p>
                                            <p class="form-row form-row form-row-last validate-required validate-phone"
                                                id="billing_phone_field">
                                                <label for="billing_phone" class="">Phone <abbr class="required"
                                                        title="required">*</abbr></label>
                                                <input type="tel" class="input-text " name="billing_phone"
                                                    id="billing_phone" placeholder="" autocomplete="tel"
                                                    value="{{ auth()->user()->usermeta->phone ?? ' ' }}" />
                                            </p>

                                            <p class="form-row form-row form-row-wide" id="billing_company_field">
                                                <label for="billing_company" class="">Company Name</label>
                                                <input type="text" class="input-text " name="billing_company"
                                                    id="billing_company" placeholder="" autocomplete="organization"
                                                    value="{{ auth()->user()->usermeta->company ?? ' ' }}" />
                                            </p>

                                            <div class="clear"></div>

                                            <p class="form-row form-row form-row-wide address-field validate-required"
                                                id="billing_address_1_field">
                                                <label for="billing_address_1" class="">Address <abbr
                                                        class="required" title="required">*</abbr></label>
                                                <input type="text" class="input-text " name="billing_address_1"
                                                    id="billing_address_1" placeholder="Street address"
                                                    autocomplete="address-line1"
                                                    value="{{ auth()->user()->usermeta->address ?? ' ' }}" />
                                            </p>

                                            <p class="form-row form-row address-field validate-postcode validate-required form-row-first  woocommerce-invalid-required-field"
                                                id="billing_city_field">
                                                <label for="billing_city" class="">Town / City <abbr
                                                        class="required" title="required">*</abbr></label>
                                                <input type="text" class="input-text " name="billing_city"
                                                    id="billing_city" placeholder=""
                                                    value="{{ auth()->user()->usermeta->city ?? ' ' }}" />
                                            </p>
                                            <p class="form-row form-row form-row-last address-field validate-required validate-postcode"
                                                id="billing_postcode_field">
                                                <label for="billing_postcode" class="">Postcode / ZIP <abbr
                                                        class="required" title="required">*</abbr></label>
                                                <input type="text" class="input-text " name="billing_postcode"
                                                    id="billing_postcode" placeholder=""
                                                    value="{{ auth()->user()->usermeta->zipcode ?? ' ' }}" />
                                            </p>

                                        </div>
                                    </div>


                                    <div class="coll-2">
                                        <div class="woocommerce-shipping-fields">
                                            <h3 id="ship-to-different-address">
                                                <label for="ship-to-different-address-checkbox" class="checkbox">Ship to a
                                                    different address?</label>
                                                <input id="ship-to-different-address-checkbox" class="input-checkbox"
                                                    type="checkbox" name="ship_to_different_address" value="1" />
                                            </h3>
                                            <div class="shipping_address">
                                                <p class="form-row form-row form-row-wide validate-required"
                                                    id="shipping_first_name_field">
                                                    <label for="shipping_first_name" class="">Name <abbr
                                                            class="required" title="required">*</abbr></label>
                                                    <input type="text" class="input-text " name="shipping_name"
                                                        id="shipping_name" placeholder="" value="" />
                                                </p>

                                                <div class="clear"></div>
                                                <p class="form-row form-row form-row-wide" id="shipping_company_field">
                                                    <label for="shipping_company" class="">Company Name</label>
                                                    <input type="text" class="input-text " name="shipping_company"
                                                        id="shipping_company" placeholder="" autocomplete="organization"
                                                        value="" />
                                                </p>



                                                <p class="form-row form-row form-row-wide address-field validate-required"
                                                    id="shipping_address_1_field">
                                                    <label for="shipping_address_1" class="">Address <abbr
                                                            class="required" title="required">*</abbr></label>
                                                    <input type="text" class="input-text " name="shipping_address"
                                                        id="shipping_address_1" placeholder="Street address"
                                                        autocomplete="address-line1" value="" />
                                                </p>


                                                <p class="form-row form-row form-row-wide validate-required validate-phone"
                                                    id="billing_phone_field">
                                                    <label for="billing_phone" class="">Phone <abbr
                                                            class="required" title="required">*</abbr></label>
                                                    <input type="tel" class="input-text " name="shipping_phone"
                                                        id="shipping_phone" placeholder="" autocomplete="tel"
                                                        value="" />
                                                </p>

                                                <p class="form-row form-row form-row-first address-field validate-postcode validate-required form-row-first  woocommerce-invalid-required-field"
                                                    id="billing_city_field2">
                                                    <label for="billing_city" class="">Town / City <abbr
                                                            class="required" title="required">*</abbr></label>
                                                    <input type="text" class="input-text " name="shipping_city"
                                                        id="billing_city3" placeholder="" autocomplete="address-level2"
                                                        value="" />
                                                </p>
                                                <p class="form-row form-row form-row-last address-field validate-required validate-postcode"
                                                    id="billing_postcode_field17">
                                                    <label for="billing_postcode" class="">Postcode / ZIP <abbr
                                                            class="required" title="required">*</abbr></label>
                                                    <input type="text" class="input-text " name="shipping_postcode"
                                                        id="billing_postcode4" placeholder="" autocomplete="postal-code"
                                                        value="" />
                                                </p>
                                                <div class="clear"></div>
                                            </div>
                                            <p class="form-row form-row notes" id="order_comments_field">
                                                <label for="order_comments" class="">Order Notes</label>
                                                <textarea name="order_comments" class="input-text " id="order_comments"
                                                    placeholder="Notes about your order, e.g. special notes for delivery." rows="2" cols="5"></textarea>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <h3 id="order_review_heading">Your order</h3>
                                <div id="order_review" class="woocommerce-checkout-review-order">
                                    <table class="shop_table woocommerce-checkout-review-order-table">
                                        <thead>
                                            <tr>
                                                <th class="product-name">Product</th>
                                                <th class="product-total">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach (clientCartDetails() as $cart)
                                                <tr class="cart_item">
                                                    <td class="product-name">
                                                        {{ $cart->product->title }}&nbsp; <strong
                                                            class="product-quantity">&times;
                                                            {{ $cart->quantity }}</strong>
                                                    </td>
                                                    <td class="product-total">
                                                        <span class="woocommerce-Price-amount amount"><span
                                                                class="woocommerce-Price-currencySymbol">&dollar;</span>{{ ($cart->price + $cart->add_price) * $cart->quantity }}</span>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                        <tfoot>
                                            <tr class="cart-subtotal">
                                                <th>Subtotal</th>
                                                <td><span class="woocommerce-Price-amount amount"><span
                                                            class="woocommerce-Price-currencySymbol">&dollar;</span>{{ $cartTotal }}</span>
                                                </td>
                                            </tr>

                                            @if ($coupon_discount)
                                                <tr class="Coupon discount">
                                                    <th>Coupon discount</th>
                                                    <td data-title="coupon_discount">
                                                        <span>-{{ $coupon_discount }}</span>
                                                        <input type="hidden" name="shipping_method[0]" data-index="0"
                                                            id="shipping_method_0" value="free_shipping:1"
                                                            class="shipping_method" />
                                                    </td>
                                                </tr>
                                            @endif

                                            <tr class="shipping">
                                                <th>Shipping</th>
                                                <td data-title="Shipping">

                                                    {{ $shippingCharge ?? ' Free Shipping' }}
                                                    <input type="hidden" name="shipping_method[0]" data-index="0"
                                                        id="shipping_method_0" value="free_shipping:1"
                                                        class="shipping_method" />
                                                </td>
                                            </tr>
                                            <tr class="order-total">
                                                <th>Total</th>
                                                <td><strong><span class="woocommerce-Price-amount amount"><span
                                                                class="woocommerce-Price-currencySymbol">$</span>{{ $cartTotal + ($shippingCharge ?? 0) - $coupon_discount ?? 0 }}
                                                        </span></strong>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div id="payment" class="woocommerce-checkout-payment">
                                        <ul class="wc_payment_methods payment_methods methods">
                                            <li class="wc_payment_method payment_method_cheque">
                                                <input id="payment_method_cheque" type="radio" class="input-radio"
                                                    name="payment_method" value="cheque" checked='checked'
                                                    data-order_button_text="" />

                                                <span class='grop-woo-radio-style'></span>

                                                <label for="payment_method_cheque">
                                                    Check Payments </label>
                                                <div class="payment_box payment_method_cheque">
                                                    <p>Please send a check to Store Name, Store Street, Store Town, Store
                                                        State / County, Store Postcode.</p>
                                                </div>
                                            </li>
                                            <li class="wc_payment_method payment_method_paypal">
                                                <input id="payment_method_paypal" type="radio" class="input-radio"
                                                    name="payment_method" value="paypal"
                                                    data-order_button_text="Proceed to PayPal" />

                                                <span class='grop-woo-radio-style'></span>

                                                <label for="payment_method_paypal">
                                                    PayPal
                                                </label>
                                                <div class="payment_box payment_method_paypal" style="display:none;">
                                                    <p>Pay via PayPal; you can pay with your credit card if you don&#8217;t
                                                        have a PayPal account.</p>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="form-row place-order">
                                            {{-- <noscript>
                                                Since your browser does not support JavaScript, or it is disabled, please
                                                ensure you click the <em>Update Totals</em> button before placing your
                                                order. You may be charged more than the amount stated above if you fail to
                                                do so.
                                                <br />
                                                <input type="submit" class="button alt"
                                                    name="woocommerce_checkout_update_totals" value="Update totals" />
                                            </noscript>
                                            <button id="sslczPayBtn" token="if you have any token validation"
                                                postdata=""
                                                order="If you already have the transaction generated for current order"
                                                endpoint="/pay-via-ajax"> Pay Now
                                            </button> --}}
                                            <input type="submit" class="button alt"
                                                name="woocommerce_checkout_place_order" value="Place order"
                                                data-value="Place order" />


                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>


    </main>

@endsection

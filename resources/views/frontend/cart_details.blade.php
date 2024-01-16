@extends('layouts.frontendapp')
@section('title', 'Shop')
@section('content')
    <div class="breadcrumb_section">
        <div class="container">
            <ul class="breadcrumb_nav ul_li">
                <li><a href="index-2.html">Home</a></li>
                <li>Product Grid</li>
            </ul>
        </div>
    </div>

    <section class="cart_section section_space">

        <div class="container">
            <div class="cart_update_wrap">
                <p class="mb-0"><i class="fal fa-check-square"></i> Shipping costs updated.</p>
            </div>

            <div class="cart_table">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">Total</th>
                            <th class="text-center">Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (clientCartDetails() as $cart)
                            <tr class="cart-row">
                                <td>
                                    <div class="cart_product">
                                        <img src="{{ asset($cart->product->galleries->first()->image_path) }}"
                                            alt="{{ $cart->product->title }}">
                                        <h3><a href="shop_details.html">{{ $cart->product->title }}</a></h3>
                                    </div>
                                </td>
                                <input type="hidden" class="cart_id" name="" value="{{ $cart->id }}">
                                <td class="text-center">$<span
                                        class="price_text item_p">{{ $cart->price + $cart->add_price }}</span></td>
                                <td class="text-center">

                                    <div class="quantity_input">
                                        <button type="button" class="input_number_decrement">
                                            <i class="fal fa-minus"></i>
                                        </button>
                                        <input class="input_number" type="text" value="{{ $cart->quantity }}">
                                        <button type="button" class="input_number_increment">
                                            <i class="fal fa-plus"></i>
                                        </button>
                                    </div>

                                </td>
                                <td class="text-center">$<span
                                        class="price_text total_prices">{{ $cart->total_price }}</span></td>
                                <td class="text-center">

                                    <a href="{{ route('frontend.product.cart.destroy', $cart->id) }}"><button type="button"
                                            class="remove_btn"> <i class="fal fa-trash-alt"> </i></button> </a>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>

            <div class="cart_btns_wrap">
                <div class="row">
                    <div class="col col-lg-6">
                        <form action="{{ route('frontend.product.cart.applyCoupon') }}" method="POST">
                            @csrf
                            <div class="coupon_form form_item mb-0">
                                <input type="text" name="coupon" value="{{ old('coupon') }}"
                                    placeholder="Coupon Code...">
                                <button type="submit" class="btn btn_dark">Apply Coupon</button>
                                <div class="info_icon">
                                    <i class="fas fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="" data-bs-original-title="Your Info Here"
                                        aria-label="Your Info Here"></i>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col col-lg-6">
                        <ul class="btns_group ul_li_right">
                            <li><a class="btn border_black" href="{{ route('frontend.product.cart.list') }}">Update
                                    Cart</a></li>
                            <li><a class="btn btn_dark" href="{{route('frontend.product.order.checkOut')}}">Prceed To Checkout</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col col-lg-6">
                    <div class="calculate_shipping">
                        <h3 class="wrap_title">Calculate Shipping <span class="icon"><i
                                    class="far fa-arrow-up"></i></span></h3>
                        <form action="#">
                            <div class="select_option clearfix">

                                <div class="nice-select" tabindex="0"><span class="current">United Kingdom (UK)</span>
                                    <ul class="list">
                                        <li data-value="Select Your Option" data-display="Select Your Currency"
                                            class="option">Select Your Option
                                        </li>
                                        @foreach ($shippings as $shipping)
                                            <li value="{{ $shipping->id }}" class="option shipping_charge">
                                                {{ $shipping->shipping_name }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col col-md-6">
                                    <div class="form_item">
                                        <input type="text" name="location" placeholder="State / Country">
                                    </div>
                                </div>
                                <div class="col col-md-6">
                                    <div class="form_item">
                                        <input type="text" name="postalcode" placeholder="Postcode / ZIP">
                                    </div>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>



                <div class="col col-lg-6">
                    <div class="cart_total_table">
                        <h3 class="wrap_title">Cart Totals</h3>
                        <ul class="ul_li_block">
                            <li>
                                <span>Cart Subtotal</span>
                                <span>${{ $cartTotal }}</span>
                            </li>
                            <li>

                                <span>Shipping and Handling</span>
                                <span class="freeShipping">Free Shipping</span>
                            </li>
                            @if ($coupon_discount)
                                <li>

                                    <span>Coupon Discoount</span>
                                    <span>-{{ $coupon_discount }}</span>
                                </li>
                            @endif

                            <li>
                                <span>Order Total</span>
                               <p>$<span class="get_total_price">{{ $cartTotal - $coupon_discount }}</span></p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection


@section('script')
    <script>
        //shipping_charge 

        $('.shipping_charge').on('click', function() {
            var shipping_charge_id = $(this).val()
            var totalPrice = "{{ $cartTotal - $coupon_discount }}"
            var totalPriceHtml = $('.get_total_price')

            $.ajax({

                url: "{{ route('frontend.product.cart.shppingCharge') }}",
                type: 'GET',
                dataType: 'json',
                data: {
                    shipping_charge_id: shipping_charge_id,


                },

                success: function(data) {

                    if (data.add_price !=null) {
                       $('.freeShipping').html(data.add_price)

                       totalPriceHtml.html(parseInt(totalPrice)+parseInt(data.add_price))
                    } else {
                        $('.freeShipping').html('Free Shipping')
                        totalPriceHtml.html(totalPrice);
                    }

                }


            });


        })
        // Quantity increment and decrement

        $('.input_number_increment').on('click', function() {
            var user = "{{ Auth::id() }}";
            var parent = $(this).parents('.cart-row');
            var input_number = parent.find('.input_number');

            var cart_id = parent.find('.cart_id').val();


            var thisQuantity = input_number.val();
            let total_price = parent.find('.total_prices')

            let price = parent.find('.item_p').html()

            var incrementValue = parseInt(thisQuantity) + 1;
            input_number.val(incrementValue);

            let nettotal = (parseInt(price) * incrementValue);

            total_price.html(nettotal);


            $.ajax({

                url: "{{ route('frontend.product.cart.quantityUpdate') }}",
                type: 'GET',
                dataType: 'json',
                data: {
                    cart_id: cart_id,
                    user_id: user,
                    quantity: incrementValue,
                    total: nettotal,

                },

                success: function(data) {


                    console.log(data);
                }


            });








        });

        $('.input_number_decrement').on('click', function() {

            var user = "{{ Auth::id() }}";

            var parent = $(this).parents('.cart-row');
            var input_number = parent.find('.input_number');
            var thisQuantity = input_number.val();

            let total_price = parent.find('.total_prices')

            let price = parent.find('.item_p').html()


            var decrementValue = parseInt(thisQuantity) - 1;
            input_number.val(decrementValue);

            let nettotal = (parseInt(price) * decrementValue);

            total_price.html(nettotal)
            var cart_id = parent.find('.cart_id').val();


            if (thisQuantity <= 1) {
                decrementValue = 1;
                nettotal = (parseInt(price) * decrementValue);
                input_number.val(decrementValue);
                total_price.html(nettotal)
            }



            $.ajax({

                url: "{{ route('frontend.product.cart.quantityUpdate') }}",
                type: 'GET',
                dataType: 'json',
                data: {
                    cart_id: cart_id,
                    user_id: user,
                    quantity: decrementValue,
                    total: nettotal,

                },

                success: function(data) {


                    console.log(data);
                }


            });






        });
    </script>
@endsection

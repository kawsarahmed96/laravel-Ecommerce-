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

    <!-- product_details - start  ================================================== -->

    <section class="product_details section_space pb-0">
        <div class="container">
            <div class="row">
                <div class="col col-lg-6">
                    <div class="product_details_image">
                        <div class="details_image_carousel">

                            @foreach ($products->galleries as $gallery)
                                <div class="slider_item">
                                    <img src="{{ asset($gallery->image_path) }}" alt="image_not_found">


                                </div>
                            @endforeach
                        </div>

                        <div class="details_image_carousel_nav">
                            @foreach ($products->galleries as $gallery)
                                <div class="slider_item">
                                    <img src="{{ asset($gallery->image_path) }}" alt="image_not_found">


                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <form action="{{route('frontend.product.cart')}}" method="post">
                        @csrf

                          <input  type="hidden" value="{{$products->id}}"  name="product_id">
                        <div class="product_details_content">
                            <h2 class="item_title">{{ $products->title }}</h2>
                            <p>{!! $products->short_description !!}</p>
                            {{-- <div class="item_review">
                            <ul class="rating_star ul_li">
                                <li><i class="fas fa-star"></i>></li>
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star"></i></li>
                                <li><i class="fas fa-star-half-alt"></i></li>
                            </ul>
                            <span class="review_value">3 Rating(s)</span>
                        </div> --}}

                            <div class="item_price">

                                @if ($products->sale_price)
                                    <span>{{ $products->sale_price }}</span>
                                    <del>{{ $products->price }}</del>
                                @else
                                    <span>{{ $products->price }}</span>
                                @endif

                            </div>
                            <hr>

                            <div class="item_attribute">
                                <h3 class="title_text">Options <span class="underline"></span></h3>
                              
                                    <div class="row">

                                        <div class="col col-md-6">
                                            <div class="select_option clearfix">
                                                <h4 class="input_title">Color *</h4>
                                                <select id="selectColor" class="nice_Select" name="color_id">
                                                    <option data-display="- Please select -">Select Color</option>
                                                    @foreach ($colors as $color)
                                                        <option value="{{ $color->id }}">{{ $color->name }}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>

                                        <div class="col col-md-6">
                                            <div class="select_option clearfix">
                                                <h4 class="input_title">Size *</h4>
                                                <select class="form-control" id="selectSize" name="size_id">
                                                    <option data-display="- Please select -">Select Size</option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="repuired_text">Repuired Fiields *</span>
                         </div>

                            <div class="quantity_wrap">

                                <div class="quantity_input">
                                    <button type="button" class="input_number_decrement">
                                        <i class="fal fa-minus"></i>
                                    </button>
                                    <input class="input_number" type="text" value="1" name="requested_quantity">
                                    <button type="button" class="input_number_increment">
                                        <i class="fal fa-plus"></i>
                                    </button>
                                </div>

                                <p class="mt-3 d-none available_quantity_text">Available Quantity : <span
                                        id="available_quantity">0</span></p>


                                <div class="total_price">Total: $ <span id="product_Sale_price">
                                        @if ($products->sale_price)
                                            {{ $products->sale_price }}
                                        @else
                                            {{ $products->price }}
                                        @endif
                                    </span>
                                </div>
                            </div>

                            <ul class="default_btns_group ul_li">
                                <li><button class="btn btn_primary addtocart_btn" href="#!">Add To Cart</button></li>
                                <li><a href="#!"><i class="far fa-compress-alt"></i></a></li>
                                <li><a href="#!"><i class="fas fa-heart"></i></a></li>
                            </ul>

                            <ul class="default_share_links ul_li">
                                <li>
                                    <a class="facebook" href="#!">
                                        <span><i class="fab fa-facebook-square"></i> Like</span>
                                        <small>10K</small>
                                    </a>
                                </li>
                                <li>
                                    <a class="twitter" href="#!">
                                        <span><i class="fab fa-twitter-square"></i> Tweet</span>
                                        <small>15K</small>
                                    </a>
                                </li>
                                <li>
                                    <a class="google" href="#!">
                                        <span><i class="fab fa-google-plus-square"></i> Google+</span>
                                        <small>20K</small>
                                    </a>
                                </li>
                                <li>
                                    <a class="share" href="#!">
                                        <span><i class="fas fa-plus-square"></i> Share</span>
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </form>
                </div>
            </div>

            <div class="details_information_tab">
                <ul class="tabs_nav nav ul_li" role=tablist>
                    <li>
                        <button class="active" data-bs-toggle="tab" data-bs-target="#description_tab" type="button"
                            role="tab" aria-controls="description_tab" aria-selected="true">
                            Description
                        </button>
                    </li>
                    <li>
                        <button data-bs-toggle="tab" data-bs-target="#additional_information_tab" type="button"
                            role="tab" aria-controls="additional_information_tab" aria-selected="false">
                            Additional information
                        </button>
                    </li>
                    <li>
                        <button data-bs-toggle="tab" data-bs-target="#reviews_tab" type="button" role="tab"
                            aria-controls="reviews_tab" aria-selected="false">
                            Reviews(2)
                        </button>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="description_tab" role="tabpanel">
                        {!! $products->description !!}
                    </div>

                    <div class="tab-pane fade" id="additional_information_tab" role="tabpanel">
                        {!! $products->additional_info !!}
                    </div>

                    <div class="tab-pane fade" id="reviews_tab" role="tabpanel">
                        <div class="average_area">
                            <h4 class="reviews_tab_title">Average Ratings</h4>
                            <div class="row align-items-center">
                                <div class="col-md-5 order-last">
                                    <div class="average_rating_text">
                                        <ul class="rating_star ul_li_center">
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star-half-alt"></i></li>
                                        </ul>
                                        <p class="mb-0">
                                            Average Star Rating: <span>4.3 out of 5</span> (2 vote)
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-7">
                                    <div class="product_ratings_progressbar">
                                        <ul class="five_star ul_li">
                                            <li><span>5 Star</span></li>
                                            <li>
                                                <div class="progress_bar"></div>
                                            </li>
                                            <li>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </li>
                                        </ul>
                                        <ul class="four_star ul_li">
                                            <li><span>4 Star</span></li>
                                            <li>
                                                <div class="progress_bar"></div>
                                            </li>
                                            <li>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fal fa-star"></i>
                                            </li>
                                        </ul>
                                        <ul class="three_star ul_li">
                                            <li><span>3 Star</span></li>
                                            <li>
                                                <div class="progress_bar"></div>
                                            </li>
                                            <li>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fal fa-star"></i>
                                                <i class="fal fa-star"></i>
                                            </li>
                                        </ul>
                                        <ul class="two_star ul_li">
                                            <li><span>2 Star</span></li>
                                            <li>
                                                <div class="progress_bar"></div>
                                            </li>
                                            <li>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fal fa-star"></i>
                                                <i class="fal fa-star"></i>
                                                <i class="fal fa-star"></i>
                                            </li>
                                        </ul>
                                        <ul class="one_star ul_li">
                                            <li><span>1 Star</span></li>
                                            <li>
                                                <div class="progress_bar"></div>
                                            </li>
                                            <li>
                                                <i class="fas fa-star"></i>
                                                <i class="fal fa-star"></i>
                                                <i class="fal fa-star"></i>
                                                <i class="fal fa-star"></i>
                                                <i class="fal fa-star"></i>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="customer_reviews">
                            <h4 class="reviews_tab_title">2 reviews for this product</h4>
                            <div class="customer_review_item clearfix">
                                <div class="customer_image">
                                    <img src="assets/images/team/team_1.jpg" alt="image_not_found">
                                </div>
                                <div class="customer_content">
                                    <div class="customer_info">
                                        <ul class="rating_star ul_li">
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star-half-alt"></i></li>
                                        </ul>
                                        <h4 class="customer_name">Aonathor troet</h4>
                                        <span class="comment_date">JUNE 2, 2021</span>
                                    </div>
                                    <p class="mb-0">Nice Product, I got one in black. Goes with anything!</p>
                                </div>
                            </div>

                            <div class="customer_review_item clearfix">
                                <div class="customer_image">
                                    <img src="assets/images/team/team_2.jpg" alt="image_not_found">
                                </div>
                                <div class="customer_content">
                                    <div class="customer_info">
                                        <ul class="rating_star ul_li">
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star-half-alt"></i></li>
                                        </ul>
                                        <h4 class="customer_name">Danial obrain</h4>
                                        <span class="comment_date">JUNE 2, 2021</span>
                                    </div>
                                    <p class="mb-0">
                                        Great product quality, Great Design and Great Service.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="customer_review_form">
                            <h4 class="reviews_tab_title">Add a review</h4>
                            <p>
                                Your email address will not be published. Required fields are marked *
                            </p>
                            <form action="#">
                                <div class="form_item">
                                    <input type="text" name="name" placeholder="Your name*">
                                </div>
                                <div class="form_item">
                                    <input type="email" name="email" placeholder="Your Email*">
                                </div>
                                <div class="checkbox_item">
                                    <input id="save_checkbox" type="checkbox">
                                    <label for="save_checkbox">Save my name, email, and website in this browser for the
                                        next time I comment.</label>
                                </div>
                                <div class="your_ratings">
                                    <h5>Your Ratings:</h5>
                                    <button type="button"><i class="fal fa-star"></i></button>
                                    <button type="button"><i class="fal fa-star"></i></button>
                                    <button type="button"><i class="fal fa-star"></i></button>
                                    <button type="button"><i class="fal fa-star"></i></button>
                                    <button type="button"><i class="fal fa-star"></i></button>
                                </div>
                                <div class="form_item">
                                    <textarea name="comment" placeholder="Your Review*"></textarea>
                                </div>
                                <button type="submit" class="btn btn_primary">Submit Now</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="related_products_section section_space">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="best-selling-products related-product-area">
                        <div class="sec-title-link">
                            <h3>Related products</h3>
                            <div class="view-all"><a href="#">View all<i class="fal fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                        <div class="product-area clearfix">
                            <div class="grid">
                                <div class="product-pic">
                                    <img src="assets/images/shop/product_img_12.png" alt>
                                    <div class="actions">
                                        <ul>
                                            <li>
                                                <a href="#"><svg role="img" xmlns="http://www.w3.org/2000/svg"
                                                        width="48px" height="48px" viewBox="0 0 24 24"
                                                        stroke="#2329D6" stroke-width="1" stroke-linecap="square"
                                                        stroke-linejoin="miter" fill="none" color="#2329D6">
                                                        <title>Favourite</title>
                                                        <path
                                                            d="M12,21 L10.55,19.7051771 C5.4,15.1242507 2,12.1029973 2,8.39509537 C2,5.37384196 4.42,3 7.5,3 C9.24,3 10.91,3.79455041 12,5.05013624 C13.09,3.79455041 14.76,3 16.5,3 C19.58,3 22,5.37384196 22,8.39509537 C22,12.1029973 18.6,15.1242507 13.45,19.7149864 L12,21 Z" />
                                                    </svg></a>
                                            </li>
                                            <li>
                                                <a href="#"><svg role="img" xmlns="http://www.w3.org/2000/svg"
                                                        width="48px" height="48px" viewBox="0 0 24 24"
                                                        stroke="#2329D6" stroke-width="1" stroke-linecap="square"
                                                        stroke-linejoin="miter" fill="none" color="#2329D6">
                                                        <title>Shuffle</title>
                                                        <path
                                                            d="M21 16.0399H17.7707C15.8164 16.0399 13.9845 14.9697 12.8611 13.1716L10.7973 9.86831C9.67384 8.07022 7.84196 7 5.88762 7L3 7" />
                                                        <path
                                                            d="M21 7H17.7707C15.8164 7 13.9845 8.18388 12.8611 10.1729L10.7973 13.8271C9.67384 15.8161 7.84196 17 5.88762 17L3 17" />
                                                        <path d="M19 4L22 7L19 10" />
                                                        <path d="M19 13L22 16L19 19" />
                                                    </svg></a>
                                            </li>
                                            <li>
                                                <a class="quickview_btn" data-bs-toggle="modal" href="#quickview_popup"
                                                    role="button" tabindex="0"><svg width="48px" height="48px"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                        stroke="#2329D6" stroke-width="1" stroke-linecap="square"
                                                        stroke-linejoin="miter" fill="none" color="#2329D6">
                                                        <title>Visible (eye)</title>
                                                        <path
                                                            d="M22 12C22 12 19 18 12 18C5 18 2 12 2 12C2 12 5 6 12 6C19 6 22 12 22 12Z" />
                                                        <circle cx="12" cy="12" r="3" />
                                                    </svg></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="details">
                                    <h4><a href="#">Macbook Pro</a></h4>
                                    <p><a href="#">Apple MacBook Pro13.3″ Laptop with Touch ID </a></p>
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                    <span class="price">
                                        <ins>
                                            <span class="woocommerce-Price-amount amount">
                                                <bdi>
                                                    <span class="woocommerce-Price-currencySymbol">$</span>471.48
                                                </bdi>
                                            </span>
                                        </ins>
                                    </span>
                                    <div class="add-cart-area">
                                        <button class="add-to-cart">Add to cart</button>
                                    </div>
                                </div>
                            </div>
                            <div class="grid">
                                <div class="product-pic">
                                    <img src="assets/images/shop/product-img-21.png" alt>
                                    <span class="theme-badge">Sale</span>
                                    <div class="actions">
                                        <ul>
                                            <li>
                                                <a href="#"><svg role="img" xmlns="http://www.w3.org/2000/svg"
                                                        width="48px" height="48px" viewBox="0 0 24 24"
                                                        stroke="#2329D6" stroke-width="1" stroke-linecap="square"
                                                        stroke-linejoin="miter" fill="none" color="#2329D6">
                                                        <title>Favourite</title>
                                                        <path
                                                            d="M12,21 L10.55,19.7051771 C5.4,15.1242507 2,12.1029973 2,8.39509537 C2,5.37384196 4.42,3 7.5,3 C9.24,3 10.91,3.79455041 12,5.05013624 C13.09,3.79455041 14.76,3 16.5,3 C19.58,3 22,5.37384196 22,8.39509537 C22,12.1029973 18.6,15.1242507 13.45,19.7149864 L12,21 Z" />
                                                    </svg></a>
                                            </li>
                                            <li>
                                                <a href="#"><svg role="img" xmlns="http://www.w3.org/2000/svg"
                                                        width="48px" height="48px" viewBox="0 0 24 24"
                                                        stroke="#2329D6" stroke-width="1" stroke-linecap="square"
                                                        stroke-linejoin="miter" fill="none" color="#2329D6">
                                                        <title>Shuffle</title>
                                                        <path
                                                            d="M21 16.0399H17.7707C15.8164 16.0399 13.9845 14.9697 12.8611 13.1716L10.7973 9.86831C9.67384 8.07022 7.84196 7 5.88762 7L3 7" />
                                                        <path
                                                            d="M21 7H17.7707C15.8164 7 13.9845 8.18388 12.8611 10.1729L10.7973 13.8271C9.67384 15.8161 7.84196 17 5.88762 17L3 17" />
                                                        <path d="M19 4L22 7L19 10" />
                                                        <path d="M19 13L22 16L19 19" />
                                                    </svg></a>
                                            </li>
                                            <li>
                                                <a class="quickview_btn" data-bs-toggle="modal" href="#quickview_popup"
                                                    role="button" tabindex="0"><svg width="48px" height="48px"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                        stroke="#2329D6" stroke-width="1" stroke-linecap="square"
                                                        stroke-linejoin="miter" fill="none" color="#2329D6">
                                                        <title>Visible (eye)</title>
                                                        <path
                                                            d="M22 12C22 12 19 18 12 18C5 18 2 12 2 12C2 12 5 6 12 6C19 6 22 12 22 12Z" />
                                                        <circle cx="12" cy="12" r="3" />
                                                    </svg></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="details">
                                    <h4><a href="#">Apple Watch</a></h4>
                                    <p><a href="#">Apple Watch Series 7 case Pair any band </a></p>
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                    <span class="price">
                                        <ins>
                                            <span class="woocommerce-Price-amount amount">
                                                <bdi>
                                                    <span class="woocommerce-Price-currencySymbol">$</span>471.48
                                                </bdi>
                                            </span>
                                        </ins>
                                    </span>
                                    <div class="add-cart-area">
                                        <button class="add-to-cart">Add to cart</button>
                                    </div>
                                </div>
                            </div>
                            <div class="grid">
                                <div class="product-pic">
                                    <img src="assets/images/shop/product-img-22.png" alt>
                                    <span class="theme-badge-2">12% off</span>
                                    <div class="actions">
                                        <ul>
                                            <li>
                                                <a href="#"><svg role="img" xmlns="http://www.w3.org/2000/svg"
                                                        width="48px" height="48px" viewBox="0 0 24 24"
                                                        stroke="#2329D6" stroke-width="1" stroke-linecap="square"
                                                        stroke-linejoin="miter" fill="none" color="#2329D6">
                                                        <title>Favourite</title>
                                                        <path
                                                            d="M12,21 L10.55,19.7051771 C5.4,15.1242507 2,12.1029973 2,8.39509537 C2,5.37384196 4.42,3 7.5,3 C9.24,3 10.91,3.79455041 12,5.05013624 C13.09,3.79455041 14.76,3 16.5,3 C19.58,3 22,5.37384196 22,8.39509537 C22,12.1029973 18.6,15.1242507 13.45,19.7149864 L12,21 Z" />
                                                    </svg></a>
                                            </li>
                                            <li>
                                                <a href="#"><svg role="img" xmlns="http://www.w3.org/2000/svg"
                                                        width="48px" height="48px" viewBox="0 0 24 24"
                                                        stroke="#2329D6" stroke-width="1" stroke-linecap="square"
                                                        stroke-linejoin="miter" fill="none" color="#2329D6">
                                                        <title>Shuffle</title>
                                                        <path
                                                            d="M21 16.0399H17.7707C15.8164 16.0399 13.9845 14.9697 12.8611 13.1716L10.7973 9.86831C9.67384 8.07022 7.84196 7 5.88762 7L3 7" />
                                                        <path
                                                            d="M21 7H17.7707C15.8164 7 13.9845 8.18388 12.8611 10.1729L10.7973 13.8271C9.67384 15.8161 7.84196 17 5.88762 17L3 17" />
                                                        <path d="M19 4L22 7L19 10" />
                                                        <path d="M19 13L22 16L19 19" />
                                                    </svg></a>
                                            </li>
                                            <li>
                                                <a class="quickview_btn" data-bs-toggle="modal" href="#quickview_popup"
                                                    role="button" tabindex="0"><svg width="48px" height="48px"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                        stroke="#2329D6" stroke-width="1" stroke-linecap="square"
                                                        stroke-linejoin="miter" fill="none" color="#2329D6">
                                                        <title>Visible (eye)</title>
                                                        <path
                                                            d="M22 12C22 12 19 18 12 18C5 18 2 12 2 12C2 12 5 6 12 6C19 6 22 12 22 12Z" />
                                                        <circle cx="12" cy="12" r="3" />
                                                    </svg></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="details">
                                    <h4><a href="#">Mac Mini</a></h4>
                                    <p><a href="#">Apple MacBook Pro13.3″ Laptop with Touch ID </a></p>
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                    <span class="price">
                                        <ins>
                                            <span class="woocommerce-Price-amount amount">
                                                <bdi>
                                                    <span class="woocommerce-Price-currencySymbol">$</span>471.48
                                                </bdi>
                                            </span>
                                        </ins>
                                        <del aria-hidden="true">
                                            <span class="woocommerce-Price-amount amount">
                                                <bdi>
                                                    <span class="woocommerce-Price-currencySymbol">$</span>904.21
                                                </bdi>
                                            </span>
                                        </del>
                                    </span>
                                    <div class="add-cart-area">
                                        <button class="add-to-cart">Add to cart</button>
                                    </div>
                                </div>
                            </div>
                            <div class="grid">
                                <div class="product-pic">
                                    <img src="assets/images/shop/product-img-23.png" alt>
                                    <span class="theme-badge">Sale</span>
                                    <div class="actions">
                                        <ul>
                                            <li>
                                                <a href="#"><svg role="img" xmlns="http://www.w3.org/2000/svg"
                                                        width="48px" height="48px" viewBox="0 0 24 24"
                                                        stroke="#2329D6" stroke-width="1" stroke-linecap="square"
                                                        stroke-linejoin="miter" fill="none" color="#2329D6">
                                                        <title>Favourite</title>
                                                        <path
                                                            d="M12,21 L10.55,19.7051771 C5.4,15.1242507 2,12.1029973 2,8.39509537 C2,5.37384196 4.42,3 7.5,3 C9.24,3 10.91,3.79455041 12,5.05013624 C13.09,3.79455041 14.76,3 16.5,3 C19.58,3 22,5.37384196 22,8.39509537 C22,12.1029973 18.6,15.1242507 13.45,19.7149864 L12,21 Z" />
                                                    </svg></a>
                                            </li>
                                            <li>
                                                <a href="#"><svg role="img" xmlns="http://www.w3.org/2000/svg"
                                                        width="48px" height="48px" viewBox="0 0 24 24"
                                                        stroke="#2329D6" stroke-width="1" stroke-linecap="square"
                                                        stroke-linejoin="miter" fill="none" color="#2329D6">
                                                        <title>Shuffle</title>
                                                        <path
                                                            d="M21 16.0399H17.7707C15.8164 16.0399 13.9845 14.9697 12.8611 13.1716L10.7973 9.86831C9.67384 8.07022 7.84196 7 5.88762 7L3 7" />
                                                        <path
                                                            d="M21 7H17.7707C15.8164 7 13.9845 8.18388 12.8611 10.1729L10.7973 13.8271C9.67384 15.8161 7.84196 17 5.88762 17L3 17" />
                                                        <path d="M19 4L22 7L19 10" />
                                                        <path d="M19 13L22 16L19 19" />
                                                    </svg></a>
                                            </li>
                                            <li>
                                                <a class="quickview_btn" data-bs-toggle="modal" href="#quickview_popup"
                                                    role="button" tabindex="0"><svg width="48px" height="48px"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                        stroke="#2329D6" stroke-width="1" stroke-linecap="square"
                                                        stroke-linejoin="miter" fill="none" color="#2329D6">
                                                        <title>Visible (eye)</title>
                                                        <path
                                                            d="M22 12C22 12 19 18 12 18C5 18 2 12 2 12C2 12 5 6 12 6C19 6 22 12 22 12Z" />
                                                        <circle cx="12" cy="12" r="3" />
                                                    </svg></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="details">
                                    <h4><a href="#">iPad mini</a></h4>
                                    <p><a href="#">The ultimate iPad experience all over the world </a></p>
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                    <span class="price">
                                        <ins>
                                            <span class="woocommerce-Price-amount amount">
                                                <bdi>
                                                    <span class="woocommerce-Price-currencySymbol">$</span>471.48
                                                </bdi>
                                            </span>
                                        </ins>
                                    </span>
                                    <div class="add-cart-area">
                                        <button class="add-to-cart">Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection


@section('script')

    <script>
        $(function($) {

            var price = "{{ $products->price }}";
            var sale_price = "{{ $products->sale_price }}";
            var addPrice = sale_price ?? price;
            var input_number_value = $('.input_number').val();
            var available_quan = 0;
            var pricTotal = 0;

            var product_id = "{{ $products->id }}";

            $("#selectColor").on("change", function() {

                var color_id = $(this).val();

                $.ajax({
                    type: 'GET',

                    dataType: 'json',

                    url: "{{ route('frontend.select.color.wise.size') }}",

                    data: {
                        product_id,
                        color_id
                    },

                    success: function(data) {
                        $('#selectSize').html(data);
                        $('#available_quantity').html(1);

                    }
                    // $('.available_quantity_text').removeClass('d-none')
                    // $('#product_Sale_price').html(addPrice);

                })

            });



            $("#selectSize").on("change", function() {

                var size_id = $(this).val();
                var color_id = $('#selectColor').val();

                $.ajax({
                    type: 'GET',

                    dataType: 'json',

                    url: "{{ route('frontend.select.color.wise.size.inventory') }}",

                    data: {
                        product_id,
                        size_id,
                        color_id
                    },

                    success: function(data) {

                        var price = "{{ $products->price }}";
                        var sale_price = "{{ $products->sale_price }}";
                        var addPrice = sale_price ?? price;

                        var addSalePrice = parseFloat(data.add_price ?? 0) + parseFloat(
                            addPrice);

                        $('#available_quantity').html(data.quantity);
                        $('#product_Sale_price').html(addSalePrice.toFixed(2));

                        pricTotal = addSalePrice;


                        available_quan = data.quantity;
                        $('.input_number').val(1);


                    }


                });

                $('.available_quantity_text').removeClass('d-none')
                $('.available_quantity_text').addClass('d-block')

            });


            // Quantity increment and decrement

            $('.input_number_increment').on('click', function() {



                if (available_quan > input_number_value) {

                    var incrementValue = ++input_number_value;
                    $('.input_number').val(incrementValue);
                    //   $(.'input_number_decrement').attr("disabled",true);

                    var netTotal = pricTotal * incrementValue;

                    $('#product_Sale_price').html(netTotal.toFixed(2));

                } else {
                    $('.input_number').val(available_quan);
                    incrementValue = 1;

                }



            });

            $('.input_number_decrement').on('click', function() {



                if (input_number_value > 1) {
                    var decrementValue = --input_number_value;
                    $('.input_number').val(decrementValue);
                    $(this).attr("disabled", false);

                    var netTotal = pricTotal * decrementValue;

                    $('#product_Sale_price').html(netTotal.toFixed(2));


                } else {

                    $('.input_number').val(1);

                    decrementValue = 1;
                }






            });
        })
    </script>
@endsection

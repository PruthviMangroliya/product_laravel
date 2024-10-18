@extends('frontend.FrontLayout')

@section('title')
    {{ 'Product Description' }}
@endsection

@section('content')
    <div id="page-content">

        <div id="MainContent" class="main-content" role="main">

            <div class="bredcrumbWrap">
                <div class="container breadcrumbs">
                    <a href="index.html" title="Back to the home page">Home</a><span aria-hidden="true">›</span><span>Short
                        Description</span>
                </div>
            </div>

            <div id="ProductSection-product-template" class="product-template__container prstyle1 container">

                @foreach ($products as $product)
                    <div class="product-single">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="product-details-img">
                                    <div class="product-thumb">
                                        <div id="gallery" class="product-dec-slider-2 product-tab-left">
                                            @foreach ($product_images as $image)
                                                <a data-image="{{ asset($image->product_image_name) }}"
                                                    data-zoom-image="{{ asset($image->product_image_name) }}"
                                                    class="slick-slide slick-cloned" data-slick-index="-4"
                                                    aria-hidden="true" tabindex="-1">
                                                    <img class="blur-up lazyload"
                                                        src="{{ asset($image->product_image_name) }}" alt="" />
                                                </a>
                                            @endforeach

                                        </div>
                                    </div>
                                    <div class="zoompro-wrap product-zoom-right pl-20">
                                        <div class="zoompro-span">
                                            <img class="zoompro blur-up lazyload"
                                                data-zoom-image="{{ asset($image->product_image_name) }}" alt=""
                                                src="{{ asset($image->product_image_name) }}" height="500px"
                                                width="400px" />
                                        </div>
                                        <div class="product-labels"><span class="lbl on-sale">Sale</span><span
                                                class="lbl pr-label1">new</span></div>
                                        <div class="product-buttons">
                                            <a href="https://www.youtube.com/watch?v=93A2jOW5Mog" class="btn popup-video"
                                                title="View Video"><i class="icon anm anm-play-r"
                                                    aria-hidden="true"></i></a>
                                            <a href="#" class="btn prlightbox" title="Zoom">
                                                <i class="icon anm anm-expand-l-arrows" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="lightboximages">
                                        @foreach ($product_images as $image)
                                            <a href="{{ asset($image->product_image_name) }}" data-size="1462x2048"></a>
                                        @endforeach
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="product-single__meta">
                                    <h1 class="product-single__title">{{ $product->product_title }}</h1>
                                    <div class="product-nav clearfix">
                                        <a href="#" class="next" title="Next"><i class="fa fa-angle-right"
                                                aria-hidden="true"></i></a>
                                    </div>
                                    <div class="prInfoRow">
                                        <div class="product-stock">
                                            <span class="instock ">In Stock</span>
                                            <span class="outstock hide">Unavailable</span>
                                        </div>
                                        <div class="product-sku">SKU: <span class="variant-sku">19115-rdxs</span></div>

                                    </div>
                                    <p class="product-single__price product-single__price-product-template">
                                        <span class="visually-hidden">Regular price</span>

                                        {{-- @if (!empty($coupons))
                                            <s id="ComparePrice-product-template">
                                                <span class="money">{{ $product->product_price }}</span>
                                            </s>

                                            <span
                                                class="product-price__price product-price__price-product-template product-price__sale product-price__sale--single">
                                                <span id="ProductPrice-product-template">

                                                    <span class="money">

                                                        @foreach ($coupons as $coupon)
                                                            &#8377;
                                                            @if ($coupon->discount_type == '%')
                                                                <?php
                                                                $discount_amount = ($product->product_price * $coupon->discount_amount) / 100;
                                                                ?>
                                                                {{ ceil($product->product_price - $discount_amount) }}
                                                            @else
                                                                {{ ceil($product->product_price - $coupon->discount_amount) }}
                                                            @endif
                                                        @endforeach

                                                        <span class="discount-badge"> <span class="devider">|</span>&nbsp;
                                                            <span>You Save &#8377;</span>
                                                            <span id="SaveAmount-product-template"
                                                                class="product-single__save-amount">
                                                                <span
                                                                    class="money">{{ isset($discount_amount) ? ceil($discount_amount) : '' }}
                                                                </span>
                                                            </span>
                                                            <span
                                                                class="off">({{ isset($discount_amount) ? $coupon->discount_amount : '' }}
                                                                {{ isset($discount_amount) ? $coupon->discount_type : '' }})</span>
                                                        </span>
                                                    </span>
                                                </span>
                                            </span>
                                        @else --}}

                                        <span
                                            class="product-price__price product-price__price-product-template product-price__sale product-price__sale--single">
                                            <span id="ProductPrice-product-template">
                                                &#8377;
                                                {{ $product->product_price }}
                                            </span>
                                        </span>
                                        {{-- @endif --}}

                                    </p>
                                </div>

                                <form method="post" name="cart_form"
                                    action="{{ url('add_to_cart', $product->product_id) }}" id="product_form_10508262282"
                                    accept-charset="UTF-8" class="product-form product-form-product-template hidedropdown"
                                    enctype="multipart/form-data">

                                    @foreach ($product_attributes as $product_attribute)
                                        <div class="swatch clearfix swatch-0 option1" data-option-index="0">
                                            <div class="product-form__item">
                                                <div data-value="XS" class="swatch-element xs available">
                                                    <input class="swatchInput" id="swatch-1-xs">
                                                    <label class="swatchLbl medium rectangle" for="swatch-1-xs">
                                                        <b> {{ $product_attribute->attribute_name }}</b>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    <div class="swatch clearfix swatch-0 option1" data-option-index="0">
                                        <div class="product-form__item">

                                            @foreach ($product_option as $option)
                                                <label class="header">{{ $option->option_name }}:
                                                    <span class="slVariant"></span>
                                                </label>
                                                {{--  && $option->option_status == "enable" --}}
                                                {{-- {{ $option->option_status == 'disable' ? 'disabled' : '' }} --}}
                                                @foreach ($product_option_value as $option_detail)
                                                    @if ($option->option_id == $option_detail->option_id)
                                                        @if ($option_detail->option_name == 'Color')
                                                            <div data-value="{{ $option_detail->option_value }}"
                                                                class="swatch-element">
                                                                <input type="radio" class="swatchInput"
                                                                    id="{{ $option_detail->option_value }}"
                                                                    name="{{ $option_detail->option_name }}"
                                                                    value="{{ $option_detail->option_value }}" required>

                                                                <label class="swatchLbl"
                                                                    for="{{ $option_detail->option_value }}"
                                                                    style="background-color:<?php echo $option_detail->option_value; ?>"
                                                                    title="{{ $option_detail->option_value }}">
                                                                </label>
                                                                
                                                            </div>
                                                        @else
                                                            <div data-value="{{ $option_detail->option_value }}"
                                                                class="swatch-element">
                                                                <input type="radio" class="swatchInput"
                                                                    id="{{ $option_detail->option_value }}"
                                                                    name="{{ $option_detail->option_name }}"
                                                                    value="{{ $option_detail->option_value }}" required>

                                                                <label class="swatchLbl medium rectangle"
                                                                    for="{{ $option_detail->option_value }}">{{ $option_detail->option_value }}
                                                                </label>
                                                            </div>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            @endforeach

                                        </div>
                                    </div>


                                    <!-- Product Action -->
                                    <div class="product-action clearfix">
                                        <div class="product-form__item--quantity">
                                            <div class="wrapQtyBtn">
                                                <div class="qtyField">
                                                    <a class="qtyBtn minus" href="javascript:void(0);">
                                                        <i class="fa anm anm-minus-r" aria-hidden="true"></i>
                                                    </a>
                                                    <input type="text" id="Quantity" name="quantity" value="1"
                                                        class="product-form__input qty">
                                                    <a class="qtyBtn plus" href="javascript:void(0);">
                                                        <i class="fa anm anm-plus-r" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="product-form__item--submit">

                                            @csrf
                                            <button class="btn " type="submit" value="{{ $product->product_id }}">
                                                Add To Cart
                                            </button>
                                        </div>

                                    </div>

                                </form>

                                <div class="shopify-payment-button" data-shopify="payment-button">
                                    <button type="button"
                                        class="shopify-payment-button__button shopify-payment-button__button--unbranded">
                                        Buy
                                        it now </button>
                                </div>
                                <!-- End Product Action -->

                                <div class="display-table shareRow">
                                    <div class="display-table-cell medium-up--one-third">
                                        <div class="wishlist-btn">
                                            <a class="wishlist add-to-wishlist" href="#" title="Add to Wishlist"><i
                                                    class="icon anm anm-heart-l" aria-hidden="true"></i> <span>Add to
                                                    Wishlist</span></a>
                                        </div>
                                    </div>
                                    <div class="display-table-cell text-right">
                                        <div class="social-sharing">
                                            <a target="_blank" href="#"
                                                class="btn btn--small btn--secondary btn--share share-facebook"
                                                title="Share on Facebook">
                                                <i class="fa fa-facebook-square" aria-hidden="true"></i> <span
                                                    class="share-title" aria-hidden="true">Share</span>
                                            </a>
                                            <a target="_blank" href="#"
                                                class="btn btn--small btn--secondary btn--share share-twitter"
                                                title="Tweet on Twitter">
                                                <i class="fa fa-twitter" aria-hidden="true"></i> <span
                                                    class="share-title" aria-hidden="true">Tweet</span>
                                            </a>
                                            <a href="#" title="Share on google+"
                                                class="btn btn--small btn--secondary btn--share">
                                                <i class="fa fa-google-plus" aria-hidden="true"></i> <span
                                                    class="share-title" aria-hidden="true">Google+</span>
                                            </a>
                                            <a target="_blank" href="#"
                                                class="btn btn--small btn--secondary btn--share share-pinterest"
                                                title="Pin on Pinterest">
                                                <i class="fa fa-pinterest" aria-hidden="true"></i> <span
                                                    class="share-title" aria-hidden="true">Pin it</span>
                                            </a>
                                            <a href="#"
                                                class="btn btn--small btn--secondary btn--share share-pinterest"
                                                title="Share by Email" target="_blank">
                                                <i class="fa fa-envelope" aria-hidden="true"></i> <span
                                                    class="share-title" aria-hidden="true">Email</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <p id="freeShipMsg" class="freeShipMsg" data-price="199"><i class="fa fa-truck"
                                        aria-hidden="true"></i>
                                    GETTING CLOSER! ONLY <b class="freeShip"><span class="money"
                                            data-currency-usd="$199.00" data-currency="USD">$199.00</span></b> AWAY FROM
                                    <b>FREE SHIPPING!</b>
                                </p>
                                <p class="shippingMsg"><i class="fa fa-clock-o" aria-hidden="true"></i> ESTIMATED
                                    DELIVERY BETWEEN <b id="fromDate">Wed. May 1</b> and <b id="toDate">Tue. May
                                        7</b>.</p>
                                <div class="userViewMsg" data-user="20" data-time="11000"><i class="fa fa-users"
                                        aria-hidden="true"></i>
                                    <strong class="uersView">14</strong> PEOPLE ARE LOOKING
                                    FOR THIS PRODUCT
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!--End-product-single-->

                <!--Product Fearure-->
                <div class="prFeatures">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-3 col-lg-3 feature">
                            <img src="{{ asset('frontend_assets/images/credit-card.png') }}" alt="Safe Payment"
                                title="Safe Payment" />
                            <div class="details">
                                <h3>Safe Payment</h3>Pay with the world's most payment methods.
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3 col-lg-3 feature">
                            <img src="{{ asset('frontend_assets/images/shield.png') }}" alt="Confidence"
                                title="Confidence" />
                            <div class="details">
                                <h3>Confidence</h3>Protection covers your purchase and personal data.
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3 col-lg-3 feature">
                            <img src="{{ asset('frontend_assets/images/worldwide.png') }}" alt="Worldwide Delivery"
                                title="Worldwide Delivery" />
                            <div class="details">
                                <h3>Worldwide Delivery</h3>FREE &amp; fast shipping to over 200+ countries &amp; regions.
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3 col-lg-3 feature">
                            <img src="{{ asset('frontend_assets/images/phone-call.png') }}" alt="Hotline"
                                title="Hotline" />
                            <div class="details">
                                <h3>Hotline</h3>Talk to help line for your question on 4141 456 789, 4125 666 888
                            </div>
                        </div>
                    </div>
                </div>
                <!--End Product Fearure-->
            </div>

        </div>
        <!--MainContent-->
    </div>
    </div>
@endsection


@section('script')
    <script>
        $(document).ready(function() {
            $(".add_to_cart").click(function() {
                $.ajax({
                    url: "{{ url('add_to_cart') }}",
                    method: "POST",
                    data: {
                        "_token": "{{ @csrf_token() }}",
                        product_id: $(this).val()
                    }
                })
            })
        })
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

    <script>
        $('cart_form').validate({
            rules: {
                Size: {
                    required: true,
                }
            },
            messages: {
                Size: {
                    required: 'Please select Option',
                }
            }
        });
    </script>
@endsection

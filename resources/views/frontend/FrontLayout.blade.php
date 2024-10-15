<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Belle Multipurpose Bootstrap 4 Html Template</title>
    <meta name="description" content="description">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('frontend_assets/images/favicon.png') }}" />
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/plugins.css') }}">
    <!-- Bootstap CSS -->
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/bootstrap.min.css') }}">
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/responsive.css') }}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script> --}}


</head>

{{-- //============ for header data ==================== --}}
<?php

$categories = DB::table('category')->get();
$subcategories = DB::table('subcategory')->get();

$cart_data = session()->get('cart');
$cart_product_option_data =     session()->get('cart_product_option');
$options = DB::table('options')->get();

if (!empty($cart_data)) {
    foreach ($cart_data as $cart_product_id => $quantity) {
        $cart_product_ids[] = $cart_product_id;
    }
    // $product_ids=implode(',',$cart_product_ids);
    // $data['cart_products'] = DB::table('products')->where('product_id','IN',$product_ids)->get();

    $cart_products = DB::table('products')->whereIn('product_id', $cart_product_ids)->get();
    $cart_product_images = DB::table('product_images')->whereIn('product_id', $cart_product_ids)->get();
}
?>
{{-- //============ for header data ==================== --}}


<body class="template-index belle template-index-belle">
    {{-- <div id="pre-loader">
        <img src="{{ asset('frontend_assets/images/loader.gif') }}" alt="Loading..." />
    </div>  --}}

    <div class="pageWrapper">

        <div class="search">
            <div class="search__form">
                <form class="search-bar__form" action="#">
                    <button class="go-btn search__button" type="submit"><i class="icon anm anm-search-l"></i></button>
                    <input class="search__input" type="search" name="q" value=""
                        placeholder="Search entire store..." aria-label="Search" autocomplete="off">
                </form>
                <button type="button" class="search-trigger close-btn"><i class="anm anm-times-l"></i></button>
            </div>
        </div>

        <div class="top-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-10 col-sm-8 col-md-5 col-lg-4">
                        <div class="currency-picker">
                            <span class="selected-currency">USD</span>
                            <ul id="currencies">
                                <li data-currency="INR" class="">INR</li>
                                <li data-currency="GBP" class="">GBP</li>
                                <li data-currency="CAD" class="">CAD</li>
                                <li data-currency="USD" class="selected">USD</li>
                                <li data-currency="AUD" class="">AUD</li>
                                <li data-currency="EUR" class="">EUR</li>
                                <li data-currency="JPY" class="">JPY</li>
                            </ul>
                        </div>
                        <div class="language-dropdown">
                            <span class="language-dd">English</span>
                            <ul id="language">
                                <li class="">German</li>
                                <li class="">French</li>
                            </ul>
                        </div>
                        <p class="phone-no"><i class="anm anm-phone-s"></i> +440 0(111) 044 833</p>
                    </div>
                    <div class="col-sm-4 col-md-4 col-lg-4 d-none d-lg-none d-md-block d-lg-block">
                        <div class="text-center">
                            <p class="top-header_middle-text"> Worldwide Express Shipping</p>
                        </div>
                    </div>
                    <div class="col-2 col-sm-4 col-md-3 col-lg-4 text-right">
                        <span class="user-menu d-block d-lg-none"><i class="anm anm-user-al"
                                aria-hidden="true"></i></span>
                        <ul class="customer-links list-inline">
                            <li><a href="{{ url('/available_coupons') }}"> Coupons </a></li>
                            @if (!Session::has('customer'))
                                <li><a href="{{ url('customer_login') }}">Login</a></li>
                                <li><a href="{{ url('customer_register') }}">Create Account</a></li>
                            @else
                                <li><a href="{{ url('frontend/customers_order') }}">My Orders</a></li>
                                <li><a href="{{ url('customer_logout') }}">Log Out</a></li>
                            @endif
                            <li><a href="wishlist">Wishlist</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        @if (Session::has('message'))
            <!-- <div class="alert alert-success" role="alert" style="width:100%">
            {{ Session::get('item_added') }}
            </div> -->
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong> {{ Session::get('message') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="header-wrap classicHeader animated d-flex">
            <div class="container-fluid">
                <div class="row align-items-center">

                    <div class="logo col-md-2 col-lg-2 d-none d-lg-block">
                        <a href="{{ url('/') }}  ">
                            <img src="{{ asset('frontend_assets/images/logo.svg') }}"
                                alt="Belle Multipurpose Html Template" title="Belle Multipurpose Html Template" />
                        </a>
                    </div>

                    <div class="col-2 col-sm-3 col-md-3 col-lg-8">
                        <div class="d-block d-lg-none">
                            <button type="button"
                                class="btn--link site-header__menu js-mobile-nav-toggle mobile-nav--open">
                                <i class="icon anm anm-times-l"></i>
                                <i class="anm anm-bars-r"></i>
                            </button>
                        </div>

                        <nav class="grid__item" id="AccessibleNav">
                            <ul id="siteNav" class="site-nav medium center hidearrow">
                                <li class="lvl1 parent megamenu"><a href="{{ url('/') }}"> Home <i
                                            class="anm anm-angle-down-l"></i></a>
                                    @foreach ($categories as $category)
                                <li class="lvl1 parent megamenu">
                                    <a href="{{ url('frontend/category/' . $category->category_id) }}">{{ $category->category_name }}
                                        <i class="anm anm-angle-down-l"></i>
                                    </a>
                                    <div class="megamenu style1">
                                        <ul class="grid mmWrapper">
                                            <li class="grid__item large-up--one-whole">
                                                <ul class="grid">
                                                    @foreach ($subcategories as $subcategory)
                                                        @if ($subcategory->category_id == $category->category_id)
                                                            <li class="grid__item lvl-1 col-md-3 col-lg-3"><a
                                                                    href="{{ url('frontend/subcategory/' . $subcategory->subcategory_id) }}"
                                                                    class="site-nav lvl-1">{{ $subcategory->subcategory_name }}</a>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                @endforeach

                            </ul>
                        </nav>
                    </div>

                    <div class="col-6 col-sm-6 col-md-6 col-lg-2 d-block d-lg-none mobile-logo">
                        <div class="logo">
                            <a href="{{ url('/') }}">
                                <img src="{{ asset('frontend_assets/images/logo.svg') }}"
                                    alt="Belle Multipurpose Html Template" title="Belle Multipurpose Html Template" />
                            </a>
                        </div>
                    </div>

                    <div class="col-4 col-sm-3 col-md-3 col-lg-2">
                        {{-- Cart view --}}
                        <div class="site-cart">
                            <a href="#;" class="site-header__cart" title="Cart">
                                <i class="icon anm anm-bag-l"></i>
                                <span id="CartCount" class="site-header__cart-count"
                                    data-cart-render="item_count">{{ !empty($cart_data) ? count($cart_data) : '0' }}</span>
                            </a>

                            <!--Minicart Popup-->
                            <div id="header-cart" class="block block-cart">
                                @if (!empty($cart_data))
                                    <ul class="mini-products-list">
                                        <?php $total = 0; ?>
                                        @foreach ($cart_products as $cart_product)
                                            {{-- {{ $quantity = $cart_data[$cart_product->product_id] }}  --}}
                                            @foreach ($cart_product_images as $cart_product_image)
                                                @if ($cart_product_image->product_id == $cart_product->product_id)
                                                    <?php $image = $cart_product_image->product_image_name; ?>
                                                @endif
                                            @endforeach
                                            <li class="item">
                                                <a class="product-image" href="#">
                                                    <img src="{{ asset($image) }}" alt="3/4 Sleeve Kimono Dress"
                                                        title="" />
                                                </a>
                                                <div class="product-details">
                                                    <a href="{{ url('remove_cart', $cart_product->product_id) }}"
                                                        class="remove"><i class="anm anm-times-l"
                                                            aria-hidden="true"></i></a>
                                                    <a href="#" class="edit-i remove"><i class="anm anm-edit"
                                                            aria-hidden="true"></i></a>
                                                    <a class="pName"
                                                        href="{{ url('view_cart') }}">{{ $cart_product->product_title }}</a>
                                                    <div class="variant-cart">
                                                        @if (!empty($cart_product_option_data[$cart_product->product_id]))
                                                            @foreach ($cart_product_option_data[$cart_product->product_id] as $product_id => $product_option)
                                                                @foreach ($options as $option)
                                                                    @if (isset($product_option[$option->option_name]))
                                                                        {{ $product_option[$option->option_name] }}
                                                                        <br>
                                                                    @endif
                                                                @endforeach
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                    <div class="wrapQtyBtn">
                                                        <div class="qtyField">

                                                            <input type="hidden" id="product_id"
                                                                value="{{ $cart_product->product_id }}">
                                                            <input type="hidden" id="product_price"
                                                                value="{{ $cart_product->product_price }} ">

                                                            <span class="label">Qty:</span>
                                                            <a class="qtyBtn minus" href="javascript:void(0);"><i
                                                                    class="fa anm anm-minus-r"
                                                                    aria-hidden="true"></i></a>
                                                            <input type="text" id="Quantity" name="quantity"
                                                                value="{{ $cart_data[$cart_product->product_id] }}"
                                                                class="product-form__input qty">
                                                            <a class="qtyBtn plus" href="javascript:void(0);"><i
                                                                    class="fa anm anm-plus-r" aria-hidden="true"></i>
                                                            </a>

                                                        </div>
                                                    </div>
                                                    <div class="priceRow">
                                                        <div class="product-price">
                                                            <span
                                                                class="money">{{ $cart_product->product_price }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <?php $total += $cart_product->product_price * $cart_data[$cart_product->product_id]; ?>
                                        @endforeach

                                    </ul>
                                    <div class="total">
                                        <div class="total-in">
                                            <span class="label">Cart Subtotal:</span><span class="product-price">
                                                <span class="money">{{ $total }}</span>
                                            </span>
                                        </div>
                                        <div class="buttonSet text-center">
                                            <a href="{{ url('view_cart') }}"
                                                class="btn btn-secondary btn--small">View Cart</a>
                                            <a href="{{ url('checkout') }}"
                                                class="btn btn-secondary btn--small">Checkout</a>
                                        </div>
                                    </div>
                                @else
                                    <h3> Cart is empty </h3>
                                @endif

                            </div>
                            <!--EndMinicart Popup-->

                        </div>

                        <div class="site-header__search">
                            <button type="button" class="search-trigger"> <i class="icon anm anm-search-l"> </i>
                            </button>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <!--End Header-->



        @yield('content')


        <!--Store Feature-->
        <div class="store-feature section">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        <ul class="display-table store-info">
                            <li class="display-table-cell">
                                <i class="icon anm anm-truck-l"></i>
                                <h5>Free Shipping &amp; Return</h5>
                                <span class="sub-text">Free shipping on all US orders</span>
                            </li>
                            <li class="display-table-cell">
                                <i class="icon anm anm-dollar-sign-r"></i>
                                <h5>Money Guarantee</h5>
                                <span class="sub-text">30 days money back guarantee</span>
                            </li>
                            <li class="display-table-cell">
                                <i class="icon anm anm-comments-l"></i>
                                <h5>Online Support</h5>
                                <span class="sub-text">We support online 24/7 on day</span>
                            </li>
                            <li class="display-table-cell">
                                <i class="icon anm anm-credit-card-front-r"></i>
                                <h5>Secure Payments</h5>
                                <span class="sub-text">All payment are Secured and trusted.</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--End Store Feature-->


        <!--Footer-->
        <footer id="footer">
            <div class="newsletter-section">
                <div class="container">
                    <div class="row">
                        <div
                            class="col-12 col-sm-12 col-md-12 col-lg-7 w-100 d-flex justify-content-start align-items-center">
                            <div class="display-table">
                                <div class="display-table-cell footer-newsletter">
                                    <div class="section-header text-center">
                                        <label class="h2"><span>sign up for </span>newsletter</label>
                                    </div>
                                    <form action="#" method="post">
                                        <div class="input-group">
                                            <input type="email" class="input-group__field newsletter__input"
                                                name="EMAIL" value="" placeholder="Email address"
                                                required="">
                                            <span class="input-group__btn">
                                                <button type="submit" class="btn newsletter__submit" name="commit"
                                                    id="Subscribe"><span
                                                        class="newsletter__submit-text--large">Subscribe</span></button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-5 d-flex justify-content-end align-items-center">
                            <div class="footer-social">
                                <ul class="list--inline site-footer__social-icons social-icons">
                                    <li><a class="social-icons__link" href="#" target="_blank"
                                            title="Belle Multipurpose Bootstrap 4 Template on Facebook"><i
                                                class="icon icon-facebook"></i></a></li>
                                    <li><a class="social-icons__link" href="#" target="_blank"
                                            title="Belle Multipurpose Bootstrap 4 Template on Twitter"><i
                                                class="icon icon-twitter"></i> <span
                                                class="icon__fallback-text">Twitter</span></a></li>
                                    <li><a class="social-icons__link" href="#" target="_blank"
                                            title="Belle Multipurpose Bootstrap 4 Template on Pinterest"><i
                                                class="icon icon-pinterest"></i> <span
                                                class="icon__fallback-text">Pinterest</span></a></li>
                                    <li><a class="social-icons__link" href="#" target="_blank"
                                            title="Belle Multipurpose Bootstrap 4 Template on Instagram"><i
                                                class="icon icon-instagram"></i> <span
                                                class="icon__fallback-text">Instagram</span></a></li>
                                    <li><a class="social-icons__link" href="#" target="_blank"
                                            title="Belle Multipurpose Bootstrap 4 Template on Tumblr"><i
                                                class="icon icon-tumblr-alt"></i> <span
                                                class="icon__fallback-text">Tumblr</span></a></li>
                                    <li><a class="social-icons__link" href="#" target="_blank"
                                            title="Belle Multipurpose Bootstrap 4 Template on YouTube"><i
                                                class="icon icon-youtube"></i> <span
                                                class="icon__fallback-text">YouTube</span></a></li>
                                    <li><a class="social-icons__link" href="#" target="_blank"
                                            title="Belle Multipurpose Bootstrap 4 Template on Vimeo"><i
                                                class="icon icon-vimeo-alt"></i> <span
                                                class="icon__fallback-text">Vimeo</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="site-footer">
                <div class="container">
                    <!--Footer Links-->
                    <div class="footer-top">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-3 col-lg-3 footer-links">
                                <h4 class="h4">Quick Shop</h4>
                                <ul>
                                    <li><a href="#">Women</a></li>
                                    <li><a href="#">Men</a></li>
                                    <li><a href="#">Kids</a></li>
                                    <li><a href="#">Sportswear</a></li>
                                    <li><a href="#">Sale</a></li>
                                </ul>
                            </div>
                            <div class="col-12 col-sm-12 col-md-3 col-lg-3 footer-links">
                                <h4 class="h4">Informations</h4>
                                <ul>
                                    <li><a href="#">About us</a></li>
                                    <li><a href="#">Careers</a></li>
                                    <li><a href="#">Privacy policy</a></li>
                                    <li><a href="#">Terms &amp; condition</a></li>
                                    <li><a href="#">My Account</a></li>
                                </ul>
                            </div>
                            <div class="col-12 col-sm-12 col-md-3 col-lg-3 footer-links">
                                <h4 class="h4">Customer Services</h4>
                                <ul>
                                    <li><a href="#">Request Personal Data</a></li>
                                    <li><a href="#">FAQ's</a></li>
                                    <li><a href="#">Contact Us</a></li>
                                    <li><a href="#">Orders and Returns</a></li>
                                    <li><a href="#">Support Center</a></li>
                                </ul>
                            </div>
                            <div class="col-12 col-sm-12 col-md-3 col-lg-3 contact-box">
                                <h4 class="h4">Contact Us</h4>
                                <ul class="addressFooter">
                                    <li><i class="icon anm anm-map-marker-al"></i>
                                        <p>55 Gallaxy Enque,<br>2568 steet, 23568 NY</p>
                                    </li>
                                    <li class="phone"><i class="icon anm anm-phone-s"></i>
                                        <p>(440) 000 000 0000</p>
                                    </li>
                                    <li class="email"><i class="icon anm anm-envelope-l"></i>
                                        <p>sales@yousite.com</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--End Footer Links-->
                    <hr>
                    <div class="footer-bottom">
                        <div class="row">
                            <!--Footer Copyright-->
                            <div
                                class="col-12 col-sm-12 col-md-6 col-lg-6 order-1 order-md-0 order-lg-0 order-sm-1 copyright text-sm-center text-md-left text-lg-left">
                                <span></span> <a href="templateshub.net">Templates Hub</a>
                            </div>
                            <!--End Footer Copyright-->
                            <!--Footer Payment Icon-->
                            <div
                                class="col-12 col-sm-12 col-md-6 col-lg-6 order-0 order-md-1 order-lg-1 order-sm-0 payment-icons text-right text-md-center">
                                <ul class="payment-icons list--inline">
                                    <li><i class="icon fa fa-cc-visa" aria-hidden="true"></i></li>
                                    <li><i class="icon fa fa-cc-mastercard" aria-hidden="true"></i></li>
                                    <li><i class="icon fa fa-cc-discover" aria-hidden="true"></i></li>
                                    <li><i class="icon fa fa-cc-paypal" aria-hidden="true"></i></li>
                                    <li><i class="icon fa fa-cc-amex" aria-hidden="true"></i></li>
                                    <li><i class="icon fa fa-credit-card" aria-hidden="true"></i></li>
                                </ul>
                            </div>
                            <!--End Footer Payment Icon-->
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!--End Footer-->

        <!--Scoll Top-->
        <span id="site-scroll"><i class="icon anm anm-angle-up-r"></i></span>
        <!--End Scoll Top-->

        <!-- Including Jquery -->
        <script src="{{ asset('frontend_assets/js/vendor/modernizr-3.6.0.min.js') }} "></script>
        <script src="{{ asset('frontend_assets/js/vendor/jquery.cookie.js') }} "></script>
        <script src="{{ asset('frontend_assets/js/vendor/wow.min.js') }} "></script>
        <!-- Including Javascript -->
        <script src="{{ asset('frontend_assets/js/bootstrap.min.js') }} "></script>
        <script src="{{ asset('frontend_assets/js/plugins.js') }} "></script>
        <script src="{{ asset('frontend_assets/js/popper.min.js') }} "></script>
        <script src="{{ asset('frontend_assets/js/lazysizes.js') }} "></script>
        <script src="{{ asset('frontend_assets/js/main.js') }} "></script>

        @yield('script')

    </div>
</body>

</html>

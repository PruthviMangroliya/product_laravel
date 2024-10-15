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

</head>

<body class="template-index belle template-index-belle">
    <!-- <div id="pre-loader">
        <img src="{{ asset('frontend_assets/images/loader.gif') }}" alt="Loading..." />
    </div> -->

    <div class="pageWrapper">

        <div class="search">
            <div class="search__form">
                <form class="search-bar__form" action="#">
                    <button class="go-btn search__button" type="submit"><i class="icon anm anm-search-l"></i></button>
                    <input class="search__input" type="search" name="q" value="" placeholder="Search entire store..." aria-label="Search" autocomplete="off">
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
                        <span class="user-menu d-block d-lg-none"><i class="anm anm-user-al" aria-hidden="true"></i></span>
                        <ul class="customer-links list-inline">
                            @if(!Session::has('customer'))
                            <li><a href="{{ url('customer_login')}}">Login</a></li>
                            <li><a href="{{ url('customer_register')}}">Create Account</a></li>
                            @else
                            <li><a href="{{ url('frontend/customers_order')}}">My Orders</a></li>
                            <li><a href="{{ url('customer_logout')}}">Log Out</a></li>
                            @endif
                            <li><a href="wishlist">Wishlist</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        @if(Session::has('message'))
        <!-- <div class="alert alert-success" role="alert" style="width:100%">
            {{Session::get('item_added')}}
        </div> -->
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong> {{Session::get('message')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        @endif

        <div class="header-wrap classicHeader animated d-flex">
            <div class="container-fluid">
                <div class="row align-items-center">

                    <div class="logo col-md-2 col-lg-2 d-none d-lg-block">
                        <a href="index.html">
                            <img src="{{ asset('frontend_assets/images/logo.svg') }} " alt="Belle Multipurpose Html Template" title="Belle Multipurpose Html Template" />
                        </a>
                    </div>

                    <div class="col-2 col-sm-3 col-md-3 col-lg-8">
                        <div class="d-block d-lg-none">
                            <button type="button" class="btn--link site-header__menu js-mobile-nav-toggle mobile-nav--open">
                                <i class="icon anm anm-times-l"></i>
                                <i class="anm anm-bars-r"></i>
                            </button>
                        </div>

                        <nav class="grid__item" id="AccessibleNav">
                            <ul id="siteNav" class="site-nav medium center hidearrow">
                                <li class="lvl1 parent megamenu"><a href="{{ url('/') }}"> Home <i class="anm anm-angle-down-l"></i></a>
                                    @foreach ($categories as $category )
                                <li class="lvl1 parent megamenu"><a href="{{ url('frontend/category/'.$category->category_id) }}">{{ $category->category_name}} <i class="anm anm-angle-down-l"></i></a>
                                    <div class="megamenu style1">
                                        <ul class="grid mmWrapper">
                                            <li class="grid__item large-up--one-whole">
                                                <ul class="grid">
                                                    @foreach ($subcategories as $subcategory )
                                                    @if($subcategory->category_id == $category->category_id)
                                                    <li class="grid__item lvl-1 col-md-3 col-lg-3"><a href="{{ url('frontend/subcategory/'.$subcategory->subcategory_id) }}" class="site-nav lvl-1">{{$subcategory->subcategory_name}}</a> </li>
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
                            <a href="index.html">
                                <img src="{{ asset('frontend_assets/images/logo.svg') }}" alt="Belle Multipurpose Html Template" title="Belle Multipurpose Html Template" />
                            </a>
                        </div>
                    </div>

                    <div class="col-4 col-sm-3 col-md-3 col-lg-2">
                        <div class="site-cart">
                            <a href="#;" class="site-header__cart" title="Cart">
                                <i class="icon anm anm-bag-l"></i>
                                <span id="CartCount" class="site-header__cart-count" data-cart-render="item_count">{{ (!empty($cart_data)?count($cart_data):'0') }}</span>
                            </a>

                            <!--Minicart Popup-->
                            <div id="header-cart" class="block block-cart">
                                @if(!empty($cart_data))
                                <ul class="mini-products-list">
                                    <?php $total = 0; ?>
                                    @foreach ($cart_products as $product )
                                    <!-- {{ $quantity = $cart_data[$product->product_id ]}} -->
                                    @foreach ($product_images as $product_image)
                                    @if($product_image->product_id == $product->product_id)
                                    <?php $image = $product_image->product_image_name ?>
                                    @endif
                                    @endforeach
                                    <li class="item">
                                        <a class="product-image" href="#">
                                            <img src="{{ asset($image) }}" alt="3/4 Sleeve Kimono Dress" title="" />
                                        </a>
                                        <div class="product-details">
                                            <a href="{{ url('remove_cart',$product->product_id )}}" class="remove"><i class="anm anm-times-l" aria-hidden="true"></i></a>
                                            <a href="#" class="edit-i remove"><i class="anm anm-edit" aria-hidden="true"></i></a>
                                            <a class="pName" href="{{url('view_cart')}}">{{ $product->product_title }}</a>
                                            <div class="variant-cart">Black / XL</div>
                                            <div class="wrapQtyBtn">
                                                <div class="qtyField">

                                                    <input type="hidden" id="product_id" value="{{ $product->product_id }}">
                                                    <input type="hidden" id="product_price" value="{{$product->product_price}} ">

                                                    <span class="label">Qty:</span>
                                                    <a class="qtyBtn minus" href="javascript:void(0);"><i class="fa anm anm-minus-r" aria-hidden="true"></i></a>
                                                    <input type="text" id="Quantity" name="quantity" value="{{$cart_data[$product->product_id ]}}" class="product-form__input qty">
                                                    <a class="qtyBtn plus" href="javascript:void(0);"><i class="fa anm anm-plus-r" aria-hidden="true"></i></a>

                                                </div>
                                            </div>
                                            <div class="priceRow">
                                                <div class="product-price">
                                                    <span class="money">{{$product->product_price}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <?php $total += ($product->product_price * $cart_data[$product->product_id]) ?>
                                    @endforeach

                                </ul>
                                <div class="total">
                                    <div class="total-in">
                                        <span class="label">Cart Subtotal:</span><span class="product-price"><span class="money">{{ $total }}</span></span>
                                    </div>
                                    <div class="buttonSet text-center">
                                        <a href="{{ url('view_cart')}}" class="btn btn-secondary btn--small">View Cart</a>
                                        <a href="{{ url('checkout')}}" class="btn btn-secondary btn--small">Checkout</a>
                                    </div>
                                </div>
                                @else
                                <h3> Cart is empty </h3>
                                @endif

                            </div>
                            <!--EndMinicart Popup-->

                        </div>
                        <div class="site-header__search">
                            <button type="button" class="search-trigger"><i class="icon anm anm-search-l"></i></button>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <!--End Header-->
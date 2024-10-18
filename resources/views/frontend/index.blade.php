@extends('frontend.FrontLayout')

@section('title')
    {{ 'Home Page' }}
@endsection

@section('content')

<div id="page-content">
    <!--Home slider-->
    <div class="slideshow slideshow-wrapper pb-section sliderFull">
        <div class="home-slideshow">
            <div class="slide">
                <div class="blur-up lazyload bg-size">
                    <img class="blur-up lazyload bg-img" data-src="{{ asset('frontend_assets/images/slideshow-banners/belle-banner1.jpg') }}" src="{{ asset('frontend_assets/images/slideshow-banners/belle-banner1.jpg') }} " alt="Shop Our New Collection" title="Shop Our New Collection" />
                    <div class="slideshow__text-wrap slideshow__overlay classic bottom">
                        <div class="slideshow__text-content bottom">
                            <div class="wrap-caption center">
                                <h2 class="h1 mega-title slideshow__title">Shop Our New Collection</h2>
                                <span class="mega-subtitle slideshow__subtitle">From Hight to low, classic or modern. We have you covered</span>
                                <span class="btn">Shop now</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="slide">
                <div class="blur-up lazyload bg-size">
                    <img class="blur-up lazyload bg-img" data-src="{{ asset('frontend_assets/images/slideshow-banners/home11-grid-banner2.jpg') }}" src="{{ asset('frontend_assets/images/slideshow-banners/home11-grid-banner2.jpg') }} " alt="Summer Collection" title="Summer Collection" />
                    <div class="slideshow__text-wrap slideshow__overlay classic bottom">
                        <div class="slideshow__text-content bottom">
                            <div class="wrap-caption center">
                                <h2 class="h1 mega-title slideshow__title">Summer Collection</h2>
                                <span class="mega-subtitle slideshow__subtitle">Save up to 50% off this weekend only</span>
                                <span class="btn">Shop now</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Home slider-->

    <!--category collect slider-->
    <div class="collection-box section">
        <div class="container-fluid">
            <div class="collection-grid">
                @foreach ($categories as $category )
                <div class="collection-grid-item">
                    <a href="{{ url('frontend/category/'.$category->category_id) }}" class="collection-grid-item__link">
                        <img data-src="{{ asset($category->category_image) }} " src="{{ asset($category->category_image) }} " alt="{{ $category->category_name }}" height="400px" style="padding:10px" />
                        <div class="collection-grid-item__title-wrapper">
                            <h3 class="collection-grid-item__title btn btn--secondary no-border">{{ $category->category_name }}</h3>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!--End category collect slider-->


    <!--letest product tab slider  -->
    <div class="tab-slider-product section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="section-header text-center">
                        <h2 class="h2">New Arrivals</h2>
                        <p>Browse the huge variety of our products</p>
                    </div>
                    <div class="tabs-listing">
                        <ul class="tabs clearfix">
                            <li class="active" rel="tab1">Women</li>
                            <li rel="tab2">Men</li>
                            <li rel="tab3">Sale</li>
                        </ul>
                        <div class="tab_container">
                            <div id="tab1" class="tab_content grid-products">
                                <div class="productSlider">
                                    @foreach ($leatest_products as $product)
                                    <div class="col-12 item">

                                        <div class="product-image">

                                            <a href="{{ url('frontend/product/'.$product->product_id) }}">

                                                @foreach ($product_images as $product_image )
                                                @if($product_image->product_id == $product->product_id)
                                                <img class=" primary blur-up lazyload" data-src="{{ asset($product_image->product_image_name) }}" src="{{ asset($product_image->product_image_name) }}" alt="image" title="product" height="400px" width="300px">

                                                <img class="hover blur-up lazyload" data-src="{{ asset($product_image->product_image_name) }}" src="{{ asset($product_image->product_image_name) }}" alt="image" title="product" height="400px" width="300px">

                                                @endif
                                                @endforeach
                                                <div class="product-labels rectangular"><span class="lbl on-sale">-16%</span> <span class="lbl pr-label1">new</span></div>

                                            </a>

                                            <div class="saleTime desktop" data-countdown="2024-10-01"></div>


                                            <form class="variants add" action="{{ url('add_to_cart',$product->product_id)}}" method="post">
                                                @csrf
                                                <button class="btn" type="submit" value="{{$product->product_id}}">Add To Cart</button>
                                            </form>

                                            <div class="button-set">
                                                <a href="javascript:void(0)" title="Quick View" class="quick-view-popup quick-view" data-toggle="modal" data-target="#content_quickview">
                                                    <i class="icon anm anm-search-plus-r"></i>
                                                </a>
                                                <div class="wishlist-btn">
                                                    <a class="wishlist add-to-wishlist" href="wishlist.html">
                                                        <i class="icon anm anm-heart-l"></i>
                                                    </a>
                                                </div>
                                                <div class="compare-btn">
                                                    <a class="compare add-to-compare" href="compare.html" title="Add to Compare">
                                                        <i class="icon anm anm-random-r"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="product-details text-center">

                                            <div class="product-name">
                                                <a href="{{ url('frontend/product/'.$product->product_id) }}">{{ $product->product_title}}</a>
                                            </div>

                                            <div class="product-price">
                                                <span class="price">₹ {{ $product->product_price }}</span>
                                            </div>

                                            <ul class="swatches">
                                                @foreach ($product_images as $product_image )
                                                @if($product_image->product_id == $product->product_id)
                                                <li class="swatch medium rounded"><img src="{{ asset($product_image->product_image_name) }} " alt="image" height="40px" width="40px"></li>
                                                @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    @endforeach

                                </div>
                            </div>
                            <div id="tab2" class="tab_content grid-products">
                                <div class="productSlider">
                                    <div class="col-12 item">
                                        <!-- start product image -->
                                        <div class="product-image">
                                            <!-- start product image -->
                                            <a href="">
                                                <!-- image -->
                                                <img class="primary blur-up lazyload" data-src="{{ asset('frontend_assets/images/product-images/product-image6.jpg') }} " src="{{ asset('frontend_assets/images/product-images/product-image6.jpg') }} " alt="image" title="product">
                                                <!-- End image -->
                                                <!-- Hover image -->
                                                <img class="hover blur-up lazyload" data-src="{{ asset('frontend_assets/images/product-images/product-image6-1.jpg') }} " src="{{ asset('frontend_assets/images/product-images/product-image6-1.jpg') }} " alt="image" title="product">
                                                <!-- End hover image -->
                                                <!-- product label -->
                                                <div class="product-labels rectangular"><span class="lbl on-sale">-16%</span> <span class="lbl pr-label1">new</span></div>
                                                <!-- End product label -->
                                            </a>
                                            <!-- end product image -->

                                            <!-- Start product button -->
                                            <form class="variants add" action="#" onclick="window.location.href='cart.html'" method="post">
                                                <button class="btn btn-addto-cart" type="button" tabindex="0">Add To Cart</button>
                                            </form>
                                            <div class="button-set">
                                                <a href="javascript:void(0)" title="Quick View" class="quick-view-popup quick-view" data-toggle="modal" data-target="#content_quickview">
                                                    <i class="icon anm anm-search-plus-r"></i>
                                                </a>
                                                <div class="wishlist-btn">
                                                    <a class="wishlist add-to-wishlist" href="wishlist.html">
                                                        <i class="icon anm anm-heart-l"></i>
                                                    </a>
                                                </div>
                                                <div class="compare-btn">
                                                    <a class="compare add-to-compare" href="compare.html" title="Add to Compare">
                                                        <i class="icon anm anm-random-r"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <!-- end product button -->
                                        </div>
                                        <!-- end product image -->

                                        <!--start product details -->
                                        <div class="product-details text-center">
                                            <!-- product name -->
                                            <div class="product-name">
                                                <a href="short-description.html">Zipper Jacket</a>
                                            </div>
                                            <!-- End product name -->
                                            <!-- product price -->
                                            <div class="product-price">
                                                <span class="price">$788.00</span>
                                            </div>
                                            <!-- End product price -->

                                            <div class="product-review">
                                                <i class="font-13 fa fa-star"></i>
                                                <i class="font-13 fa fa-star"></i>
                                                <i class="font-13 fa fa-star"></i>
                                                <i class="font-13 fa fa-star-o"></i>
                                                <i class="font-13 fa fa-star-o"></i>
                                            </div>
                                        </div>
                                        <!-- End product details -->
                                    </div>

                                </div>
                            </div>
                            <div id="tab3" class="tab_content grid-products">
                                <div class="productSlider">
                                    <div class="col-12 item">
                                        <!-- start product image -->
                                        <div class="product-image">
                                            <!-- start product image -->
                                            <a href="short-description.html">
                                                <!-- image -->
                                                <img class="primary blur-up lazyload" data-src="assets/images/product-images/product-image11.jpg" src="assets/images/product-images/product-image11.jpg" alt="image" title="product">
                                                <!-- End image -->
                                                <!-- Hover image -->
                                                <img class="hover blur-up lazyload" data-src="assets/images/product-images/product-image11-1.jpg" src="assets/images/product-images/product-image11-1.jpg" alt="image" title="product">
                                                <!-- End hover image -->
                                            </a>
                                            <!-- end product image -->

                                            <!-- Start product button -->
                                            <form class="variants add" action="#" onclick="window.location.href='cart.html'" method="post">
                                                <button class="btn btn-addto-cart" type="button" tabindex="0">Add To Cart</button>
                                            </form>
                                            <div class="button-set">
                                                <a href="javascript:void(0)" title="Quick View" class="quick-view-popup quick-view" data-toggle="modal" data-target="#content_quickview">
                                                    <i class="icon anm anm-search-plus-r"></i>
                                                </a>
                                                <div class="wishlist-btn">
                                                    <a class="wishlist add-to-wishlist" href="wishlist.html">
                                                        <i class="icon anm anm-heart-l"></i>
                                                    </a>
                                                </div>
                                                <div class="compare-btn">
                                                    <a class="compare add-to-compare" href="compare.html" title="Add to Compare">
                                                        <i class="icon anm anm-random-r"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <!-- end product button -->
                                        </div>
                                        <!-- end product image -->

                                        <!--start product details -->
                                        <div class="product-details text-center">
                                            <!-- product name -->
                                            <div class="product-name">
                                                <a href="short-description.html">Azur Bracelet in Blue Azurite</a>
                                            </div>
                                            <!-- End product name -->
                                            <!-- product price -->
                                            <div class="product-price">
                                                <span class="price">$168.00</span>
                                            </div>
                                            <!-- End product price -->

                                            <div class="product-review">
                                                <i class="font-13 fa fa-star"></i>
                                                <i class="font-13 fa fa-star"></i>
                                                <i class="font-13 fa fa-star"></i>
                                                <i class="font-13 fa fa-star-o"></i>
                                                <i class="font-13 fa fa-star-o"></i>
                                            </div>
                                        </div>
                                        <!-- End product details -->
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end letest product tab slider  -->


    <div class="section logo-section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="logo-bar">
                        <div class="logo-bar__item">
                            <img src="{{ asset('frontend_assets/images/logo/brandlogo1.png') }} " alt="" title="" />
                        </div>
                        <div class="logo-bar__item">
                            <img src="{{ asset('frontend_assets/images/logo/brandlogo2.png') }} " alt="" title="" />
                        </div>
                        <div class="logo-bar__item">
                            <img src="{{ asset('frontend_assets/images/logo/brandlogo3.png') }} " alt="" title="" />
                        </div>
                        <div class="logo-bar__item">
                            <img src="{{ asset('frontend_assets/images/logo/brandlogo4.png') }} " alt="" title="" />
                        </div>
                        <div class="logo-bar__item">
                            <img src="{{ asset('frontend_assets/images/logo/brandlogo5.png') }} " alt="" title="" />
                        </div>
                        <div class="logo-bar__item">
                            <img src="{{ asset('frontend_assets/images/logo/brandlogo6.png') }} " alt="" title="" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- popular products -->
    <div class="product-rows section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="section-header text-center">
                        <h2 class="h2">Featured collection</h2>
                        <p>Our most popular products based on sales</p>
                    </div>
                </div>
            </div>
            <div class="grid-products">
                <div class="row">
                    @foreach ($products as $product)
                    <div class="col-6 col-sm-6 col-md-4 col-lg-4 item grid-view-item style2">
                        <div class="grid-view_image">

                            <a href="{{ url('frontend/product/'.$product->product_id) }}" class="grid-view-item__link">

                                @foreach ($product_images as $key => $product_image )
                                @if($product_image->product_id == $product->product_id )

                                <img class="grid-view-item__image primary blur-up lazyload" data-src="{{ asset($product_image->product_image_name) }} " src="{{ asset($product_image->product_image_name) }} " alt="image" height="500px" width="100px">

                                <img class="grid-view-item__image hover blur-up lazyload" data-src="{{ asset($product_image->product_image_name) }} " src="{{asset($product_image->product_image_name) }} " alt="image" height="500px" width="100px">

                                @endif

                                @endforeach

                            </a>

                            <div class="product-details hoverDetails text-center mobile">
                                <div class="product-name">
                                    <a href="product-accordion.html">{{ $product->product_title}}</a>
                                </div>

                                <div class="product-price">
                                    <span class="price">{{ $product->product_price}}</span>
                                </div>

                                <div class="button-set">
                                    <a href="javascript:void(0)" title="Quick View" class="quick-view-popup quick-view" data-toggle="modal" data-target="#content_quickview">
                                        <i class="icon anm anm-search-plus-r"></i>
                                    </a>
                                    <form class="variants add" action="{{ url('add_to_cart',$product->product_id)}}" method="post">
                                        @csrf
                                        <button class="btn cartIcon btn-addto-cart" type="submit" tabindex="0"><i class="icon anm anm-bag-l"></i></button>
                                    </form>
                                    <div class="wishlist-btn">
                                        <a class="wishlist add-to-wishlist" href="wishlist.html">
                                            <i class="icon anm anm-heart-l"></i>
                                        </a>
                                    </div>
                                    <div class="compare-btn">
                                        <a class="compare add-to-compare" href="compare.html" title="Add to Compare">
                                            <i class="icon anm anm-random-r"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <ul class="swatches text-center">
                                @foreach ($product_images as $product_image )
                                @if($product_image->product_id == $product->product_id)
                                <li class="swatch medium rounded"><img src="{{ asset($product_image->product_image_name) }} " alt="image" height="40px" width="40px"></li>
                                @endif
                                @endforeach
                            </ul>

                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <!-- popular products -->

</div>

@endsection


@section('script')

<script>
    $(document).ready(function() {
        $(".add_to_cart").click(function() {
            $.ajax({
                url: "{{ url('add_to_cart')}}",
                method: "POST",
                data: {
                    "_token": "{{ @csrf_token() }}",
                    product_id: $(this).val()
                }
            })
        })
    })
</script>

@endsection
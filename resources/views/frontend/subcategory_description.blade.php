@extends('frontend.FrontLayout')

@section('title')
    {{ 'Subcategory Description' }}
@endsection

@section('content')

    <div id="page-content">
        <!--subcategory banner-->
        <div class="section imgBanners">
            <div class="imgBnrOuter">
                <div class="container" style="align-items:center">
                    <div class="row">
                        @foreach ($subcategories as $subcategory)
                            <div class="text-center">
                                <div class="img-bnr">
                                    <div class="inner center">
                                        <a href="{{ url('frontend/subcategory/' . $subcategory->subcategory_id) }}">
                                            <img data-src="{{ asset($subcategory->subcategory_image) }} "
                                                src="{{ asset($subcategory->subcategory_image) }} " alt="Cap"
                                                title="Cap" class="blur-up lazyload" />
                                            <span class="ttl">{{ $subcategory->subcategory_name }}</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!--End subcategory banner-->

        <!--products of category-->
        <div class="section featured-column">
            <div class="container">

                @if ($products != '')
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="section-header text-center">
                            </div>
                        </div>
                    </div>


                    <div id="tab1" class="tab_content grid-products">
                        <div class="productSlider">
                            @foreach ($products as $product)
                                <div class="col-12 item">

                                    <div class="product-image">

                                        <a href="{{ url('frontend/product/' . $product->product_id) }}">

                                            @foreach ($product_images as $product_image)
                                                @if ($product_image->product_id == $product->product_id)
                                                    <img class=" primary blur-up lazyload"
                                                        data-src="{{ asset($product_image->product_image_name) }}"
                                                        src="{{ asset($product_image->product_image_name) }}" alt="image"
                                                        title="product" height="400px" width="300px">

                                                    <img class="hover blur-up lazyload"
                                                        data-src="{{ asset($product_image->product_image_name) }}"
                                                        src="{{ asset($product_image->product_image_name) }}" alt="image"
                                                        title="product" height="400px" width="300px">
                                                @endif
                                            @endforeach

                                        </a>
                                    </div>

                                    <h3 class="h4"><a href="#">{{ $product->product_title }}</a></h3>
                                    <div class="rte-setting">
                                        <?php echo $product->product_description; ?>
                                    </div>
                                    <button class="btn btn-addto-cart" type="button">Add To Cart</button>

                                </div>
                            @endforeach

                        </div>
                    </div>
                @else
                    <h1>There is no product</h1>
                @endif
            </div>
        </div>
    </div>
    <!--End products of category-->

    <!--Latest Blog-->
    <div class="latest-blog section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="section-header text-center">
                        <h2 class="h2">Latest From our Blog</h2>
                        <p>Describe your products,collection, content etc...</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="wrap-blog">
                        <a href="blog-left-sidebar.html" class="article__grid-image">
                            <img src="{{ asset('frontend_assets/images/blog/post-img1.jpg')}}" alt="It's all about how you wear"
                                title="It's all about how you wear" class="blur-up lazyloaded" />
                        </a>
                        <div class="article__grid-meta article__grid-meta--has-image">
                            <div class="wrap-blog-inner">
                                <h2 class="h3 article__title">
                                    <a href="blog-left-sidebar.html">It's all about how you wear</a>
                                </h2>
                                <span class="article__date">May 02, 2017</span>
                                <div class="rte article__grid-excerpt">
                                    I must explain to you how all this mistaken idea of denouncing pleasure and praising
                                    pain was born and I will give you a complete account...
                                </div>
                                <ul class="list--inline article__meta-buttons">
                                    <li><a href="blog-article.html">Read more</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="wrap-blog">
                        <a href="blog-left-sidebar.html" class="article__grid-image">
                            <img src="{{ asset('frontend_assets/images/blog/post-img2.jpg')}}" alt="27 Days of Spring Fashion Recap"
                                title="27 Days of Spring Fashion Recap" class="blur-up lazyloaded" />
                        </a>
                        <div class="article__grid-meta article__grid-meta--has-image">
                            <div class="wrap-blog-inner">
                                <h2 class="h3 article__title">
                                    <a href="blog-right-sidebar.html">27 Days of Spring Fashion Recap</a>
                                </h2>
                                <span class="article__date">May 02, 2017</span>
                                <div class="rte article__grid-excerpt">
                                    Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                                    laudantium, totam rem aperiam, eaque ipsa quae ab...
                                </div>
                                <ul class="list--inline article__meta-buttons">
                                    <li><a href="blog-article.html">Read more</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Latest Blog-->

    </div>
    <!--End Body Content-->

@endsection

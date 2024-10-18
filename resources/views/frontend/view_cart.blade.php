@extends('frontend.FrontLayout')

@section('title')
    {{ 'Home Page' }}
@endsection

@section('content')

    <div id="page-content">
        <div class="tab-slider-product section">
            <div class="container">
                <br><br><br><br><br>

                <div class="row">
                    <h1 id="stock"></h1>

                    @if (!empty($cart_data))
                        <table class="table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Product Title </th>
                                    <th>Product Option</th>
                                    <th>Category Name </th>
                                    <th>Sub Category Name </th>
                                    <th>Product Price </th>
                                    <th>Product Quantity </th>
                                    <th>Product Images</th>
                                    <th>Total price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php $total = 0; ?>
                                    @foreach ($cart_products as $product)
                                        <?php $total += $product->product_price * $cart_data[$product->product_id]; ?>

                                        @foreach ($cart_product_images as $product_image)
                                            @if ($product_image->product_id == $product->product_id)
                                                <?php $image = $product_image->product_image_name; ?>
                                            @endif
                                        @endforeach

                                        <td><button class="btn btn-danger">
                                                <a href="{{ url('remove_cart', $product->product_id) }}"
                                                    style="color: white;">X</a>
                                            </button>
                                        </td>
                                        <td>{{ $product->product_title }} </td>
                                        <td>
                                            @if (!empty($cart_product_option_data[$product->product_id]))
                                                @foreach ($cart_product_option_data[$product->product_id] as $product_id => $product_option)
                                                    @foreach ($options as $option)
                                                        @if (isset($product_option[$option->option_name]))
                                                            {{ $option->option_name . ' : ' . $product_option[$option->option_name] }}
                                                            <br>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>{{ $product->category_name }} </td>
                                        <td>{{ $product->subcategory_name }} </td>
                                        <td>{{ $product->product_price }} </td>
                                        <td>
                                            <div class="qtyField">
                                                <input type="hidden" id="product_id" value="{{ $product->product_id }}">
                                                <input type="hidden"
                                                    id="product_price"value="{{ $product->product_price }} ">
                                                <input type="hidden"
                                                    id="qty"value="{{ $product->product_quantity }} ">
                                                <input type="hidden"
                                                    id="pricing"value="{{ $product->product_price * $cart_data[$product->product_id] }}">

                                                <a class="qtyBtn minus" href="javascript:void(0);" name="submit"><i
                                                        class="fa anm anm-minus-r" aria-hidden="true"></i></a>
                                                <input type="text" id="quantity" name="quantity"
                                                    value="{{ $cart_data[$product->product_id] }} "
                                                    class="product-form__input qty">
                                                <a class="qtyBtn plus" href="javascript:void(0);" name="submit"><i
                                                        class="fa anm anm-plus-r" aria-hidden="true"></i>
                                                </a>

                                            </div>
                                        </td>

                                        <td> <a href="{{ asset($image) }}"> <img src="{{ asset($image) }}" alt=""
                                                    width="200px" height="120px"></a></td>

                                        <td id="product_total">
                                            {{ $product->product_price * $cart_data[$product->product_id] }}
                                        </td>

                                </tr>
                    @endforeach
                    </tbody>
                    </table>

                    <div class="g">
                        <input type="hidden" id="g_total" value="{{ $total }}">

                        Total :
                        <h3 class="g_total" value="{{ $total }}"> {{ $total }}</h3>

                        <a href="{{ url('checkout') }}"><button class="btn">Check Out</button></a>
                    </div>
                    @endif

                </div>
                <br><br>

            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {

            var request_autocomplete=jQuery.ajax({});

            $('.qtyBtn').click(function() {

                var product_id = $(this).closest("tr").find("#product_id").val();

                var quantity = $(this).closest("tr").find("#quantity").val();

                var price = $(this).closest("tr").find("#product_price").val();

                var g_total = $("#g_total").val();

                var pricing = $(this).closest("tr").find("#pricing").val();

                var product_total = price * quantity;
                console.log(product_total);
                $("#pricing").html('product_total');
                $(this).closest("tr").find("#product_total").html(product_total);

                var new_total = (g_total - pricing) + product_total;
                $(".g_total").html(new_total);

                
                request_autocomplete.abort();
                request_autocomplete = $.ajax({
                    type: 'POST',
                    url: '{{ url('update_cart_quantity') }}',
                    data: {
                        "_token": "{{ @csrf_token() }}",
                        'product_id': product_id,
                        'quantity': quantity,
                        'product_price': price
                    },
                    success: function(response) {

                        //----aya lakhvathi ak saathe badha ma show thay che------------
                        // $('.qtyBtn').closest("tr").find("#pricing").html(product_total);

                        // $("#g_total").load("#g_total");

                    }

                });

            });

            $('.qty').on('change', (function() {

                var product_id = $(this).closest("tr").find("#product_id").val();

                var quantity = $(this).closest("tr").find("#quantity").val();

                var price = $(this).closest("tr").find("#product_price").val();

                var g_total = $("#g_total").val();

                var pricing = $(this).closest("tr").find("#pricing").val();

                var product_total = price * quantity;
                console.log(product_total);
                $("#pricing").html('product_total');
                // $(this).closest("tr").find("#pricing").html(product_total);

                var new_total = (g_total - pricing) + product_total;
                $(".g_total").html(new_total);


                $.ajax({
                    type: 'POST',
                    url: '{{ url('update_cart_quantity') }}',
                    data: {
                        "_token": "{{ @csrf_token() }}",
                        'product_id': product_id,
                        'quantity': quantity,
                        'product_price': price
                    },
                    success: function(response) {

                        //----aya lakhvathi ak saathe banne ma show thay che------------
                        // $('.qtyBtn').closest("tr").find("#pricing").html(product_total);

                        // $("#g_total").load("#g_total");

                    }
                });
            }));
        })
    </script>
@endsection

@extends('backend.layout')

@section('title')
{{"Product List"}}
@endsection

@section('content')

<style>
    .splide__slide img {
        width: 100%;
        height: auto;
    }
</style>


<main id="main" class="main">

    <div class="pagetitle">
        <h1>Product</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Product</li>
                <li class="breadcrumb-item active">Product List</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Product List</h5>
                        <button class="btn btn-primary"><a href="<?php echo url('add_product') ?>" style="color:white">Add Product</a></button>
                        <br><br>

                        <form method="GET">
                            <input type="text" class="col-sm-5" name=s_txt id="s_txt" value="<?php echo @$s_txt ?>" placeholder="search">
                            <button class="btn btn-primary" name="search">Search</button>
                            <button class="btn btn-primary"><a href="<?php echo url('product_list') ?>" style="color:white;">Reset</a></button>
                        </form>
                        <form method="POST">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="select_all"></th>
                                        <th>Product Name </th>
                                        <th>Product Price </th>
                                        <th>Product Quantity </th>
                                        <th>Category Name </th>
                                        <th>Sub Category Name </th>
                                        <th>Product Description </th>
                                        <th></th>
                                        <th> <button class="btn btn-danger" name="del_all">Delete Selected</button></th>
                                        <th>Product Images</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                    <tr>
                                        <td><input type="checkbox" name="checked_id[]" class="checkbox" value=" {{ $product->product_id}}"></td>
                                        <td>{{ $product->product_title}}</td>
                                        <td>{{ $product->product_price}}</td>
                                        <td>{{ $product->product_quantity}}</td>
                                        <td>{{ $product->category_id }}</td>
                                        <td>{{ $product->subcategory_id }}</td>
                                        <td><?php echo $product->product_description ?></td>
                                        <td><button class="btn btn-primary"><a href="<?php echo url('edit_product/' . $product->product_id) ?>" style="color: white;">edit</a></button></td>
                                        <td><button class="btn btn-danger"><a href="<?php echo url('delete_product/' . $product->product_id) ?>" style="color: white;">delete</a></button></td>
                                        <td>
                                            <div style="display: flex;">
                                                @foreach ($product_image as $image )
                                                @if ($image->product_id == $product->product_id)
                                                <img src="{{asset($image->product_image_name)}}" alt="nj" height="100px" width="150px" style="padding:10px">

                                                @endif
                                                @endforeach
                                                
                                            </div>
                                        </td>
                                         </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
    $(document).ready(function() {
        //=======select all par click karvathi badha select & deselect Thay==================
        $("#select_all").click(function() {
            if (this.checked) {
                $('.checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $('.checkbox').each(function() {
                    this.checked = false;
                });
            }
        });

        //===========badha select karvathi selecte all select thay

        $('.checkbox').on('click', function() {
            //console.log($(".checkbox").length);
            //console.log($(".checkbox:checked").length)

            if ($(".checkbox:checked").length == $(".checkbox").length) {
                $("#select_all").prop('checked', true);
            } else {
                $("#select_all").prop('checked', false);
            }
        });
    })
</script>

@endsection
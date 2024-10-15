@extends('backend.layout')

@section('title')
    {{ 'Edit Product ' }}
@endsection

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item">Product</li>
                    <li class="breadcrumb-item active">Add Product</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Add Product</h5>

                            <form class="row g-3" method="post" name="product_form" enctype="multipart/form-data">
                                <!-- <input type="" name="_token" value="{{ csrf_token() }}"> -->
                                @csrf
                                <div class="col-12">
                                    <label for="product_title" class="form-label">Product Title</label>
                                    <input type="text" name="product_title" value="{{ $product->product_title }}"
                                        class="form-control" id="product_title">

                                    @error('product_title')
                                        <span style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="product_description" class="form-label">product description</label>
                                    <textarea name="product_description" value="" class="form-control" id="product_description" required>
                                    {{ $product->product_description }}
                                    </textarea>
                                    @error('product_description')
                                        <span style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="product_price" class="form-label">product price</label>
                                    <input type="text" name="product_price" value="{{ $product->product_price }}"
                                        class="form-control" id="product_price">

                                    @error('product_price')
                                        <span style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="product_quantity" class="form-label">product quantity</label>
                                    <input type="text" name="product_quantity" value="{{ $product->product_quantity }}"
                                        class="form-control" id="product_quantity" required>
                                </div>

                                <div class="col-12">
                                    <label for="category_id" class="form-label">product Category</label>
                                    <select name="category_id" id="" class="form-control" required>
                                        <option value="">-----Select Category---------</option>
                                        @foreach ($category as $c)
                                            <option value="{{ $c->category_id }}"
                                                {{ $product->category_id == $c->category_id ? 'selected' : '' }}>
                                                {{ $c->category_name }} </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="subcategory_id" class="form-label">product Sub Category</label>
                                    <select name="subcategory_id" id="subcategory_id" class="form-control" required>
                                        <option value="">--------Select Sub subCategory---------</option>
                                        @foreach ($subcategory as $s)
                                            <option value="{{ $s->subcategory_id }} "
                                                {{ $product->subcategory_id == $s->subcategory_id ? 'selected' : '' }}>
                                                {{ $s->subcategory_name }} </option>
                                        @endforeach
                                    </select>
                                    @error('subcategory_id')
                                        <span style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="product_images" class="form-label">product Images</label>
                                    <input type="file" name="product_images[]" class="form-control" id="product_images"
                                        multiple>
                                    @error('product_images')
                                        <span style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div style="display:flex;">
                                    @foreach ($product_image as $image)
                                        @if ($image->product_id == $product->product_id)
                                            <div>
                                                <img src="{{ asset($image->product_image_name) }}" alt="nj"
                                                    height="100px" width="150px" style="padding:10px">
                                                <button type="button" class="btn btn-danger img_remove"
                                                    value="{{ $image->product_image_id }}" style="height: 40px;">X</button>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>

                                <h3>Add attributes to this product </h3>
                                <div class="col-12" style="display: flex">
                                    <div class="col-6">
                                        <label for="attribute_id" class="form-label">Select Product attribute</label>
                                        <select name="attribute_ids[]" id="attribute" class="form-control attribute"
                                            multiple="multiple">
                                            @foreach ($product_attribute as $p)
                                                {{ $attribute_ids[] = $p['attribute_id'] }}
                                            @endforeach

                                            @foreach ($attribute as $key => $c)
                                                <option value="{{ $c->attribute_id }}"
                                                    {{ !empty($attribute_ids) ? (in_array($c->attribute_id, $attribute_ids) ? 'selected' : '') : '' }}>
                                                    {{ $c->attribute_name }} </option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div> {{-- attribute --}}

                                <h4>Add Option to this product</h4>
                                <div class="col-12" style="display: flex">
                                    <div class="col-6">
                                        <label for="option_id" class="form-label">Select Product Option</label>
                                        <select name="options[]" id="options" class="form-control options"
                                            multiple="multiple">

                                            @foreach ($product_option as $p)
                                                {{ $option_ids[] = $p['option_id'] }}
                                            @endforeach
                                            @foreach ($options as $option)
                                                <option value="{{ $option->option_id }}"
                                                    {{ !empty($option_ids) ? (in_array($option->option_id, $option_ids) ? 'selected' : '') : '' }}>
                                                    {{ $option->option_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{-- alredy added option_values --}}
                                <div class="col-12">

                                    <div class="form-control">
                                        @foreach ($product_option as $p)
                                            <h4>{{ $p->option_name }} Status : </h4>
                                            <b>Enable</b> <input type="radio" name="option_status_{{ $p->option_id }}"
                                                value="enable" {{ $p->option_status == 'enable' ? 'checked' : '' }}>
                                            &emsp;
                                            <b>Disable</b> <input type="radio" name="option_status_{{ $p->option_id }}"
                                                value="disable" {{ $p->option_status == 'disable' ? 'checked' : '' }}>
                                            &emsp;
                                        @endforeach
                                    </div>

                                    @if (!empty($product_option_values[0]))
                                        <table class="table">
                                            <thead>
                                                <th></th>
                                                <th class="col-2"> Option Value </th>
                                                <th class="col-2"> Option Value Price</th>
                                                <th> Option Value Status</th>
                                                <th></th>
                                            </thead>
                                        </table>

                                        <button type="button" class="btn btn-secondary" id="add_option_value"
                                            style="position: relative; left:50rem; top:-54px">+</button>


                                        @foreach ($product_option_values as $i => $value)
                                            <div class="col-12 form-control">

                                                <input type="hidden" id="i" value="{{ $i }}">

                                                <input type="hidden" name="option_value_id[]"
                                                    value="{{ $value->option_value_id }} ">

                                                <input class="col-2" type="text" name="option_value[]" disabled
                                                    value="{{ $value->option_value }} "> &emsp;&emsp;

                                                <input class="col-2" type="text" name="option_value_price[]"
                                                    value="{{ $value->option_value_price }}"> &emsp;

                                                Enable <input type="radio"
                                                    name="option_value_status_{{ $i }}" value="enable"
                                                    {{ $value->option_value_status == 'enable' ? 'checked' : '' }}> &emsp;
                                                Disable <input type="radio"
                                                    name="option_value_status_{{ $i }}" value="disable"
                                                    {{ $value->option_value_status == 'disable' ? 'checked' : '' }}>
                                                &emsp;

                                                <button type="button" class="btn btn-danger " id="remove"> X
                                                </button>

                                            </div>
                                        @endforeach
                                    @endif

                                    <div class="option_values">
                                    </div>

                                </div>

                                {{-- <div class="add_options">

                                    <table class="table">

                                        <thead>
                                            <th class="col-2"> Option Value </th>
                                            <th class="col-2"> Option Value Price</th>
                                            <th> Option Value Status</th>
                                        </thead>

                                    </table>

                                    <div class="form-control">

                                        <select name="option_value[]" class="col-2">
                                            @foreach ($option_values as $i => $values)
                                                <option value="{{ $values->option_value }}"> {{ $values->option_value }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <input class="col-2 " type="text" name="option_value_price[]" value="">
                                        &emsp;

                                        Enable <input type="radio"
                                            name="option_value_status_{{ $value->option_value_id }} " value="enable"
                                            checked> &emsp;
                                        Disable <input type="radio"
                                            name="option_value_status_{{ $value->option_value_id }} " value="disable">
                                        &emsp;

                                        <button type="button" class="btn btn-danger " id="remove"> X
                                        </button>
                                    </div>
                                </div> --}}

                                <div class="text-center">
                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" name="reset" class="btn btn-secondary">Reset</button>
                                </div>
                            </form>

                            {{-- <!-- Modal -->
                        <div class="modal fade" id="add_new_attribute" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="">Add New Attribute </h5>
                                    </div>
                                    <form action="{{ url('save_new_attribute')}}" method="post" name="new_attribute_form">
                                        @csrf
                                        <div class="modal-body">
                                            <div>
                                                <label for="new_attribute" class="form-label">Attribute Name</label>
                                                <input type="text" name="new_attribute" class="form-control" id="new_attribute">

                                                <!-- <div class="options">
                                                    <br>
                                                    <h4>Add Option to Attributes </h4>

                                                    <button type="button" class="btn btn-primary" id="new_attribute_options_btn">Add Option</button>
                                                    <div class="new_attribute_options">
                                                        <table class="table">
                                                            <thead>
                                                                <th> Option Name </th>
                                                                <th> Option Status </th>
                                                                <th></th>
                                                            </thead>
                                                        </table>
                                                        <input type="text" name="new_attribute_option_name[]">
                                                        Enable <input type="radio" name="new_attribute_option_status_1" value="enable"> &emsp;
                                                        Disable <input type="radio" name="new_attribute_option_status_1" value="disable" checked>

                                                    </div>
                                                </div> -->
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> --}}

                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    {{-- Ck editor --}}
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('product_description');
    </script>

    {{-- multi select attribute andoptin --}}
    <script>
        $(".attribute").select2({
            tags: true,
            placeholder: '-----Select attribute---------'
        })

        $(".options").select2({
            tags: true,
            placeholder: '-----Select Options---------'
        })
    </script>

    {{-- image delete and add option value --}}
    <script>
        $(document).ready(function() {

            //----------------- image delete--------------------
            $(".img_remove").click(function() {
                img_id = $(this).val()
                console.log(img_id)
                $this = $(this);
                $.ajax({
                    url: "{{ url('delete_image') }}",
                    method: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        img_id,
                    },
                    success: function(data) {
                        $this.closest("div").remove();
                    }
                });
            })

            //----------------- add option_value----------------- 
            $("#options").on('change', function() {
                // alert($("#attribute").val());    
                @if (empty($product_option_values[0]))
                    $.ajax({
                        url: "{{ url('get_option_values') }}",
                        method: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            option_id: $("#options").val()
                        },
                        success: function(data) {
                            $(".option_values").html(data);
                        }
                    });
                @endif
            })

            $(".option_values").on("click", "#remove", function() {
                this.closest('div').remove();
            })


            // $(".add_options").on("click", "#remove", function() {
            //     option_id = $(this).val()
            //     $this = $(this);

            //     if (option_id == "") {
            //         this.closest('div').remove();
            //     } else {
            //         $.ajax({
            //             url: "{{ url('delete_option') }}",
            //             method: "POST",
            //             data: {
            //                 "_token": "{{ csrf_token() }}",
            //                 option_id: option_id
            //             },
            //             success: function(data) {
            //                 $this.closest('div').remove();
            //             }
            //         });
            //     }


            // })
        })
    </script>

    {{-- add fields of option_vales on click of '+'  --}}
    <script>
        $(document).ready(function() {

            i = 0

            $("#add_option_value").on('click', function() {
                console.log(i);
                $('.option_values').append(

                    '<div class="col-12 form-control">' +

                    '<select name="add_option_value_id[]" class="col-2">' +
                    '@foreach ($option_values as $i => $values)' +
                    '    <option value="{{ $values->option_value_id }}"> {{ $values->option_value }}' +
                    '    </option>' +
                    '@endforeach' +
                    '</select>' +

                    '&emsp;&emsp;&emsp;' +
                    '<input class="col-2" type="text" name="add_option_value_price[]"> &emsp;' +

                    '<input type="hidden" value="' + i + '" name=status_num[]>' +

                    'Enable <input type="radio" name="add_option_value_status_' + i +
                    '" value="enable">' +
                    '&emsp;' +
                    'Disable <input type="radio" name="add_option_value_status_' + i +
                    '" value="disable">' +
                    '&emsp;&emsp;' +

                    '<button type="button" class="btn btn-danger " id="remove"> X </button>' +
                    '<br>' +
                    '</div>'
                )
                i++;
            })


        })
    </script>

@endsection

@extends('backend.layout')

@section('title')
    {{ 'Add Product ' }}
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
                                    <input type="text" name="product_title" class="form-control" id="product_title"
                                        value="{{ old('product_title') }}">
                                    @error('product_title')
                                        <span style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="product_description" class="form-label">product description</label>
                                    <textarea name="product_description" class="form-control" id="product_description">{{ old('product_description') }}</textarea>
                                    @error('product_description')
                                        <span style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="product_price" class="form-label">product price</label>
                                    <input type="text" name="product_price" class="form-control" id="product_price"
                                        value="{{ old('product_price') }}">
                                    @error('product_price')
                                        <span style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="product_quantity" class="form-label">product quantity</label>
                                    <input type="text" name="product_quantity" class="form-control" id="product_quantity"
                                        value="{{ old('product_quantity') }}">
                                    @error('product_quantity')
                                        <span style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="category_id" class="form-label">product Category</label>
                                    <select name="category_id" id="" class="form-control">
                                        <option value="">-----Select Category---------</option>
                                        @foreach ($category as $c)
                                            <option value="<?php echo $c->category_id; ?>"><?php echo $c->category_name; ?></option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="subcategory_id" class="form-label">product Sub Category</label>
                                    <select name="subcategory_id" id="subcategory_id" class="form-control">
                                        <option value="">--------Select Sub subCategory---------</option>
                                        @foreach ($subcategory as $s)
                                            <option value="<?php echo $s->subcategory_id; ?>"><?php echo $s->subcategory_name; ?></option>
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


                                <h3>Add attributes to this product </h3>
                                <div class="col-12" style="display: flex">
                                    <div class="col-6">
                                        <label for="attribute_id" class="form-label">Select Product attribute</label>
                                        <select name="attribute_ids[]" id="attributes" class="form-control attributes"
                                            multiple="multiple">
                                            @foreach ($attribute as $c)
                                                <option value="{{ $c->attribute_id }}">{{ $c->attribute_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <h4>Add Option</h4>

                                {{-- //-----------check box option display --}}
                                {{-- @foreach ($options as $option)
                                    <div class="col-12">
                                        <label for="option_id" class="form-label">{{ $option->option_name }}</label>

                                        <input type="checkbox" value="{{ $option->option_id }}" name="option_id[]"
                                            class="optioin_id">

                                        <div class="form-control" hidden>
                                            <h4>opton Status : </h4>
                                            <b>Enable</b> <input type="radio"
                                                name="option_status_{{ $option->option_id }}" value="enable" checked>
                                            &emsp;
                                            <b> Disable </b><input type="radio"
                                                name="option_status_{{ $option->option_id }}" value="disable">
                                            &emsp;

                                        </div>

                                        <table class="table" hidden>

                                            <thead>
                                                <th></th>
                                                <th class="col-2"> Option Value </th>
                                                <th class="col-2"> Option Value Price</th>
                                                <th> Option Value Status</th>
                                                <th></th>
                                            </thead>
                                        </table>

                                        @foreach ($option_values as $value)
                                            @if ($value->option_id == $option->option_id)
                                                <div class="col-12 option_values form-control" hidden>

                                                    <input type="hidden" name="option_value_id[]"
                                                        value="{{ $value->option_value_id }} "> &emsp;

                                                    <input class="col-2" type="text" name="option_value_name[]"
                                                        disabled value="{{ $value->option_value }} "> &emsp;

                                                    <input class="col-2" type="text" name="option_value_price[]"
                                                        value=""> &emsp;

                                                    Enable <input type="radio"
                                                        name="option_value_status_{{ $value->option_value_id }}"
                                                        value="enable" checked> &emsp;
                                                    Disable <input type="radio"
                                                        name="option_value_status_{{ $value->option_value_id }}"
                                                        value="disable"> &emsp;

                                                    <button type="button" class="btn btn-danger " id="remove"> X
                                                    </button>

                                                </div>
                                            @endif
                                        @endforeach

                                        <br>
                                    </div>
                                @endforeach --}}

                                <div class="col-12" style="display: flex">
                                    <div class="col-6">
                                        <label for="option_id" class="form-label">Select Product Option</label>
                                        <select name="options[]" id="options" class="form-control options"
                                            multiple="multiple">
                                            @foreach ($options as $option)
                                                <option value="{{ $option->option_id }}">{{ $option->option_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{-- to dispay option status --}}
                                <div class="options_status"></div>

                                <table class="table" hidden>
                                    <thead>
                                        <th></th>
                                        <th class="col-2"> Option Value </th>
                                        <th class="col-2"> Option Value Price</th>
                                        <th> Option Value Status</th>
                                        <th></th>
                                    </thead>
                                </table>

                                {{-- to display option value --}}
                                <div class="option_values"></div>



                                {{-- <div class="col-12">

                                    <div class="form-control" >
                                        <h4>opton Status : </h4>
                                        <b>Enable</b> <input type="radio" name="option_status_{{ $option->option_id }}"
                                            value="enable" checked>
                                        &emsp;
                                        <b> Disable </b><input type="radio"
                                            name="option_status_{{ $option->option_id }}" value="disable">
                                        &emsp;

                                    </div>

                                    <table class="table" >
                                        <thead>
                                            <th></th>
                                            <th class="col-2"> Option Value </th>
                                            <th class="col-2"> Option Value Price</th>
                                            <th> Option Value Status</th>
                                            <th></th>
                                        </thead>
                                    </table>

                                    @foreach ($option_values as $value)
                                        @if ($value->option_id == $option->option_id)
                                            <div class="col-12 option_values form-control" >

                                                <input type="hidden" name="option_value_id[]"
                                                    value="{{ $value->option_value_id }} "> &emsp;

                                                <input class="col-2" type="text" name="option_value_name[]" disabled
                                                    value="{{ $value->option_value }} "> &emsp;

                                                <input class="col-2" type="text" name="option_value_price[]"
                                                    value=""> &emsp;

                                                Enable <input type="radio"
                                                    name="option_value_status_{{ $value->option_value_id }}"
                                                    value="enable" checked> &emsp;
                                                Disable <input type="radio"
                                                    name="option_value_status_{{ $value->option_value_id }}"
                                                    value="disable"> &emsp;

                                                <button type="button" class="btn btn-danger " id="remove"> X
                                                </button>

                                            </div>
                                        @endif
                                    @endforeach
                                    <br>
                                </div> --}}

                                <div class="text-center">
                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" name="reset" class="btn btn-secondary">Reset</button>
                                </div>
                            </form>

                            <!-- Modal -->
                            {{-- <div class="modal fade" id="add_new_attribute" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="">Add New Attribute </h5>
                                    </div>

                                    <form action="save_new_attribute" method="post">
                                        <div class="modal-body">
                                            <div>
                                                <label for="new_attribute" class="form-label">Attribute Name</label>
                                                <input type="text" name="new_attribute" class="form-control" id="new_attribute">
                                                @csrf
                                                <div class="options">
                                                    <br>
                                                   
                                                </div>
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

    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('product_description');
    </script>

    <script>
        $(".attributes").select2({
            tags: true,
            placeholder: '-----Select attribute---------'
        })

        $(".options").select2({
            tags: true,
            placeholder: '-----Select Options---------'
        })
    </script>

    <script>
        $(document).ready(function() {
            let text = "";
            // --------------- to get option value on multi select --------------------------
            $("#options").on('change', function() {

                $.ajax({
                    url: "get_option_values",
                    method: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        option_id: $("#options").val()
                    },
                    success: function(data) {
                        // $(".option_values").html(data);
                        console.log(data);

                        $(".table").removeAttr('hidden')
                        $('.options_status').empty();
                        $('.option_values').empty();

                        data['options'].forEach(element => {
                            option_id = element['option_id']
                            option_name = element['option_name']


                            options_status = '<div class="form-control">' +
                                '<h4>' + option_name + ' Status : </h4>' +
                                '<b>Enable</b> ' +
                                '<input type="radio" name="option_status_' + option_id +
                                '"' +
                                'value="enable" checked>' +
                                '&emsp;' +
                                '<b> Disable </b>' +
                                '<input type="radio"  name="option_status_' +
                                option_id +
                                '" value="disable">' +
                                '&emsp;' +
                                '</div>' +
                                '<br>'


                            // console.log(options_status)
                            $('.options_status').append(options_status)
                        });


                        data['option_values'].forEach(function(element, index) {

                            option_value_id = element['option_value_id']
                            option_value = element['option_value']
                            option_name = element['option_name']

                            var option_values =
                                '<div class="col-12 form-control" >' +

                                '<input class="col-2" type="text" name="add_option_ids[]" disabled value="' +
                                option_name + ' "> &emsp;' +

                                '<input type="hidden" name="add_option_value_id[]" value="' +
                                option_value_id + ' "> &emsp;' +

                                '<input class="col-2" type="text" name="add_option_value_name[]" disabled value="' +
                                option_value + ' "> &emsp;' +

                                '<input class="col-2" type="text" name="add_option_value_price[]" value=""> &emsp;' +

                                '<input type="hidden" value="' + index + '" name="status_num[]">' +

                                'Enable ' +
                                '<input type="radio" name="add_option_value_status_' +
                                index + '" value="enable" checked> &emsp;' +

                                'Disable ' +
                                '<input type="radio" name="add_option_value_status_' +
                                index + '" value="disable"> &emsp;' +

                                '<button type="button" class="btn btn-danger " id="remove"> X </button>' +

                                '</div>' +
                                '<br> '

                            console.log(option_values)

                            $('.option_values').append(option_values)
                        });

                    }
                });
            });

        function myfunction(item, index) {
            text += index + ": " + item['option_name'] + "<br>";
        }

        $(".option_values").on("click", "#remove", function() {
        this.closest('div').remove();
        })

        // --------------- to get option value on checkbox --------------------------

        // $(".optioin_id").on('click', function() {

        //     if (this.checked) {

        //         // console.log('checked')
        //         $(this).parent('div').children("div").removeAttr('hidden');
        //         $(this).parent('div').children(".table").removeAttr('hidden')

        //     } else {
        //         // console.log('unchecked')
        //         $(this).parent('div').children("div").attr('hidden', true);
        //         $(this).parent('div').children(".table").attr('hidden', true);
        //     }

        // })

        // $(".option_values").on("click", "#remove", function() {
        //     this.closest('div').remove();
        // })
        })
    </script>

     
    {{-- <script>
        $(document).ready(function() {
            $("#options").on('change', function() {
                $.ajax({
                    url: "get_option_values",
                    method: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        option_id: $("#options").val()
                    },
                    success: function(data) {
                        $('.option_values_table').removeAttr('hidden');
                        $('.options_status').empty();
                        $('.option_values').empty();

                        const options = data['options'];
                        const optionValues = data['option_values'];

                        // Append options status
                        options.forEach(function(element) {
                            const option_id = element['option_id'];
                            const option_name = element['option_name'];

                            const options_status = `
                                <div class="form-control">
                                    <h4>${option_name} Status:</h4>
                                    <b>Enable</b> 
                                    <input type="radio" name="option_status_${option_id}" value="enable" checked> 
                                    &emsp;
                                    <b>Disable</b> 
                                    <input type="radio" name="option_status_${option_id}" value="disable">
                                    &emsp;
                                </div>
                                <br>
                            `;
                            $('.options_status').append(options_status);
                        });

                        // Append option values
                        optionValues.forEach(function(element, index) {
                            const option_value_id = element['option_value_id'];
                            const option_value = element['option_value'];
                            const option_name = element['option_name'];

                            const option_values = `
                                <tr class="option_values">
                                    <td>
                                        <input type="hidden" name="add_option_ids[]" value="${option_value_id}">
                                        <input class="form-control" type="text" name="add_option_value_name[]" disabled value="${option_name}">
                                    </td>
                                    <td>
                                        <input class="form-control" type="text" name="add_option_value_name[]" disabled value="${option_value}">
                                    </td>
                                    <td>
                                        <input class="form-control" type="text" name="add_option_value_price[]" value="">
                                    </td>
                                    <td>
                                        <input type="hidden" value="${index}" name="status_num[]">
                                        <label>
                                            <input type="radio" name="add_option_value_status_${index}" value="enable" checked> Enable
                                        </label>
                                        <label>
                                            <input type="radio" name="add_option_value_status_${index}" value="disable"> Disable
                                        </label>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger remove-option-value">X</button>
                                    </td>
                                </tr>
                            `;
                            $('.option_values').append(option_values);
                        });
                    }
                });
            });

            $(document).on('click', '.remove-option-value', function() {
                $(this).closest('tr').remove();
            });
        });
    </script> --}}
@endsection

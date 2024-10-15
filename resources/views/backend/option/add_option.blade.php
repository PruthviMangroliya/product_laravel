@extends('backend.layout')

@section('title')
    {{ 'Add Attribute' }}
@endsection

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item">Attribute</li>
                    <li class="breadcrumb-item active">Add Attributes</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Add Attribute</h5>

                            <!-- Vertical Form -->
                            <form class="row g-3" method="post" enctype="multipart/form-data">
                                <!-- <input type="" name="_token" value="{{ csrf_token() }}"> -->
                                @csrf

                                <div class="col-12">
                                    <label for="option_name" class="form-label">option Name</label>
                                    <input type="text" name="option_name" class="form-control"
                                        value="{{ old('option_name') }}">
                                    @error('option_name')
                                        <span style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <br>
                                    <button type="button" class="btn btn-primary" id="add_option_value_btn">
                                        Add Option Value
                                    </button>

                                    <div class="option_values">

                                    </div>


                                </div>


                                <div class="text-center">
                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" name="reset" class="btn btn-secondary">Reset</button>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>

    <script>
        $(document).ready(function() {
            i = 1;

            $("#add_option_value_btn").click(function() {

                $(".option_values").append(
                    '<div class="form-control">' +

                    '<input type="text" name="option_values[]"  class="col-6"> &emsp;' +

                    '<button type="button" class="btn btn-danger " id="remove" >X</button>' +

                    '</div>' +

                    '<br>')
                i++;
            })

            $(".option_values").on("click", "#remove", function() {
                this.closest('div').remove();
                i--;
            })
        })
    </script>
@endsection
{{-- '<div>' +

    '<input type="hidden"  value="' + i + '" name="values_number[]" >' +

    '<input type="text" name="option_values[]"  class="col-6"> &emsp;' +

    'Enable <input type="radio" name="option_status_' + i + '" value="enable"> &emsp;' +

    'Disable <input type="radio" name="option_status_' + i + '" value="disable" checked> &emsp;&emsp;' +

    '<button type="button" class="btn btn-danger " id="remove" >X</button>' +

'</div>'+ --}}

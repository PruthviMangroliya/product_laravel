@extends('backend.layout')

@section('title')
    {{ 'Edit Option' }}
@endsection

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Form Layouts</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Option</li>
                    <li class="breadcrumb-item active">Edit Option</li>
                </ol>
            </nav>
        </div>

        <section class="section">

            <div class="row">

                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Edit Option</h5>

                            <form class="row g-3" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="col-12">
                                    <label for="inputNanme4" class="form-label">Option Name</label>
                                    <input type="text" name="option_name" value="{{ $option->option_name }}"
                                        class="form-control">
                                        @error('option_name')
                                        <span style="color:red">{{ $message }}</span>
                                    @enderror
                                    <br>
                                </div>

                                <div class="col-12">
                                    <br>
                                    <button type="button" class="btn btn-primary" id="add_option_value_btn">
                                        Add Option Value
                                    </button>

                                    <div class="option_values">

                                        @foreach ($option_value as $value)

                                            <div class="form-control">
                                                <input type="hidden" name="option_value_ids[]" value="{{ $value->option_value_id }}">
                                                <input type="text" name="option_values[]"
                                                    value="{{ $value->option_value }}" class="col-6"> &emsp;

                                                <button type="button" class="btn btn-danger " id="remove">X</button>
                                            </div>
                                        @endforeach
                                    </div>


                                </div>

                                <div class="text-center">
                                    <button type="submit" name="submit" class="btn btn-primary">Update</button>
                                    <button name="discard" class="btn btn-secondary">Discard</button>
                                </div>
                            </form>

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

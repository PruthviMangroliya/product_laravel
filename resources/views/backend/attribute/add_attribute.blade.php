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
                                    <label for="attribute_name" class="form-label">Attribute Name</label>
                                    <input type="text" name="attribute_name" class="form-control"
                                        value="{{ old('attribute_name') }}">
                                    @error('attribute_name')
                                        <span style="color:red">{{ $message }}</span>
                                    @enderror
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
@endsection

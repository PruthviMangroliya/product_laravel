@extends('backend.layout')

@section('title')
{{"Add Category"}}
@endsection

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item">Category</li>
                <li class="breadcrumb-item active">Add Categories</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add Category</h5>

                        <!-- Vertical Form -->
                        <form class="row g-3" method="post" enctype="multipart/form-data">
                            <!-- <input type="" name="_token" value="{{ csrf_token() }}"> -->
                            @csrf
                            <div class="col-12">
                                <label for="category_name" class="form-label">Category Name</label>
                                <input type="text" name="category_name" class="form-control" value="{{ old('category_name')}}">
                                @error('category_name')
                                <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="category_image" class="form-label">category Images</label>
                                <input type="file" name="category_image" class="form-control" id="category_image">
                                @error('category_image')
                                <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="text-center">
                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" name="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form><!-- Vertical Form -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main>

@endsection
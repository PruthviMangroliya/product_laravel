@extends('backend.layout')

@section('title')
    {{ 'Edit Category' }}
@endsection

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Form Layouts</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">category</li>
                    <li class="breadcrumb-item active">Edit Category</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">

            <div class="row">

                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Edit category</h5>

                            <form class="row g-3" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="col-12">
                                    <label for="inputNanme4" class="form-label">category Name</label>
                                    <input type="text" name="category_name" value="<?php echo $category->category_name; ?>"
                                        class="form-control">
                                    @error('category_name')
                                        <span style="color:red">{{ $message }}</span>
                                    @enderror
                                    <br>
                                </div>
                                <div class="col-12">
                                    {{-- <label for="category_image" class="form-label">subcategory Images</label>
                                    <input type="file" name="category_image" class="form-control" id="category_image">
                                    @error('category_image')
                                        <span style="color:red">{{ $message }}</span>
                                    @enderror --}}

                                    <img src="{{ asset($category->category_image) }}" alt="" height="200px"
                                        width="200px">
                                </div>

                                <div class="text-center">
                                    <button type="submit" name="submit" class="btn btn-primary">Update</button>
                                    <button name="discard" class="btn btn-secondary">Discard</button>
                                </div>
                            </form>
                            <!-- ---------discard button------- -->
                            <?php
                        if (isset($_POST["discard"])) {
                        ?>
                            <script>
                                window.location.href = 'view_category.php';
                            </script>
                            <?php
                        }
                        ?>
                        </div>
                    </div>
        </section>

    </main>
@endsection

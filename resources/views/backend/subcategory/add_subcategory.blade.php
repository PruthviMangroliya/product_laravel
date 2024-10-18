@extends('backend.layout')

@section('title')
    {{ 'Add Sub Category' }}
@endsection

@section('content')

    <main id="main" class="main">

        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item">Sub Category</li>
                    <li class="breadcrumb-item active">Add Subcategories</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Add subCategory</h5>

                            <!-- Vertical Form -->
                            <form class="row g-3" method="post" enctype="multipart/form-data">
                                <!-- <input type="" name="_token" value="{{ csrf_token() }}"> -->
                                @csrf
                                <div class="col-12">
                                    <select name="category_id" id="" class="form-control">
                                        <option value="">Select Category</option>
                                        <?php foreach ($category as $c) { ?>
                                        <option value="<?php echo $c->category_id; ?>"><?php echo $c->category_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="subcategory_name" class="form-label">subCategory Name</label>
                                    <input type="text" name="subcategory_name" class="form-control" id="subcategory_name"
                                        required>
                                </div>
                                <div class="col-12">
                                    <label for="subcategory_image" class="form-label">subcategory Images</label>
                                    <input type="file" name="subcategory_image" class="form-control"
                                        id="subcategory_image">
                                    @error('subcategory_image')
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

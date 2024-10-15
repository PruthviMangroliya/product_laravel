
@extends('backend.layout')

@section('title')
    {{ 'Edit Sub Category' }}
@endsection

@section('content')

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Form Layouts</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Sub category</li>
                <li class="breadcrumb-item active">Edit Sub Category</li>
            </ol>
        </nav>
    </div>

    <section class="section">

        <div class="row">

            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Sub category</h5>

                        <form class="row g-3" method="POST" enctype="multipart/form-data">
                            @csrf
                            <?php

                            $category_id = $subcategory->category_id;
                            $subcategory_name = $subcategory->subcategory_name;
                            ?>
                            <div class="col-12">
                                <select name="category_id" id="" class="form-control">
                                    <option value="">Select Category</option>
                                    <?php foreach ($category as $c) { ?>
                                        <option value="<?php echo $c->category_id ?>" <?php echo ($category_id == $c->category_id) ? 'selected' : '' ?>><?php echo $c->category_name ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="inputNanme4" class="form-label">subcategory Name</label>
                                <input type="text" name="subcategory_name" value="<?php echo $subcategory->subcategory_name ?>" class="form-control">
                                @error('subcategory_name')
                                <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            {{-- <div class="col-12">
                                <label for="subcategory_image" class="form-label">subcategory Images</label>
                                <input type="file" name="subcategory_image" class="form-control" id="subcategory_image">
                                @error('subcategory_image')
                                <span style="color:red">{{ $message }}</span>
                                @enderror
                                <img src="{{ asset($subcategory->subcategory_image) }}" alt="" height="200px" width="200px">
                            </div> --}}



                            <div class="text-center">
                                <button type="submit" name="submit" class="btn btn-primary">Update</button>
                                <button type="button" id="discard" class="btn btn-secondary">Discard</button>
                            </div>

                        </form>

                            <script>
                                $("#discard").on('click',function(){

                                    window.location.href = "{{ url('/subcategory_list')}}";
                                })
                            </script>
                      
                    </div>
                </div>
    </section>

</main>

@endsection
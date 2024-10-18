@extends('backend.layout')

@section('title')
    {{ 'Edit Attribute' }}
@endsection

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Form Layouts</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Attribute</li>
                    <li class="breadcrumb-item active">Edit Attribute</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">

            <div class="row">

                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Edit Attribute</h5>

                            <form class="row g-3" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="col-12">
                                    <label for="inputNanme4" class="form-label">Attribute Name</label>
                                    <input type="text" name="attribute_name" value="<?php echo $attribute->attribute_name; ?>"
                                        class="form-control">
                                    <br>
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
                                window.location.href = 'view_attribute.php';
                            </script>
                            <?php
                        }
                        ?>
                        </div>
                    </div>
        </section>

    </main>
@endsection

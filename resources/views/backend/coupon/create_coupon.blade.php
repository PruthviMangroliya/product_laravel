@extends('backend.layout')

@section('title')
    {{ 'Add Coupon' }}
@endsection

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item">Coupon</li>
                    <li class="breadcrumb-item active">Add Coupon</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Add Coupon</h5>


                            <form class="row g-3" method="post" enctype="multipart/form-data">
                                <!-- <input type="" name="_token" value="{{ csrf_token() }}"> -->
                                @csrf
                                <div class="col-12">
                                    <label for="coupon_name" class="form-label">coupon Name</label>
                                    <input type="text" name="coupon_name" class="form-control"
                                        value="{{ old('coupon_name') }}">
                                    @error('coupon_name')
                                        <span style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="coupon_name" class="form-label">coupon code</label>
                                    <input type="text" name="coupon_code" class="form-control"
                                        value="{{ old('coupon_code') }}">
                                    @error('coupon_code')
                                        <span style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-2">
                                            <label for="coupon_name" class="form-label">Discount Type</label>
                                            <select name="discount_type" id="" class="form-control">
                                                <option value="">------- select discount type -----</option>
                                                <option value="%">%</option>
                                                <option value="₹">₹</option>
                                            </select>
                                            @error('discount_type')
                                                <span style="color:red">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-6">
                                            <label for="coupon_name" class="form-label">Discount Amount</label>
                                            <input type="text" name="discount_amount" class="form-control"
                                                value="{{ old('discount_amount') }}">
                                            @error('discount_amount')
                                                <span style="color:red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="col-12">
                                    <label for="coupon_name" class="form-label">Valid For</label>
                                    <select name="apply_on[]" id="appy_on" class="form-control" multiple>

                                        <option value="all_products">All Products</option>

                                        <optgroup label="Products">
                                            @foreach ($products as $product)
                                                <option value="{{ $product->product_id }}">
                                                    {{ $product->product_title }}
                                                </option>
                                            @endforeach
                                        </optgroup>

                                    </select>
                                    @error('appy_on')
                                        <span style="color:red">{{ $message }}</span>
                                    @enderror
                                </div> --}}

                                <div class="col-2">
                                    <label for="expires_at" class="form-label">coupon Expires at</label>
                                    <input type="date" name="expires_at" class="form-control" id="expires_at">
                                    @error('expires_at')
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


    <script>
        $("#appy_on").select2({
            tags: true,
            language: "es",
            placeholder: '------ select product for coupon ------'
        })
    </script>
@endsection

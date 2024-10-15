@extends('backend.layout')

@section('title')
    {{ 'Coupon List' }}
@endsection

@section('content')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Coupon</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Coupon</li>
                    <li class="breadcrumb-item active">Coupon List</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">

                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Coupon List</h5>
                            <button class="btn btn-primary"><a href="<?php echo url('create_coupon'); ?>" style="color:white">Create
                                    Coupon</a></button>
                            <br><br>

                            <form method="POST">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="select_all"></th>

                                            <th>Coupon Name </th>
                                            <th>Coupon Code </th>
                                            <th>Discount Type </th>
                                            <th>Discount Amount </th>
                                            <th>Expires At</th>
                                            <th>Status</th>
                                        </tr>

                                    </thead>
                                    <tbody>

                                        @foreach ($coupons as $key=>$coupon)
                                            <tr>
                                                <td><input type="checkbox" name="checked_id[]" class="checkbox"
                                                        value="{{ $coupon->coupon_id }} "></td>

                                                <td>{{ $coupon->coupon_name }} </td>
                                                <td>{{ $coupon->coupon_code }} </td>
                                                <td>{{ $coupon->discount_type }} </td>
                                                <td>{{ $coupon->discount_amount }} </td>
                                                <td>{{ $coupon->expires_at}} </td>
                                                <td style="color: red">
                                                     {{ $days_left[$key] }}</td>
                                               
                                                <td> <button class="btn btn-danger"> <a
                                                            href="{{ url('delete/' . $coupon->coupon_id) }} "
                                                            style="color: white;">delete</a>
                                                        </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </form>
                        </div>
                    </div>
                </div>
                
            </div>

        </section>
    </main>

    <script>
        $(document).ready(function() {
            //=======select al par click karvathi badha select & deselect Thay==================
            $("#select_all").click(function() {
                if (this.checked) {
                    $('.checkbox').each(function() {
                        this.checked = true;
                    });
                } else {
                    $('.checkbox').each(function() {
                        this.checked = false;
                    });
                }
            });

            //===========badha select karvathi selecte all select thay

            $('.checkbox').on('click', function() {
                //console.log($(".checkbox").length);
                //console.log($(".checkbox:checked").length)

                if ($(".checkbox:checked").length == $(".checkbox").length) {
                    $("#select_all").prop('checked', true);
                } else {
                    $("#select_all").prop('checked', false);
                }
            });
        })
    </script>

@endsection

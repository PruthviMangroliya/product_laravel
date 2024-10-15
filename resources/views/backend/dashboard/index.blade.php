@extends('backend.layout')

@section('title')
    {{ 'Dashboard ' }}
@endsection

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-11">
                    <div class="row">

                        {{-- {{ print_r($permissions) }} --}}
                        @if (!empty($permissions))
                            <!-- category Card -->
                            @if (in_array('category', $permissions) || in_array('Super', $permissions) || in_array('admin', $permissions))
                                <div class="col-xxl-4 col-md-6">
                                    <div class="card info-card sales-card">

                                        <div class="card-body">
                                            <h5 class="card-title">Categories </h5>

                                            <div class="d-flex align-items-center">
                                                <div
                                                    class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                    <i class="bi bi">C</i>
                                                </div>
                                                <div class="ps-3">
                                                    <h6>{{ $category }} </h6>
                                                    <!-- <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> -->

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- End category Card -->
                            @endif
                            @if (in_array('subcategory', $permissions) || in_array('Super', $permissions) || in_array('admin', $permissions))
                                <!-- sub category Card -->
                                <div class="col-xxl-4 col-md-6">
                                    <div class="card info-card revenue-card">

                                        <div class="card-body">
                                            <h5 class="card-title">Sub Categories </h5>

                                            <div class="d-flex align-items-center">
                                                <div
                                                    class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                    <i class="bi bi-currency">S</i>
                                                </div>
                                                <div class="ps-3">
                                                    <h6>{{ $subcategory }} </h6>

                                                    <!-- <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span> -->

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- End sub category Card -->
                            @endif
                            @if (in_array('products', $permissions) || in_array('Super', $permissions) || in_array('admin', $permissions))
                                <!-- products Card -->
                                <div class="col-xxl-4 col-xl-12">

                                    <div class="card info-card customers-card">

                                        <div class="card-body">
                                            <h5 class="card-title">Products </h5>

                                            <div class="d-flex align-items-center">
                                                <div
                                                    class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                    <i class="bi bi">P</i>
                                                </div>
                                                <div class="ps-3">
                                                    <h6>{{ $product }} </h6>

                                                    <!-- <span class="text-danger small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">decrease</span> -->

                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <!-- End products Card -->
                            @endif
                            @if (in_array('orders', $permissions) || in_array('Super', $permissions) || in_array('admin', $permissions))
                                <!-- Orders Card -->
                                <div class="col-xxl-4 col-md-6">
                                    <div class="card info-card sales-card">

                                        <div class="card-body">
                                            <h5 class="card-title">Orders </h5>

                                            <div class="d-flex align-items-center">
                                                <div
                                                    class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                    <i class="bi bi-cart"></i>
                                                </div>
                                                <div class="ps-3">
                                                    <h6>{{ $orders }}</h6>
                                                    <!-- <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> -->
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- End Orders Card -->
                            @endif
                            @if (in_array('sales', $permissions) || in_array('Super', $permissions))
                                <!-- Sales Card -->
                                <div class="col-xxl-4 col-md-6">
                                    <div class="card info-card sales-card">

                                        <div class="card-body">
                                            <h5 class="card-title">Sales Data </h5>

                                            <div class="d-flex align-items-center">
                                                <div
                                                    class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                    <i class="bi bi-currency-rupee"></i>
                                                </div>
                                                <div class="ps-3">
                                                    <h6>{{ $sales_amount }}</h6>
                                                    <span class="text-success small pt-1 fw-bold">12%</span> <span
                                                        class="text-muted small pt-2 ps-1">increase</span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- End Sales Card -->
                            @endif
                            @if (in_array('customers', $permissions) || in_array('Super', $permissions) || in_array('admin', $permissions))
                                <!-- Customers Card -->
                                <div class="col-xxl-4 col-xl-12">

                                    <div class="card info-card customers-card">

                                        <div class="card-body">
                                            <h5 class="card-title">Customers </h5>

                                            <div class="d-flex align-items-center">
                                                <div
                                                    class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                    <i class="bi bi-people"></i>
                                                </div>
                                                <div class="ps-3">
                                                    <h6>{{ $customers }} </h6>

                                                    <!-- <span class="text-danger small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">decrease</span> -->

                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <!-- End Customers Card -->
                            @endif
                        @else
                        <p>You are a new user</p>
                        <p>Please wait for super admin to assign you a role to access the Admin panel</p>
                        @endif
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection

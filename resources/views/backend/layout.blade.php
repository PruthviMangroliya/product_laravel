<html>

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>@yield('title')</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon">
    <link href="{{ asset('img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }} " rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }} " rel="stylesheet">
    <link href="{{ asset('vendor/boxicons/css/boxicons.min.css') }} " rel="stylesheet">
    <link href="{{ asset('vendor/quill/quill.snow.css') }} " rel="stylesheet">
    <link href="{{ asset('vendor/quill/quill.bubble.css') }} " rel="stylesheet">
    <link href="{{ asset('vendor/remixicon/remixicon.css') }} " rel="stylesheet">
    <link href="{{ asset('vendor/simple-datatables/style.css') }} " rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- ckeditor -->
    <!-- <script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script> -->

    <!-- Modal js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>

    <!-- select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <!-- ======= Header ======= -->
    <heder id="header" class="header fixed-top d-flex align-items-center">


        <div class="d-flex align-items-center justify-content-between">
            <a href="index" class="logo d-flex align-items-center">
                <img src="{{ asset('img/logo.png') }}" alt="">
                <span class="d-none d-lg-block">KEY Logic</span>
            </a>
            <?php
            $a = Session::get('user');
            print_r($a);
            ?>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->



        <div class="search-bar">
            <form class="search-form d-flex align-items-center" method="POST" action="#">
                <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            </form>

        </div><!-- End Search Bar -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                        data-bs-toggle="dropdown">
                        <img src="{{ asset('img/profile-img.jpg') }}" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }}</span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>{{ Auth::user()->name }}</h6>
                            <span>Web Designer</span>
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ '/profile' }}">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>

                    </ul>
                </li>

            </ul>
        </nav>

    </heder>


    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <?php
        //-----getting name fof file from current url--------
        $f_name = basename($_SERVER['PHP_SELF']);
        $role = Auth::user()->role;
        $permissions= array();
        if ($role != 0) {
            $role_permissions = DB::table('role_permission')->join('permissions', 'permissions.id', '=', 'role_permission.permission_id')->where('role_id', $role)->get();

            // print_r($permissions);
            foreach ($role_permissions as $p) {

                $permissions[] = $p->permission;
               
            }
            // print_r($permissions);
        }
        ?>

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link <?php echo $f_name == 'dashboard' ? '' : 'collapsed'; ?> " href="{{ url('dashboard') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

            @if (in_array('category', $permissions )||in_array('Super', $permissions)||in_array('admin', $permissions)||in_array('add_category', $permissions))
                <li class="nav-item">
                    <a class="nav-link  <?php echo $f_name == 'add_category' || $f_name == 'category_list' ? '' : 'collapsed'; ?>" data-bs-target="#category-nav" data-bs-toggle="collapse"
                        href="#">
                        <i class="bi bi-menu-button-wide"></i><span>Category</span><i
                            class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="category-nav" class="nav-content collapse <?php echo $f_name == 'add_category' || $f_name == 'category_list' ? 'show' : ''; ?>"
                        data-bs-parent="#sidebar-nav">

                        <li>
                            <a href="{{ url('category_list') }} " <?php echo $f_name == 'category_list' ? 'class="active"' : ''; ?>>
                                <i class="bi bi-circle"></i><span>View Categories</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('add_category') }} " <?php echo $f_name == 'add_category' ? 'class="active"' : ''; ?>>
                                <i class="bi bi-circle"></i><span>Add Category</span>
                            </a>
                        </li>
                    </ul>
                </li><!-- End Category Nav -->
            @endif

            @if (in_array('subcategory', $permissions)||in_array('Super', $permissions)||in_array('admin', $permissions)||in_array('add_subcategory', $permissions))
                <li class="nav-item">
                    <a class="nav-link <?php echo $f_name == 'add_subcategory' || $f_name == 'subcategory_list' ? '' : 'collapsed'; ?>" data-bs-target="#subcategory-nav" data-bs-toggle="collapse"
                        href="#">
                        <i class="bi bi-menu-button-wide"></i><span>Sub Category</span><i
                            class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="subcategory-nav" class="nav-content collapse <?php echo $f_name == 'add_subcategory' || $f_name == 'subcategory_list' ? 'show' : ''; ?>"
                        data-bs-parent="#sidebar-nav">

                        <li>
                            <a href="{{ url('subcategory_list') }} " <?php echo $f_name == 'subcategory_list' ? 'class="active"' : ''; ?>>
                                <i class="bi bi-circle"></i><span>View Sub Category</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('add_subcategory') }} " <?php echo $f_name == 'add_subcategory' ? 'class="active"' : ''; ?>>
                                <i class="bi bi-circle"></i><span>Add Sub Category</span>
                            </a>
                        </li>

                    </ul>
                </li><!-- End Sub category Nav -->
            @endif

            @if (in_array('products', $permissions)||in_array('Super', $permissions)||in_array('admin', $permissions)||in_array('add_product', $permissions))
                <li class="nav-item">
                    <a class="nav-link <?php echo $f_name == 'add_product' || $f_name == 'product_list' || $f_name == 'edit' ? '' : 'collapsed'; ?>" data-bs-target="#product-nav" data-bs-toggle="collapse"
                        href="#">
                        <i class="bi bi-menu-button-wide"></i><span>Product</span><i
                            class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="product-nav" class="nav-content collapse <?php echo $f_name == 'add_product' || $f_name == 'product_list' || $f_name == 'edit' ? 'show' : ''; ?>"
                        data-bs-parent="#sidebar-nav">

                        <li>
                            <a href="{{ url('product_list') }}" <?php echo $f_name == 'product_list' ? 'class="active"' : ''; ?>>
                                <i class="bi bi-circle"></i><span>View Products</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('add_product') }} " <?php echo $f_name == 'add_product' ? 'class="active"' : ''; ?>>
                                <i class="bi bi-circle"></i><span>Add Product</span>
                            </a>
                        </li>

                    </ul>
                </li><!-- End product Nav -->

                <li class="nav-item">
                    <a class="nav-link  <?php echo $f_name == 'add_attribute' || $f_name == 'attribute_list' ? '' : 'collapsed'; ?>" data-bs-target="#attribute-nav"
                        data-bs-toggle="collapse" href="#">
                        <i class="bi bi-menu-button-wide"></i><span>attribute</span><i
                            class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="attribute-nav" class="nav-content collapse <?php echo $f_name == 'add_attribute' || $f_name == 'attribute_list' ? 'show' : ''; ?>"
                        data-bs-parent="#sidebar-nav">

                        <li>
                            <a href="{{ url('attribute_list') }} " <?php echo $f_name == 'attribute_list' ? 'class="active"' : ''; ?>>
                                <i class="bi bi-circle"></i><span>View attributes</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('add_attribute') }} " <?php echo $f_name == 'add_attribute' ? 'class="active"' : ''; ?>>
                                <i class="bi bi-circle"></i><span>Add attribute</span>
                            </a>
                        </li>


                    </ul>
                </li><!-- End Attribute Nav -->

                <li class="nav-item">
                    <a class="nav-link  <?php echo $f_name == 'add_option' || $f_name == 'option_list' || $f_name == 'edit_option' ? '' : 'collapsed'; ?>" data-bs-target="#option-nav" data-bs-toggle="collapse"
                        href="#">
                        <i class="bi bi-menu-button-wide"></i><span>Options</span><i
                            class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="option-nav" class="nav-content collapse <?php echo $f_name == 'add_option' || $f_name == 'option_list' || $f_name == 'edit_option' ? 'show' : ''; ?>"
                        data-bs-parent="#sidebar-nav">

                        <li>
                            <a href="{{ url('option_list') }} " <?php echo $f_name == 'option_list' ? 'class="active"' : ''; ?>>
                                <i class="bi bi-circle"></i><span>View options</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('add_option') }} " <?php echo $f_name == 'add_option' ? 'class="active"' : ''; ?>>
                                <i class="bi bi-circle"></i><span>Add option</span>
                            </a>
                        </li>


                    </ul>
                </li><!-- End option Nav -->
            @endif
            
            @if (in_array('Super', $permissions))
                <li class="nav-item">
                    <a class="nav-link  {{ $f_name == 'users' ? '' : 'collapsed' }}" href="{{ url('/users') }}">
                        <i class="bi bi-menu-button-wide"></i>
                        <span>users</span>
                    </a>
                </li><!-- End Users Nav -->

                <li class="nav-item">
                    <a class="nav-link  {{ $f_name == 'permission' ? '' : 'collapsed' }}"
                        href="{{ url('/permission') }}">
                        <i class="bi bi-menu-button-wide"></i>
                        <span>Permission</span>
                    </a>
                </li><!-- End Permission Nav -->

                <li class="nav-item">
                    <a class="nav-link  {{ $f_name == 'roles' ? '' : 'collapsed' }}" href="{{ url('/roles') }}">
                        <i class="bi bi-menu-button-wide"></i>
                        <span>Roles</span>
                    </a>
                </li><!-- End Roles Nav -->
            @endif

            @if (in_array('customer', $permissions)||in_array('Super', $permissions)||in_array('admin', $permissions))
                <li class="nav-item">
                    <a class="nav-link  {{ $f_name == 'customers' ? '' : 'collapsed' }}"
                        href="{{ url('/customers') }}">
                        <i class="bi bi-menu-button-wide"></i>
                        <span>customers</span>
                    </a>
                </li><!-- End Customer Nav -->
            @endif

            @if (in_array('order', $permissions)||in_array('Super', $permissions)||in_array('admin', $permissions))
                <li class="nav-item">
                    <a class="nav-link  {{ $f_name == 'orders' || $f_name == 'order_details' ? '' : 'collapsed' }}"
                        href="{{ url('orders') }}">
                        <i class="bi bi-menu-button-wide"></i>
                        <span>Orders</span>
                    </a>
                </li><!-- End orders Nav -->
            @endif

            @if (in_array('sales', $permissions)||in_array('Super', $permissions))
                <li class="nav-item">
                    <a class="nav-link  {{ $f_name == 'sales' ? '' : 'collapsed' }}" href="{{ url('/sales') }}">
                        <i class="bi bi-menu-button-wide"></i>
                        <span>Sales Data</span>
                    </a>
                </li><!-- End sales data Nav -->
            @endif

            @if (in_array('admin', $permissions)||in_array('Super', $permissions))
                <li class="nav-item">
                    <a class="nav-link  {{ $f_name == 'coupon' ? '' : 'collapsed' }}" href="{{ url('/coupons') }}">
                        <i class="bi bi-menu-button-wide"></i>
                        <span>Coupons</span>
                    </a>
                </li><!-- End coupon Nav -->

                <li class="nav-heading">Pages</li>
            @endif

            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-dropdown-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </li><!-- logout -->

        </ul>

    </aside>
    <main id="main">
        @if (Session::has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong> {{ Session::get('message') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </main>


    @yield('content')

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span> </span></strong>. All Rights Reserved
        </div>

    </footer>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"> <i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('js/main.js') }}"></script>

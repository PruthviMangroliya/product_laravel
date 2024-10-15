<html>

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Nicer admin</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

  <!-- select2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>

<body>

  <!-- ======= Header ======= -->
  <heder id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index" class="logo d-flex align-items-center">
        <img src="{{ asset('img/logo.png')}}" alt="">
        <span class="d-none d-lg-block">KEY Logic</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <?php
    // $email = $_SESSION['nicer_email'];
    // //echo $email;
    // $sql = "SELECT * FROM  user WHERE email='$email'";
    // $result = mysqli_query($con, $sql);
    // $row = mysqli_fetch_assoc($result);
    // $name = $row['name'];
    //echo $name;
    ?>
    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="{{ asset('img/profile-img.jpg')}}" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">{{ 'sbh'}}</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php //echo $name 
                  ?></h6>
              <span>Web Designer</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                <i class="bi bi-question-circle"></i>
                <span>Need Help?</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="logout">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav>

  </heder>

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <?php
    //-----getting name fof file from current url--------
    $f_name = basename($_SERVER['PHP_SELF']);

    ?>

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link <?php echo ($f_name == "dashboard" ? '' : 'collapsed'); ?> " href="{{ url('dashboard')}}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link  <?php echo ($f_name == "add_category" || $f_name == "category_list" ? '' : 'collapsed'); ?>" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Category</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse <?php echo ($f_name == "add_category" || $f_name == "category_list" ? 'show' : ''); ?>" data-bs-parent="#sidebar-nav">

          <li>
            <a href="{{ url('category_list')}} " <?php echo ($f_name == "category_list" ? 'class="active"' : ''); ?>>
              <i class="bi bi-circle"></i><span>View Categories</span>
            </a>
          </li>
          <li>
            <a href="{{ url('add_category')}} " <?php echo ($f_name == "add_category" ? 'class="active"' : ''); ?>>
              <i class="bi bi-circle"></i><span>Add Category</span>
            </a>
          </li>


        </ul>
      </li><!-- End Category Nav -->

      <li class="nav-item">
        <a class="nav-link <?php echo ($f_name == "add_subcategory" || $f_name == "subcategory_list" ? '' : 'collapsed'); ?>" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Sub Category</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse <?php echo ($f_name == "add_subcategory" || $f_name == "subcategory_list" ? 'show' : ''); ?>" data-bs-parent="#sidebar-nav">

          <li>
            <a href="{{ url('subcategory_list') }} " <?php echo ($f_name == "subcategory_list" ? 'class="active"' : ''); ?>>
              <i class="bi bi-circle"></i><span>View Sub Category</span>
            </a>
          </li>
          <li>
            <a href="{{ url('add_subcategory') }} " <?php echo ($f_name == "add_subcategory" ? 'class="active"' : ''); ?>>
              <i class="bi bi-circle"></i><span>Add Sub Category</span>
            </a>
          </li>

        </ul>
      </li><!-- End Sub category Nav -->

      <li class="nav-item">
        <a class="nav-link <?php echo ($f_name == "add_product" || $f_name == "product_list" || $f_name == "edit" ? '' : 'collapsed'); ?>" data-bs-target="#Tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Product</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="Tables-nav" class="nav-content collapse <?php echo ($f_name == "add_product" || $f_name == "product_list" || $f_name == "edit" ? 'show' : ''); ?>" data-bs-parent="#sidebar-nav">

          <li>
            <a href="{{ url('product_list') }}" <?php echo ($f_name == "product_list"  ? 'class="active"' : ''); ?>>
              <i class="bi bi-circle"></i><span>View Products</span>
            </a>
          </li>
          <li>
            <a href="{{ url('add_product') }} " <?php echo ($f_name == "add_product" ? 'class="active"' : ''); ?>>
              <i class="bi bi-circle"></i><span>Add Product</span>
            </a>
          </li>

        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link  {{ ($f_name == 'customers' ? '' : 'collapsed'); }}" href="{{ url('/customers')}}">
          <i class="bi bi-menu-button-wide"></i>
          <span>Customers</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link  {{ ($f_name == 'orders' || $f_name == 'order_details' ? '' : 'collapsed'); }}" href="{{ url('orders')}}">
          <i class="bi bi-menu-button-wide"></i>
          <span>Orders</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link  {{ ($f_name == 'sales' ? '' : 'collapsed'); }}" href="{{ url('/sales')}}">
          <i class="bi bi-menu-button-wide"></i>
          <span>Sales Data</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link  {{ ($f_name == 'cupoons' ? '' : 'collapsed'); }}" href="{{ url('/cupoons')}}">
          <i class="bi bi-menu-button-wide"></i>
          <span>Cupoons</span>
        </a>
      </li>

      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="logout">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Log out</span>
        </a>
      </li>
      <!-- End Login Page Nav -->


    </ul>

  </aside>
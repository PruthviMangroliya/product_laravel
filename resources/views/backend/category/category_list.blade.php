@extends('backend.layout')

@section('title')
    {{ 'Category List' }}
@endsection

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Category</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Category</li>
                    <li class="breadcrumb-item active">Category List</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">


                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Category List</h5>
                            <button class="btn btn-primary"><a href="<?php echo url('add_category'); ?>" style="color:white">Add
                                    Category</a></button>
                            <br><br>


                            <?php
                            // //=============  multi delete  ========================
                            // if (isset($_POST['del_all'])) {
                            //     if (!isset($_POST['checked_id'])) {
                            //         echo "select at least one row";
                            //     } else {
                            //         $all_id = implode(',', $_POST['checked_id']);
                            //         print_r($all_id);
                            //         echo $d_sql = "DELETE FROM category WHERE c_id IN ($all_id)";
                            //         $d_result = mysqli_query($con, $d_sql);
                            //         if ($d_result) {
                            //             //-----delete from sub category-----------------
                            //             $sql1 = "DELETE FROM `sub_category` WHERE `c_id`IN ($all_id)";
                            //             $result1 = mysqli_query($con, $sql1);
                            //             if ($result1) {
                            //                 //-----delete from images-----------------
                            //                 $sq = "SELECT * FROM product WHERE c_id IN ($all_id)";
                            //                 $res = mysqli_query($con, $sq);
                            //                 while ($row = mysqli_fetch_assoc($res)) {
                            //                     $p_id = $row['p_id'];
                            //                     $sq1 = "SELECT * FROM p_images WHERE p_id=$p_id";
                            //                     $res1 = mysqli_query($con, $sq1);
                            //                     while ($row1 = mysqli_fetch_assoc($res1)) {
                            //                         $img_name = $row1['img_name'];
                            //                         unlink("img/" . $img_name);
                            //                     }
                            //                     $sql3 = "DELETE FROM p_images WHERE p_id=$p_id";
                            //                     $result3 = mysqli_query($con, $sql3);
                            //                 }
                            
                            //                 //-----delete from Product-----------------
                            //                 $sql2 = "DELETE FROM product WHERE c_id IN ($all_id)";
                            //                 $result2 = mysqli_query($con, $sql2);
                            //                 if ($result) {
                            //                     //header("location:view_category.php");
                            //                     if ($s_txt != "") {
                            
                            //                         $sql = "SELECT * FROM  category WHERE c_name LIKE '%$s_txt%' LIMIT $stating,$limit";
                            //                     } else {
                            //                         $sql = "SELECT * FROM category LIMIT $stating,$limit";
                            //                     }
                            //                 } else {
                            //                     echo "could not delete from Product table";
                            //                     echo die($con);
                            //                 }
                            //             } else {
                            //                 echo "could not delete from Sub category";
                            //                 echo die($con);
                            //             }
                            //         } else {
                            //             echo "could not delete from category";
                            //             echo die($con);
                            //         }
                            //     }
                            // }
                            
                            // $s_txt = '';
                            // if (isset($_GET['s_txt'])) {
                            //     $s_txt = $_GET['s_txt'];
                            // }
                            
                            // //--------get page number from url------------------
                            // if (!isset($_GET['page'])) {
                            //     $i = 1;
                            // } else {
                            //     $i = $_GET['page'];
                            // }
                            
                            // //=========without search============
                            // $t_sql = "SELECT * FROM  category";
                            // $t_res = mysqli_query($con, $t_sql);
                            // $t_row = mysqli_num_rows($t_res);
                            // $t_row;
                            // $limit = 3;
                            // $t_page = ceil($t_row / $limit);
                            // $stating = ($i - 1) * $limit;
                            
                            // //=============  search or not  ========================
                            // if ($s_txt != "") {
                            //     $s_txt = $_GET['s_txt'];
                            //     $sql = "SELECT * FROM  category WHERE c_name LIKE '%$s_txt%' LIMIT $stating,$limit";
                            // } else {
                            //     $sql = "SELECT * FROM category LIMIT $stating,$limit";
                            // }
                            ?>

                            <form method="GET">
                                <input type="text" class="col-sm-5" name=s_txt id="s_txt" value="<?php echo @$s_txt; ?>"
                                    placeholder="search">
                                <button class="btn btn-primary" name="search">Search</button>
                                <button class="btn btn-primary"><a href="<?php echo url('category_list'); ?>"
                                        style="color:white;">Reset</a></button>
                            </form>
                            <form method="POST">
                                <!-- Table with stripped rows -->
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="select_all"></th>

                                            <th>Category Name </th>
                                            <th></th>
                                            <th> <button class="btn btn-danger" name="del_all">Delete Selected</button></th>
                                        </tr>

                                    </thead>
                                    <tbody>

                                        @foreach ($category as $c)
                                            <tr>
                                                <td><input type="checkbox" name="checked_id[]" class="checkbox"
                                                        value="{{ $c->category_id }} "></td>

                                                <td>{{ $c->category_name }} </td>
                                                <td><button class="btn btn-primary"><a
                                                            href="{{ url('edit_category/' . $c->category_id) }} "
                                                            style="color: white;">edit</a></button></td>
                                                <td><button class="btn btn-danger"><a
                                                            href="{{ url('delete/' . $c->category_id) }} "
                                                            style="color: white;">delete</a></button></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <div class="mt-5" style="size:20px">

                                    {{ $category->links()}}

                                </div>

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

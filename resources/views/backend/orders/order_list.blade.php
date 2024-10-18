@extends('backend.layout')

@section('title')
{{" Orders "}}
@endsection

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Orders</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Orders</li>
                <li class="breadcrumb-item active">Order List</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Order List</h5>
                        <br><br>

                        <form method="GET">
                            <input type="text" class="col-sm-5" name=s_txt id="s_txt" value="<?php echo @$s_txt ?>" placeholder="search">
                            <button class="btn btn-primary" name="search">Search</button>
                            <button class="btn btn-primary"><a href="<?php echo url('product_list') ?>" style="color:white;">Reset</a></button>
                        </form>
                        <form method="POST">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="select_all"></th>
                                        <th>Order ID </th>
                                        <th>Order Products </th>
                                        <th>Order Total </th>
                                        <th>Customer Name</th>
                                        <th>Order Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                    <tr>
                                        <td><input type="checkbox" name="checked_id[]" class="checkbox" value=" {{ $order->order_id}}"></td>
                                        <td>{{ $order->order_id}}</td>
                                        <td>{{ $order->order_products}}</td>
                                        <td>{{ $order->order_total}}</td>
                                        <td>{{ $order->customer_id }}</td>
                                        <td>@if ($order->order_status == 0)
                                            {{ 'Payment Fail ' }}
                                        @elseif ($order->order_status == 1)
                                            {{ 'confirmed' }}
                                        @elseif ($order->order_status == 2)
                                            {{ 'shipped' }}
                                        @elseif ($order->order_status == 3)
                                            {{ 'Out For Delivery' }}
                                        @elseif ($order->order_status == 4)
                                            {{ 'Delivered' }}
                                            @else
                                            {{ $order->order_status}}
                                        @endif</td>
                                        <td>
                                            <a href="order_details/{{ $order->order_id}}"><button type="button" class="btn btn-primary">Detail</button></a>
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
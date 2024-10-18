@extends('backend.layout')

@section('title')
    {{ 'Order Details ' }}
@endsection

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Order </h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Order </li>
                    <li class="breadcrumb-item active">Order Detail</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-body">
                            @foreach ($orders as $order)
                            @endforeach
                            <br>
                            <h3>#Order ID : {{ $order->order_id }}</h3>
                            <br>
                            <h5>Customer ID : {{ $order->customer_id }}</h5>
                            <h5>Customer First Name : <b>{{ $order->customer_firstname }}</b></h5>
                            <h5>Total Products Quantity : <b>{{ $order->order_products }} </b></h5>
                            <h5>Order Total : <b>{{ $order->order_total }}</b> </h5>
                            <h5>Order Status :
                                @if ($order->order_status == 'cacelled')
                                {{$order->order_status}}
                                @elseif ($order->order_status == 0)
                                {{ "Payment Fail"}}
                                @else
                                    <select name="order_status" id="order_status">
                                        <option value="1" {{ $order->order_status == '1' ? 'selected' : '' }}
                                            {{ '1' < $order->order_status ? 'disabled' : '' }}>
                                            Confirmed</option>
                                        <option value="2" {{ $order->order_status == '2' ? 'selected' : '' }}
                                            {{ '2' < $order->order_status ? 'disabled' : '' }}>
                                            Shipped</option>
                                        <option value="3" {{ $order->order_status == '3' ? 'selected' : '' }}
                                            {{ '3' < $order->order_status ? 'disabled' : '' }}> Out For Delivery
                                        </option>
                                        <option value="4" {{ $order->order_status == '4' ? 'selected' : '' }}
                                            {{ '4' < $order->order_status ? 'disabled' : '' }}>
                                            Delivered</option>
                                    </select>
                                @endif
                            </h5>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Order Detail</h5>
                            <br><br>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product ID </th>
                                        <th>Product title </th>
                                        <th>Product Price </th>
                                        <th>Product Quantity</th>
                                        <th>Product Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order_details as $order_detail)
                                        <tr>
                                            <td>{{ $order_detail->product_id }}</td>
                                            <td>{{ $order_detail->product_title }}</td>
                                            <td>{{ $order_detail->product_price }}</td>
                                            <td>{{ $order_detail->product_quantity }}</td>
                                            <td>{{ $order_detail->product_total }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </main>


    <script>
        $(document).ready(function() {
            $("#order_status").on('change', function() {

                order_status = $(this).val();
                console.log(order_status);

                $.ajax({
                    url: "{{ url('change_order_status') }}",
                    type: "POST",
                    data: {
                        "_token": "{{ @csrf_token() }}",
                        order_status: order_status,
                        order_id: "{{ $order->order_id }}"
                    }
                })
            })
        })
    </script>
@endsection

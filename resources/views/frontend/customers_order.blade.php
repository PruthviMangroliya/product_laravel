@extends('frontend.FrontLayout')

@section('title')
    {{ 'Home Page' }}
@endsection

@section('content')
    <style>
        .checkmark {
            color: #9ABC66;
            font-size: 100px;
            line-height: 200px;
            margin-left: -15px;
        }
    </style>

    <div id="page-content">
        <div class="tab-slider-product section">
            <div class="container">

                @if (Session::has('message'))
                    <div class="alert-success alert-dismissible alertDismissible" style="text-align: center;">
                        <br><br><br><br>
                        <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
                            <i class="checkmark">✓</i>
                        </div>
                        <h1>Success</h1>
                        <h3>Your payment has been successfull !!!</h3>
                        <br>
                        {{-- <h3>We received your purchase request;<br /> we'll be in touch shortly!</h3> --}}

                        <br><br><br><br>
                        {{-- <a href="{{ route('my_orders') }}"><button class="btn">View Your Orders</button></a>  --}}


                    </div>
                @endif

                @if (Session::has('failure'))
                    <div class="alert-danger alert-dismissible alertDismissible" style="text-align: center;">
                        <br><br><br><br>
                        <div style="border-radius:200px; height:200px; width:200px; background: #e62b06; margin:0 auto;">
                            <i class="checkmark">X</i>
                        </div>
                        <h1>Failed</h1>
                        <h3>Your payment could not been successfull !!!</h3>
                        <br>

                    </div>
                @endif

                @if (Session::has('cancelled'))
                    <div class="alert-danger alert-dismissible alertDismissible" style="text-align: center;">
                        <br><br><br><br>

                        {{-- <h1>Success</h1> --}}
                        <h1>Your Order has been canclled !!!</h1>
                        <br>
                        <h3>Refund of Order is successfully done <br /> You can see the refund recipt at </h3>

                        <a href="{{ Session::get('cancelled') }}"><button class="btn"> Reciept </button> </a>

                        <br><br><br><br>

                    </div>
                @endif


                <br><br><br><br><br>

                @if (!empty($orders[0]))
                    <div class="row">
                        <h1> Your Orders </h1>

                        <table class="table">
                            <thead>
                                <tr>
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
                                        <td>{{ $order->order_id }}</td>
                                        <td>{{ $order->order_products }}</td>
                                        <td>
                                            @foreach ($order_total as $total)
                                                @if ($total->order_id == $order->order_id)
                                                @endif
                                            @endforeach
                                            {{ $order->order_total }}
                                        </td>
                                        <td>{{ $order->customer_id }}</td>
                                        <td>
                                            <b>
                                                @if ($order->order_status == 0)
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
                                                    {{ $order->order_status }}
                                                @endif

                                                {{-- @if ($order->order_status == 0)
                                                    <button class="btn">retry Payment</button>
                                                @endif --}}
                                            </b>
                                        </td>
                                        <td>
                                            <a href="order_details/{{ $order->order_id }}"> <button type="button"
                                                    class="btn btn-primary"> View Order </button>
                                            </a>
                                        </td>
                                        <td>
                                            @if ($order->order_status == 1)
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#cancle_order">
                                                    cancle Corder
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="cancle_order" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="">Select The Reason Of Cancellation</h5>
                                </div>

                                <form action="{{ route('cancle_order', $order->order_id) }}" method="post">
                                    <div class="modal-body">
                                        <div>
                                            @csrf
                                            <div class="reasons">

                                                <input type="radio" name="reason" value="Not Need anymore" required>
                                                Not Need anymore
                                                <br><br>
                                                <input type="radio" name="reason" value="Wrong Product Ordered" required>
                                                Wrong Product Ordered
                                                <br><br>
                                                <input type="radio" name="reason" value="By mistake Ordered" required> By
                                                mistake Ordered
                                                <br><br>
                                                <input type="radio" name="reason" value="wrong size" required> wrong size

                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @elseif (!empty($order_details))
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Product Price</th>
                                <th>Product Quantity</th>
                                <th>Product Total</th>
                                <th>Order Status</th>
                                <th></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $total = 0; ?>
                            @foreach ($order_details as $order)
                                <h1>Order ID : {{ $order->order_id }}</h1>

                                <tr>
                                    <td>{{ $order->product_title }}</td>
                                    <td>{{ $order->product_price }}</td>
                                    <td>{{ $order->product_quantity }}</td>
                                    <td>{{ $order->product_total }}</td>
                                    <td>
                                        <b>
                                            @if ($order->order_status == 0)
                                                {{ 'Payment Fail' }}
                                            @elseif ($order->order_status == 1)
                                                {{ 'confirmed' }}
                                            @elseif ($order->order_status == 2)
                                                {{ 'shipped' }}
                                            @elseif ($order->order_status == 3)
                                                {{ 'Out For Delivery' }}
                                            @elseif ($order->order_status == 4)
                                                {{ 'Delivered' }}
                                            @endif
                                        </b>
                                    </td>

                                </tr>

                                <?php $total += $order->product_total;
                                ?>
                            @endforeach
                            <h3>Total Amount : {{ $total }}</h3>

                        </tbody>
                    </table>
                @else
                    <h1>There is no order</h1>
                @endif

            </div>
        </div>
    </div>
@endsection


@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {

            $(".alertDismissible").fadeTo(4000, 500).slideUp(500, function() {
                $(".alertDismissible").slideUp(100);
            });

            // swal("Oops", "Something went wrong!", "error")
        })
    </script>
@endsection

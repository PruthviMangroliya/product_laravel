@extends('frontend.FrontLayout')

@section('title')
    {{ 'Home Page' }}
@endsection

@section('content')

    <style>
        .coupon-card {
            background: linear-gradient(135deg, #abeb97, #af52e5);
            color: #fff;
            text-align: center;
            padding: 20px 40px;
            border-radius: 15px;
            box-shadow: 0 10px 10px 0 rgba(0, 0, 0, 0.15);
            position: relative;
            height: 8rem;
            width: 15rem;
        }
    </style>


    <div id="page-content">
        <!--Page Title-->
        <div class="page section-header text-center">
            <div class="page-title">
                <div class="wrapper">
                    <h1 class="page-width">Checkout</h1>
                </div>
            </div>
        </div>
        <!--End Page Title-->

        <div class="container">

            @if (!empty($cart_data))
                @if (Session::has('login_err'))
                    <h5 style="color: red;">{{ Session::get('login_err') }}</h5>
                @endif

                @if (!Session::has('customer'))
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
                            <div class="customer-box returning-customer">
                                <h3><i class="icon anm anm-user-al"></i> Returning customer? <a href="#customer-login"
                                        id="customer" class="text-white text-decoration-underline"
                                        data-toggle="collapse">Click here to login</a></h3>
                                <div id="customer-login" class="collapse customer-content">
                                    <div class="customer-info">
                                        <p class="coupon-text">If you have shopped with us before, please enter your details
                                            in the boxes below. If you are a new customer, please proceed to the Billing
                                            &amp; Shipping section.</p>
                                        <form name="login" method="POST" action="{{ url('customer_login') }}">
                                            @csrf
                                            <div class="row">
                                                <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                                    <label for="login_email">Email address </label>
                                                    <input type="email" class="form-control" name="login_email" required>
                                                </div>
                                                <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                                    <label for="login_password">Password </label>
                                                    <input type="password" name="login_password" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-check width-100 margin-20px-bottom">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" value="">
                                                            Remember me!
                                                        </label>
                                                        <a href="#" class="float-right">Forgot your password?</a>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- coupon --}}
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
                            <div class="customer-box customer-coupon">
                                <h3 class="font-15 xs-font-13"><i class="icon anm anm-gift-l"></i> Have a coupon? <a
                                        href="#have-coupon" class="text-white text-decoration-underline"
                                        data-toggle="collapse">Click here to enter your code</a></h3>
                                <div id="have-coupon" class="collapse coupon-checkout-content">
                                    <div class="discount-coupon">
                                        <div id="coupon" class="coupon-dec tab-pane active">
                                            <p class="margin-10px-bottom">Enter your coupon code if you have one.</p>
                                            <label class="required get" for="coupon-code"><span class="required-f">*</span>
                                                Coupon</label>
                                            <input id="coupon-code" required="" type="text" class="mb-3">
                                            <button class="coupon-btn btn" type="submit">Apply Coupon</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="row billing-fields">

                    @if (!Session::has('customer'))
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 sm-margin-30px-bottom">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
                                <div class="customer-box customer-coupon">
                                    <h3 class="font-15 xs-font-13"><i class="icon anm anm-gift-l"></i> Have a coupon? <a
                                            href="#have-coupon" class="text-white text-decoration-underline"
                                            data-toggle="collapse">Click here to enter your code</a></h3>
                                    <div id="have-coupon" class="collapse coupon-checkout-content">
                                        <div class="discount-coupon">
                                            <div id="coupon" class="coupon-dec tab-pane active">
                                                <p class="margin-10px-bottom">Enter your coupon code if you have one.</p>
                                                <label class="required get" for="coupon-code"><span
                                                        class="required-f">*</span>
                                                    Coupon</label>
                                                <input id="coupon-code" required="" type="text" class="mb-3">
                                                <button class="coupon-btn btn" type="submit">Apply Coupon</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form name="register" method="POST" action="{{ url('customer_register') }}">
                                @csrf
                                <div class="create-ac-content bg-light-gray padding-20px-all">
                                    <fieldset>
                                        <h2 class="login-title mb-3">Register here</h2>
                                        <div class="row">
                                            <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                <label for="input-firstname">First Name <span
                                                        class="require">*</span></label>
                                                <input name="customer_firstname" value="{{ old('customer_firstname') }}"
                                                    id="input-firstname" type="text">
                                                @error('customer_firstname')
                                                    <span style="color:grey">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                <label for="input-lastname">Last Name <span
                                                        class="required-f">*</span></label>
                                                <input name="customer_lastname" value="{{ old('customer_lastname') }}"
                                                    id="input-lastname" type="text">
                                                @error('customer_lastname')
                                                    <span style="color:grey">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                <label for="input-email">E-Mail <span class="required-f">*</span></label>
                                                <input name="customer_email" value="{{ old('customer_email') }}"
                                                    id="input-email" type="email">
                                                @error('customer_email')
                                                    <span style="color:grey">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                <label for="input-telephone">Telephone <span
                                                        class="required-f">*</span></label>
                                                <input name="customer_telephone" value="{{ old('customer_telephone') }}"
                                                    id="input-telephone" type="tel">
                                                @error('customer_telephone')
                                                    <span style="color:grey">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="row">
                                            <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                <label for="input-company">Password</label>
                                                <input name="customer_password" value="{{ old('customer_password') }}"
                                                    id="input-company" type="text">
                                            </div>
                                            <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                <label for="input-address-1">Confirm <span
                                                        class="required-f">*</span></label>
                                                <input name="customer_con_password"
                                                    value="{{ old('customer_con_password') }}" id="input-address-1"
                                                    type="text">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                <label for="input-address-2">Address <span
                                                        class="required-f">*</span></label>
                                                <input name="customer_address" value="{{ old('customer_address') }}"
                                                    id="input-address-2" type="text">
                                                @error('customer_address')
                                                    <span style="color:grey">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                <label for="input-pincode">pin Code <span
                                                        class="required-f">*</span></label>
                                                <input name="customer_pincode" value="{{ old('customer_pincode') }}"
                                                    id="input-pincode" type="text">
                                                @error('customer_pincode')
                                                    <span style="color:grey">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                <label for="input-city">City <span class="required-f">*</span></label>
                                                <input name="customer_city" value="{{ old('customer_city') }}"
                                                    id="input-city" type="text">
                                                @error('customer_city')
                                                    <span style="color:grey">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                <label for="input-zone">Region / State <span
                                                        class="required-f">*</span></label>
                                                <input name="customer_state" value="{{ old('customer_state') }}"
                                                    id="input-city" type="text">

                                                <!-- <select name="customer_state" id="input-zone">
                                                                                                                                                                                                                                                                                            <option value=""> --- Please Select --- </option>
                                                                                                                                                                                                                                                                                            <option value="3513">Aberdeen</option>
                                                                                                                                                                                                                                                                                            <option value="3514">Aberdeenshire</option>
                                                                                                                                                                                                                                                                                            <option value="3515">Anglesey</option>
                                                                                                                                                                                                                                                                                            <option value="3516">Angus</option>
                                                                                                                                                                                                                                                                                        </select> -->
                                                @error('customer_state')
                                                    <span style="color:grey">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                <label for="input-country">Country <span
                                                        class="required-f">*</span></label>
                                                <input name="customer_country" value="{{ old('customer_country') }}"
                                                    id="input-city" type="text">

                                                <!-- <select name="customer_country" id="input-country">
                                                                                                                                                                                                                                                                                            <option value=""> --- Please Select --- </option>
                                                                                                                                                                                                                                                                                            <option value="244">Aaland Islands</option>
                                                                                                                                                                                                                                                                                            <option value="1">Afghanistan</option>
                                                                                                                                                                                                                                                                                            <option value="2">Albania</option>
                                                                                                                                                                                                                                                                                            <option value="3">Algeria</option>
                                                                                                                                                                                                                                                                                            <option value="4">American Samoa</option>
                                                                                                                                                                                                                                                                                            <option value="5">Andorra</option>
                                                                                                                                                                                                                                                                                            <option value="6">Angola</option>
                                                                                                                                                                                                                                                                                        </select> -->
                                                @error('customer_country')
                                                    <span style="color:grey">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </fieldset>

                                </div>
                            </form>
                        </div>
                    @endif


                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <div class="customer-box customer-coupon">
                            <h3 class="font-15 xs-font-13"><i class="icon anm anm-gift-l"></i> Have a coupon? <a
                                    href="#have-coupon" class="text-white text-decoration-underline"
                                    data-toggle="collapse">Click here to enter your code </a> </h3>
                            <div id="have-coupon" class="collapse coupon-checkout-content">
                                <div class="discount-coupon">
                                    <div id="coupon" class="coupon-dec tab-pane active">
                                        <p class="margin-10px-bottom">Enter your coupon code if you have one.</p>


                                        <form class="coupon-form" id="coupon-form" action="">

                                            @csrf
                                            <label for="coupon_code">
                                                Coupon
                                            </label>
                                            <input id="coupon_code" name="coupon_code" type="text" class="mb-3">
                                            <br>
                                            <button class="coupon-btn btn" type="submit">Apply Coupon</button>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <form method="POST" action="{{ url('checkout') }}" id="checkout_form">
                            @csrf
                            <div class="your-order-payment">
                                <div class="your-order">
                                    <h2 class="order-title mb-4">Your Order</h2>

                                    <div class="table-responsive-sm order-table">
                                        <table class="bg-white table table-bordered table-hover text-center">
                                            <thead>
                                                <tr>
                                                    <th class="text-left">Product Name</th>
                                                    <th>Price</th>
                                                    <th>Option</th>
                                                    <th>Qty</th>
                                                    <th>Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $total = 0;
                                                $order_products = 0;
                                                ?>
                                                @foreach ($cart_products as $product)
                                                    <?php $total += $product->product_price * $cart_data[$product->product_id];
                                                    $order_products += $cart_data[$product->product_id];
                                                    ?>

                                                    <tr>
                                                        <td class="text-left">{{ $product->product_title }}</td>
                                                        <td>{{ $product->product_price }}</td>
                                                        <td>
                                                            @if (!empty($cart_product_option_data[$product->product_id]))
                                                                @foreach ($cart_product_option_data[$product->product_id] as $product_id => $product_option)
                                                                    @foreach ($options as $option)
                                                                        @if (isset($product_option[$option->option_name]))
                                                                            {{ $option->option_name . ' : ' . $product_option[$option->option_name] }}
                                                                            <br>
                                                                        @endif
                                                                    @endforeach
                                                                @endforeach
                                                            @endif
                                                        </td>
                                                        <td>{{ $cart_data[$product->product_id] }}</td>
                                                        <td>{{ $product->product_price * $cart_data[$product->product_id] }}
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>

                                            <tfoot class="font-weight-600">

                                                @if (isset($_GET['coupon_code']))
                                                    {{-- {{ $_GET['coupon_code'] }} --}}
                                                    <?php
                                                    
                                                    $coupon_code = trim($_GET['coupon_code']);
                                                    
                                                    $data = DB::table('coupons')->where('coupon_code', $coupon_code)->get();
                                                    
                                                    // print_r($data);
                                                    foreach ($data as $coupon) {
                                                        if ($coupon->discount_type == '%') {
                                                            $discount_amount = ($total * $coupon->discount_amount) / 100;
                                                    
                                                            $discounted_total = ceil($total - $discount_amount);
                                                        } else {
                                                            $discount_amount = $coupon->discount_amount;
                                                            $discounted_total = ceil($total - $coupon->discount_amount);
                                                        }
                                                    }
                                                    
                                                    ?>

                                                    <input type="hidden" name="coupon_id"
                                                        value=" {{ $coupon->coupon_id }}">


                                                    <div class="coupon-card">
                                                        <h3>Coupon Applied</h3>

                                                        <h3> {{ $coupon->coupon_name }}</h3>

                                                        <h2 id="cpnCode"> {{ $coupon->coupon_code }} </h2>
                                                    </div>

                                                    <br><br>
                                                    {{-- <h2>You got discount of {{ ceil($discount_amount) }}</h2> --}}
                                                @endif

                                                <tr>
                                                    <td colspan="4" class="text-right">Total</td>
                                                    <td> &#8377; {{ $total }}</td>

                                                    <input type="hidden" name="order_total"
                                                        value=" {{ $total }}">
                                                    <input type="hidden" name="order_products"
                                                        value="{{ $order_products }}">
                                                </tr>
                                                @if (isset($discounted_total))
                                                    <tr>

                                                        <td colspan="3">You got discount of
                                                            <b>&#8377;{{ ceil($discount_amount) }}</b>
                                                        </td>
                                                        <td class="text-right">Discounted Total</td>
                                                        <td> <b>&#8377; {{ $discounted_total }}</b> </td>

                                                        <input type="hidden" name="discounted_total"
                                                            value=" {{ $discounted_total }}">

                                                        <input type="hidden" name="discount_amount"
                                                            value=" {{ $discount_amount }}">

                                                    </tr>
                                                @endif
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>

                                <hr />

                                {{-- <div class="coupon-card">

                                    <h3> {{ $coupon->coupon_name }}</h3>

                                    <h2 id="cpnCode"> {{ $coupon->coupon_code }} </h2>

                                    <button class="btn" id="cpnBtn">Copty Code</button>

                                </div> --}}

                                <div class="your-payment">
                                    <h2 class="payment-title mb-3">payment method</h2>
                                    <div class="payment-method">

                                        <div class="payment-accordion">
                                            <div id="accordion" class="payment-section">
                                                <div class="card mb-2">
                                                    <div class="card-header">
                                                        <a class="card-link" data-toggle="collapse"
                                                            href="#collapseOne">Direct Bank Transfer </a>
                                                    </div>
                                                    <div id="collapseOne" class="collapse" data-parent="#accordion">
                                                        <div class="card-body">
                                                            <p class="no-margin font-15">Make your payment directly into
                                                                our bank account. Please use your Order ID as the payment
                                                                reference. Your order won't be shipped until the funds have
                                                                cleared in our account.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card mb-2">
                                                    <div class="card-header">
                                                        <a class="collapsed card-link" data-toggle="collapse"
                                                            href="#collapseTwo">Cheque Payment</a>
                                                    </div>
                                                    <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                                        <div class="card-body">
                                                            <p class="no-margin font-15">Please send your cheque to Store
                                                                Name, Store Street, Store Town, Store State / County, Store
                                                                Postcode.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card margin-15px-bottom border-radius-none">
                                                    <div class="card-header">
                                                        <a class="collapsed card-link" data-toggle="collapse"
                                                            href="#collapseThree"> PayPal </a>
                                                    </div>
                                                    <div id="collapseThree" class="collapse" data-parent="#accordion">
                                                        <div class="card-body">
                                                            <p class="no-margin font-15">Pay via PayPal; you can pay with
                                                                your credit card if you don't have a PayPal account.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card mb-2">
                                                    <div class="card-header">
                                                        <a class="collapsed card-link" data-toggle="collapse"
                                                            href="#collapseFour"> Payment
                                                            Information </a>
                                                    </div>
                                                    <div id="collapseFour" class="collapse" data-parent="#accordion">
                                                        <div class="card-body">
                                                            <fieldset>
                                                                <div class="row">
                                                                    <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                                        <label for="input-cardname">Name on Card <span
                                                                                class="required-f">*</span></label>
                                                                        <input name="cardname" value=""
                                                                            placeholder="Card Name" id="input-cardname"
                                                                            class="form-control" type="text">
                                                                    </div>
                                                                    <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                                        <label for="input-country">Credit Card Type <span
                                                                                class="required-f">*</span></label>
                                                                        <select name="country_id" class="form-control">
                                                                            <option value=""> --- Please Select ---
                                                                            </option>
                                                                            <option value="1">American Express
                                                                            </option>
                                                                            <option value="2">Visa Card</option>
                                                                            <option value="3">Master Card</option>
                                                                            <option value="4">Discover Card</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                                        <label for="input-cardno">Credit Card Number <span
                                                                                class="required-f">*</span></label>
                                                                        <input name="cardno" value=""
                                                                            placeholder="Credit Card Number"
                                                                            id="input-cardno" class="form-control"
                                                                            type="text">
                                                                    </div>
                                                                    <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                                        <label for="input-cvv">CVV Code <span
                                                                                class="required-f">*</span></label>
                                                                        <input name="cvv" value=""
                                                                            placeholder="Card Verification Number"
                                                                            id="input-cvv" class="form-control"
                                                                            type="text">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                                        <label>Expiration Date <span
                                                                                class="required-f">*</span></label>
                                                                        <input type="date" name="exdate"
                                                                            class="form-control">
                                                                    </div>
                                                                    <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                                        <img class="padding-25px-top xs-padding-5px-top"
                                                                            src="{{ asset('frontend_assets/images/payment-img.jpg') }}"
                                                                            alt="card" title="card" />
                                                                    </div>
                                                                </div>
                                                            </fieldset>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="order-button-payment">
                                            <!-- <button class="btn" value="Place order" type="submit">Place order</button> -->

                                            <!-- Braintree -->
                                            <a href="{{ route('braintree') }}"><button class="btn" type="submit">
                                                    Braintree payment </button></a>
                                            <!-- stripe -->
                                            <a href="{{ route('stripe') }}"><button class="btn" type="button">
                                                    stripe payment </button></a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @else
                <br><br><br><br><br>
                <h2>Your cart is empty </h2>
                <h2>Add item to cart to checkout</h2>
                <br><br><br><br><br><br><br><br>
            @endif
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>


    <script>
        $(document).ready(function(e) {

            $(".coupon-form").validate({

                rules: {
                    coupon_code: {
                        required: true,
                        remote: {
                            url: "{{ url('validate_coupon') }}",
                            type: "POST",
                            data: {
                                "_token": "{{ @csrf_token() }}",
                                coupon_code: $(this).children("#coupon_code").val()
                            }
                        }
                    }
                },
                messages: {
                    coupon_code: {
                        required: 'Enter Coupon Code first',
                        remote: 'This coupon code is InValid'
                    }
                }
            });

        });
    </script>

    <script>
        function varify_coupon() {

            coupon_code = $("#coupon_code").val()
            console.log(coupon_code)

            // $.ajax({
            //     url: '{{ url('validate_coupon') }}',
            //     method: "POST",
            //     data: {
            //         "_token": "{{ @csrf_token() }}",
            //         coupon_code
            //     },
            //     success: function() {
            //         alert('d')
            //     }
            // })
        }
    </script>
@endsection

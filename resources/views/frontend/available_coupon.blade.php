@extends('frontend.FrontLayout')

@section('title')
    {{ 'Home Page' }}
@endsection

@section('content')

    {{-- coupon --}}
    <style>
        .container {
            /* height: 100vh; */
            /* background: #f0fff3; */
            display: flex;
            align-items: center;
            justify-content: space-around;

        }

        .coupon-card {
            background: linear-gradient(135deg, #abeb97, #af52e5);
            color: #fff;
            text-align: center;
            padding: 40px 80px;
            border-radius: 15px;
            box-shadow: 0 10px 10px 0 rgba(0, 0, 0, 0.15);
            position: relative;
        }

        #cpnCode {
            border: 1px dashed #fff;
            padding: 10px 20px;

        }
    </style>

    <br><br><br><br>
    <br><br><br><br>
    <br><br><br><br>

    <div class="container">

        @if (!empty($coupons[0]))

            @foreach ($coupons as $key => $coupon)

                <div class="coupon-card">

                    <h3> {{ $coupon->coupon_name }}</h3>

                    <h2 id="cpnCode"> {{ $coupon->coupon_code }} </h2>
                    <h3>Valid Till : {{ $coupon->expires_at }}</h3>

                    <h3>{{ $days_left[$key] }}</h3>

                    <button class="btn" id="cpnBtn">Copty Code</button>

                </div>  

            @endforeach

        @else

            <h1>There is no coupon</h1>

        @endif

    </div>

    <br><br><br><br>
    <br><br><br><br>

    <script>
        var cpnBtn = document.getElementById("cpnBtn");
        var cpnCode = document.getElementById("cpnCode");

        cpnBtn.onclick = function() {
            navigator.clipboard.writeText(cpnCode.innerHTML);
            cpnBtn.innerHTML = "COPIED";
            setTimeout(function() {
                cpnBtn.innerHTML = "COPY CODE";
            }, 3000);
        }
    </script>
@endsection

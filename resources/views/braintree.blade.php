<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://js.braintreegateway.com/web/dropin/1.24.0/js/dropin.min.js"></script>

    <link rel="stylesheet" href="{{ asset('frontend_assets/css/bootstrap.min.css') }}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</head>

<body>

    <div class="py-12">
        @csrf

        <div id="dropin-container" style="display: flex;justify-content: center;align-items: center;"></div>
        
        <input type="hidden" id="coupon_id" value="{{$coupon_id}}">
        <input type="hidden" id="order_total" value="{{$order_total}}">
        <input type="hidden" id="discount_amount" value="{{$discount_amount}}">
        <input type="hidden" id="discounted_total" value="{{$discounted_total}}">

        <div style="display: flex;justify-content: center;align-items: center; color: white">
            <a id="submit-button" class="btn btn-sm btn-success">Submit payment</a>
        </div>
    </div>
</body>

</script>

<script>
    var button = document.querySelector('#submit-button');
    braintree.dropin.create({
        authorization: '{{$token}}',
        container: '#dropin-container'
    }, function(createErr, instance) {

        button.addEventListener('click', function() {
            instance.requestPaymentMethod(function(err, payload) {
                (function($) {
                    $(function() {
                        // $.ajaxSetup({
                        //     headers: {
                        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        //     }
                        // });
                        $.ajax({
                            type: "POST",
                            url: "{{route('braintree')}}",
                            data: {
                                "_token": "{{ @csrf_token()}}",
                                nonce: payload.nonce,
                                coupon_id:$("#coupon_id").val(),
                                order_total:$("#order_total").val(),
                                discount_amount:$("#discount_amount").val(),
                                discounted_total:$("#discounted_total").val()
                            },
                            success: function(data) {
                                alert('success', payload.nonce)
                                // console.log(data)
                                console.log(data.status.transaction.id);
                                window.location.href = "{{ route('my_orders')"
                        
                            },
                            error: function(data) {
                                console.log('error', payload.nonce)
                                window.location.href = "{{ route('my_orders')"
                                cons.log(data)
                            }
                        });
                    });
                })(jQuery);
            });
        });


    });
</script>




</html>
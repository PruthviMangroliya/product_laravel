<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Welcome to Our Platform</title>
    <style>
        /* Inline styles for simplicity, consider using CSS classes for larger templates */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f1f1f1;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            max-width: 200px;
        }

        .message {
            padding: 20px;
            background-color: #ffffff;
        }

        .message p {
            margin-bottom: 10px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">

        <div class="message">
            {{-- <p>Dear {{ $mailData['name'] }},</p> --}}
            <p>Thank you for providing your details Your Company Name.
        </div>

        <center>
            <h2 style="padding: 23px;background: #b3deb8a1;border-bottom: 6px green solid;">
                <a href="{{ url('dashboard')}}">ecom</a>
            </h2>
        </center>
        
        <p>Hi, Sir</p>
        <p>Ypur order has been placed successfully</p>
        <p>we receive the payment and order is confirmed</p>
        <p>you can see your order by clicking this link</p>
        <a href="{{ route('my_orders')}}">View Order</a>

        <strong>Thank you</strong>

    </div>
</body>

</html>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Reservation Time Extension</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 16px;
            line-height: 1.5;
            color: #333333;
        }

        h1,
        h2,
        h3 {
            margin: 0;
            padding: 0;
        }

        h1 {
            font-size: 32px;
            line-height: 1.2;
            color: #000;
            margin-bottom: 10px;
        }

        p {
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #000;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin-right: 10px;
        }

        .btn:hover {
            background-color: #292929;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f2f2f2;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .payment-details {
            border: 1px solid #e6e6e6;
            padding: 10px;
            margin-bottom: 20px;
            background-color: #ffffff;
            border-radius: 5px;
        }

        .payment-details h2 {
            font-size: 20px;
            line-height: 1.2;
            color: #000;
            margin-bottom: 10px;
        }

        .payment-details p {
            margin-bottom: 10px;
        }

        img {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div style="display: flex; justify-content:center;">
            <!-- Company Logo -->
            <img class="logo" src="{{ Helper::image_path('logo.png') }}" style="text-align:center" alt="Company Logo">
        </div>
        <h1>Reservation Time Extension</h1>
        <p>Dear,</p>
        <p>We have received your request to extend the time of your reservation booking. We are happy to inform you that
            we have approved your request.</p>
        <p>Your new reservation details are:</p>
        <ul>
            <li>Booking ID: {{ $booking_id }}</li>
            <li>Date: {{ $booking_date }}</li>
            <li>Extend Time: {{ $time }}</li>
        </ul>
        <p>The additional payment for the extended time is:</p>
        <div class="payment-details">
            <h2>Payment Details</h2>
            <p>Sub Total: {{$sub_total}}</p>
            <p>Service Fee: {{$service_fee}}</p>
            <p>HST: {{$hst}}</p>
            <p>Total: {{$total_amount}}</p>
        </div>
        <p>Please click the button below to make the payment:</p>
        <div>
            <a href="{{ $payment_link }}" class="btn">Make Payment</a>
        </div>
        <p>If you have any questions or concerns, please do not hesitate to contact us.</p>
        <p>Thank you for choosing our service.</p>
        <p>Best regards,</p>
        <p>Domez Team</p>
    </div>
</body>

</html>

<!DOCTYPE html>
<html>

<head>
    <style type="text/css">
        body {
            background-color: #F5F5F5;
            font-family: Arial, sans-serif;
        }

        .container {
            margin: 0 auto;
            padding: 20px;
            max-width: 600px;
            background-color: #FFFFFF;
            border-radius: 10px;
            box-shadow: 0px 0px 10px #BFBFBF;
        }

        p {
            margin-bottom: 20px;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #000;
            color: #FFFFFF;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div style="display: flex; justify-content:center;">
            <!-- Company Logo -->
            <img class="logo" src="{{ Helper::image_path('logo.png') }}" style="text-align:center" alt="Company Logo">
        </div>
        <p>Dear {{ $name }},</p>
        <p>Thank you for your request on our website. We are pleased to inform you that your request has been received
            and is currently being processed. Our team will review your request and get back to you within the next 24
            hours.</p>
        <p>Thank you again for choosing our platform for your business needs. We look forward to the possibility of
            working with you in the future. If you have any questions or concerns, please do not hesitate to contact us
            at <a href="mailto:domez@domez.io">domez@domez.io</a>. We are always here to assist you.</p>
        <a href="{{ URL::to('/') }}" class="button" style="color: #FFFFFF">Visit Our Website</a>
        <p>Best regards,</p>
        <p>Domez Team</p>
    </div>
</body>

</html>

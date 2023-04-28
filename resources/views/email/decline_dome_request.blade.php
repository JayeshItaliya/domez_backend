<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Decline Request</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px #ccc;
            max-width: 500px;
            margin: 0 auto;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }

        p {
            font-size: 16px;
            line-height: 24px;
            color: #666;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            background-color: #000;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div style="display: flex; justify-content:center;">
            <!-- Company Logo -->
            <img class="logo" src="{{ $logo }}" style="text-align:center" alt="Company Logo">
        </div>
        <p>Dear {{ $name }},</p>
        <p>Thank you for your request, however, we regret to inform you that we are unable to fulfill your request at
            this time.</p>
        <p>Please don't hesitate to contact us if you have any further questions.</p>
        <p>Best regards,</p>
        <p>Domez Team</p>
        <a href="#" class="btn">Go to our website</a>
    </div>
</body>

</html>

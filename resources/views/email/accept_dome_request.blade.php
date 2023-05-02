<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <style>
        /* Company Logo */
        .logo {
            display: block;
            margin: 0 auto;
        }

        /* Email Body */
        .email-body {
            max-width: 600px;
            margin: 0 auto;
            font-family: Arial, sans-serif;
            font-size: 16px;
            line-height: 1.5;
            color: #333333;
        }

        /* Button */
        .btn {
            display: inline-block;
            background-color: #000000;
            color: #ffffff !important;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 20px;
        }

        /* Button Hover */
        .btn:hover {
            background-color: #000000;
            color: #ffffff;
        }
    </style>
</head>

<body>
    <!-- Company Logo -->
    <img class="logo" src="{{ $logo }}" style="text-align:center" alt="Company Logo">
    <h1 style="text-align:center;color:#000;">Welcome to Domez!</h1>

    <!-- Email Body -->
    <div class="email-body">
        <p>Congratulations {{ $name }}! Your request has been accepted.</p>

        @if ($is_exist == 1)
            <p>Thank you for your interest in Domez. We are pleased to inform you that your application has been
                accepted and we look forward to welcoming you to Domez.</p>
            <p>We appreciate your loyalty and trust in our platform, and we remain committed to providing you with the
                best service possible. Please do not hesitate to reach out to us if you have any questions or concerns.
            </p>
        @else
            <p>Thank you for your interest in Domez. We are pleased to inform you that your application has been
                accepted and we look forward to welcoming you to Domez. You can now access your admin panel using the
                login details provided below:</p>

            <p>Email: <strong>{{ $email }}</strong></p>
            <p>Password: <strong>{{ $password }}</strong></p>
        @endif

        <p>Thank you for choosing Domez. We look forward to continuing our partnership with you.</p>

        <a class="btn" href="{{ URL::to('login') }}">Login</a>

        <p style="font-size:0.9em;">Regards,<br />Domez Team</p>
    </div>
</body>

</html>

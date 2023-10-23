<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <style>
        .btn:hover {
            background-color: #000000;
            color: #ffffff;
        }
    </style>
</head>

<body>
    <img src="{{ Helper::image_path('logo.png') }}" style="text-align:center;display: block; margin: 0 auto;"
        alt="Company Logo">
    <h1 style="text-align:center;color:#000;">Welcome to Domez!</h1>

    <div
        style="max-width: 600px; margin: 0 auto; font-family: Arial, sans-serif; font-size: 16px; line-height: 1.5; color: #333333;">
        <p>Congratulations {{ $name }}! Your request has been accepted.</p>

        @if ($send_login_data == 1)
            <p>Thank you for your interest in Domez. We are pleased to inform you that your application has been accepted and we look forward to welcoming you to Domez. You can now access your admin panel using the login details provided below:</p>
            <p>Email: <strong>{{ $email }}</strong></p>
            <p>Password: <strong>{{ $password }}</strong></p>
            <p>Thank you for choosing Domez. We look forward to continuing our partnership with you.</p>

            <a style="display: inline-block; background-color: #000000; color: #ffffff !important; text-decoration: none; padding: 10px 20px; border-radius: 5px; margin-top: 20px;"
                class="btn" href="{{ URL::to('login') }}">Login</a>
        @else
            <p>Thank you for your interest in Domez. We are pleased to inform you that your application has been accepted and we look forward to welcoming you to Domez.</p>
        @endif

        <p style="font-size:0.9em;">Regards,<br />Domez Team</p>
    </div>
</body>

</html>

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
    <img src="{{ Helper::image_path('logo.png') }}" style="text-align:center" alt="Company Logo"
        style="display: block; margin: 0 auto;">
    <h1 style="text-align:center;color:#000;">Welcome to Domez!</h1>
    <div
        style="max-width: 600px; margin: 0 auto; font-family: Arial, sans-serif; font-size: 16px; line-height: 1.5; color: #333333;">
        <p>Hi {{ $name }}! Here is your login credentials</p>
        <p>Email: <strong>{{ $email }}</strong></p>
        <p>Password: <strong>{{ $password }}</strong></p>
        <a style="display: inline-block; background-color: #000000; color: #ffffff !important; text-decoration: none; padding: 10px 20px; border-radius: 5px; margin-top: 20px;"
            class="btn" href="{{ URL::to('login') }}">Login</a>
        <p style="font-size:0.9em;">Regards,<br />Domez Team</p>
    </div>
</body>

</html>

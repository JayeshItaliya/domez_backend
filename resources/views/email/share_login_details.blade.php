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
    <h1 style="text-align:center;color:#468F72;">Welcome to Domez!</h1>

    <!-- Email Body -->
    <div class="email-body">
        <p>Hi {{ $name }}! Here is your login credentials</p>

        <p>Email: <strong>{{ $email }}</strong></p>
        <p>Password: <strong>{{ $password }}</strong></p>

        <a class="btn" href="{{ URL::to('login') }}">Login</a>

        <p style="font-size:0.9em;">Regards,<br />Domez Team</p>
    </div>
</body>

</html>

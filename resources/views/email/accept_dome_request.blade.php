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
            background-color: #007bff;
            color: #ffffff !important;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 20px;
        }

        /* Button Hover */
        .btn:hover {
            background-color: #0062cc;
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
        <p>Dear {{ $name }}, Congratulations! Your request has been accepted.</p>

        <p>Thank you for your interest in Domez. We are pleased to inform you that your application has been accepted
            and we look forward to welcoming you to Domez. You can now access your admin panel using the login details
            provided below:</p>

        <p>Email: <strong>{{ $email }}</strong></p>
        <p>Password: <strong>{{ $password }}</strong></p>

        <p>Please visit the following URL to log in:</p>
        <p><a href="{{ URL::to('login') }}">{{ URL::to('login') }}</a></p>

        <a class="btn" href="{{ URL::to('/F') }}">Visit Our Website</a>
    </div>
</body>

</html>

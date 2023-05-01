<!DOCTYPE html>
<html>

<head>
    <title>Password Changed Successfully</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            color: #444444;
            padding: 0;
            margin: 0;
            font-size: 16px;
            line-height: 1.5;
        }

        .container {
            max-width: 600px;
            margin: 5rem auto;
            padding: 30px;
            background-color: #ffffff;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            text-align: center;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #000;
        }

        p {
            margin-bottom: 20px;
        }

        a {
            color: #ffffff;
            background-color: #000;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
        }

        .logo {
            display: block;
            margin: 0 auto;
            max-width: 150px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <img src="{{ $logo }}" alt="Logo" class="logo">
        <h1>Password Changed Successfully</h1>
        <p>Your password has been changed successfully. If you did not initiate this change, please contact us
            immediately.</p>
        <a href="{{ URL::to('login') }}" style="color: #ffffff">Login</a>
    </div>
</body>

</html>

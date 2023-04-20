{{-- <div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
    <div style="margin:50px auto;width:70%;padding:20px 0">
        <div style="border-bottom:1px solid #eee">
            <a href="" style="font-size:1.4em;color: #00bac7;text-decoration:none;font-weight:600">
                <img src="{{ $logo }}" alt="Logo">
            </a>
        </div>
        <p style="font-size:1.1em">Hi, {{ $name }}</p>
        <p>Thank you for choosing Domez. Use the following OTP to verify your email address.</p>
        <h2 style="background: #00bac7;width: max-content;padding: 0 10px;color: #fff;border-radius: 4px;">
            {{ $otp }}</h2>
        <p style="font-size:0.9em;">Regards,<br />DOMEZ Team</p>
        <hr style="border:none;border-top:1px solid #eee" />
    </div>
</div>

 --}}







<!DOCTYPE html>
<html>

<head>
    <title>OTP Verification Email</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Set default font family and size */
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 16px;
            color: black;
        }

        /* Set email container width and center it */
        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Set logo width and center it */
        .logo {
            display: block;
            margin: 20px auto;
            max-width: 200px;
        }

        /* Set heading style */
        h1 {
            font-size: 24px;
            margin: 40px 0 20px 0;
            text-align: center;
        }

        /* Set paragraph style */
        p {
            margin-bottom: 20px;
            line-height: 1.5;
            text-align: justify;
        }

        /* Set code block style */
        .code {
            display: inline-block;
            padding: 5px 10px;
            background-color: #f2f2f2;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 18px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <img class="logo" src="{{ $logo }}" alt="Brand Logo">
        <h1>OTP Verification Email</h1>
        <p>Hello {{ $name }},</p>
        <p>Please use the following code to verify your account:</p>
        <div class="code">{{ $otp }}</div>
        <p>This code will expire in 10 minutes. If you did not request this verification code, please ignore this email.</p>
        <p>Thank you,</p>
        <p>Domez Team</p>
    </div>
</body>

</html>

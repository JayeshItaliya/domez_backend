<!DOCTYPE html>
<html>

<head>
    <title>OTP Verification Email</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body style="font-family: Arial, Helvetica, sans-serif; font-size: 16px; color: black;">
    <div style="width: 100%; max-width: 600px; margin: 0 auto;">
        <img src="{{ Helper::image_path('logo.png') }}" alt="Brand Logo" style="display: block; margin: 20px auto; max-width: 200px;">
        <h1 style="font-size: 24px; margin: 40px 0 20px 0; text-align: center;">OTP Verification Email</h1>
        <p style="margin-bottom: 20px; line-height: 1.5; text-align: justify;">Hello {{ $name }},</p>
        <p style="margin-bottom: 20px; line-height: 1.5; text-align: justify;">Please use the following code to verify your account:</p>
        <div style="display: inline-block; padding: 5px 10px; background-color: #f2f2f2; border: 1px solid #ccc; border-radius: 5px; font-size: 18px; font-weight: bold; color: #333; margin-bottom: 20px;">{{ $otp }}</div>
        <p style="margin-bottom: 20px; line-height: 1.5; text-align: justify;">This code will expire in 10 minutes. If you did not request this verification code, please ignore this email.</p>
        <p style="margin-bottom: 20px; line-height: 1.5; text-align: justify;">Thank you,</p>
        <p style="margin-bottom: 20px; line-height: 1.5; text-align: justify; font-size:0.9em;">Regards,<br />Domez Team</p>
    </div>
</body>

</html>

@if ($type == 3)
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <title>Inquiry Reply</title>
        <style>
            /* Global styles */
            body {
                font-family: Arial, sans-serif;
                font-size: 16px;
                line-height: 1.5;
                color: #333333;
                background-color: #f6f6f6;
            }

            /* Email container */
            .email-container {
                max-width: 600px;
                margin: 0 auto;
                background-color: #ffffff;
                padding: 30px;
                border-radius: 10px;
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            }

            /* Header */
            .header {
                display: flex;
                justify-content: center;
                align-items: center;
                margin-bottom: 30px;
            }

            .header h1 {
                font-size: 24px;
                font-weight: bold;
                color: #333333;
                margin: 0;
            }

            /* Message */
            .message {
                margin-bottom: 30px;
            }

            .message p {
                margin: 0 0 20px;
            }

            .message h2 {
                font-size: 20px;
                font-weight: bold;
                color: #333333;
                margin: 0;
            }

            /* Footer */
            .footer {
                border-top: 1px solid #dddddd;
                padding-top: 30px;
                margin-top: 30px;
                text-align: center;
            }

            .footer p {
                margin: 0;
            }
        </style>
    </head>

    <body>
        <div class="email-container">
            <div class="header">
                <a href="{{ URL::to('/') }}">
                    <img src="{{ $logo }}" alt="Logo">
                </a>
            </div>
            <div class="message">
                <p>Dear {{ $name }},</p>
                <p>Thank you for your inquiry. We appreciate your interest in our platform.</p>
                <p>{{ $reply }}</p>
                <p>If you have any further questions or concerns, please do not hesitate to contact us.</p>
                <p>Regards,</p>
                <p>Domez Team</p>
            </div>
        </div>
    </body>

    </html>
@endif

@if (in_array($type, [1, 2, 5]))
    <!DOCTYPE html>
    <html>

    <head>
        <style>
            body {
                font-family: Arial, sans-serif;
                font-size: 14px;
                line-height: 1.5;
                margin: 0;
                padding: 0;
            }

            .container {
                max-width: 600px;
                margin: 0 auto;
                padding: 20px;
                background-color: #f7f7f7;
                border: 1px solid #ddd;
            }

            h1 {
                font-size: 24px;
                margin-bottom: 20px;
                text-align: center;
            }

            p {
                margin-bottom: 10px;
            }

            .button {
                display: inline-block;
                padding: 10px 20px;
                background-color: #4CAF50;
                color: #fff;
                text-decoration: none;
                border-radius: 5px;
                margin-top: 20px;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <p>Dear {{ $name }},</p>
            <p>Thank you for contacting us regarding {{ $subject }}. We appreciate your interest in Domez.</p>
            <p><strong>Reply:</strong><br>{{ $reply }}</p><br>
            <p style="font-size:0.9em;">Regards,<br />Domez Team</p>
        </div>
    </body>

    </html>
@endif

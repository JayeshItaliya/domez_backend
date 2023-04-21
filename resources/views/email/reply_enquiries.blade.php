@if ($type == 3)
    <div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
        <div style="margin:50px auto;width:70%;padding:20px 0">
            <div style="border-bottom:1px solid #eee">
                <a href="{{ URL::to('/') }}" style="font-size:1.4em;color: #00bac7;text-decoration:none;font-weight:600">
                    <img src="{{ $logo }}" alt="Logo">
                </a>
            </div>
            <p style="font-size:1.1em">Hi {{ $name }},</p>
            <h4>Thank you for choosing Domez.</h4>
            <p>{{ $reply }}</p>
            <p style="font-size:0.9em;">Regards,<br />Domez Team</p>
            <hr style="border:none;border-top:1px solid #eee" />
        </div>
    </div>
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

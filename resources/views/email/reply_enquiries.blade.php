{{-- @if ($type == 3) --}}
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Inquiry Reply</title>
        </head>
        <body style="font-family: Arial, sans-serif; font-size: 16px; line-height: 1.5; color: #333333; background-color: #f6f6f6;">
            <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 30px; border-radius: 10px; box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);">
                <div style="display: flex; justify-content: center; align-items: center; margin-bottom: 30px;">
                    <a href="{{ URL::to('/') }}">
                        <img src="{{ Helper::image_path('logo.png') }}" alt="Logo">
                    </a>
                </div>
                <div class="message">
                    {{-- <p>Dear {{ $name }},</p>
                    <p>Thank you for your inquiry. We appreciate your interest in our platform.</p> --}}
                    <p>{!! $reply !!}</p>
                    {{-- <p>If you have any further questions or concerns, please do not hesitate to contact us.</p>
                    <p>Regards,</p>
                    <p>Domez Team</p> --}}
                </div>
            </div>
        </body>
    </html>
{{-- @endif
@if (in_array($type, [1, 2, 5]))
    <!DOCTYPE html>
    <html>
    <body style="font-family: Arial, sans-serif; font-size: 14px; line-height: 1.5; margin: 0; padding: 0;">
        <div style="max-width: 600px; margin: 0 auto; padding: 20px; background-color: #f7f7f7; border: 1px solid #ddd;">
            <p style="margin-bottom: 10px;" >Dear {{ $name }},</p>
            <p style="margin-bottom: 10px;" >Thank you for contacting us regarding {{ $subject }}. We appreciate your interest in Domez.</p>
            <p style="margin-bottom: 10px;" ><strong>Reply:</strong><br>{!! $reply !!}</p><br>
            <p style="margin-bottom: 10px;font-size:0.9em;">Regards,<br />Domez Team</p>
        </div>
    </body>
    </html>
@endif --}}

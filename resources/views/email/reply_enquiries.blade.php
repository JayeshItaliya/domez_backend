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
                    <p>{!! $reply !!}</p>
                </div>
            </div>
        </body>
    </html>

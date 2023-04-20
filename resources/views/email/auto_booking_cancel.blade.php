<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.5;
            color: #333;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 30px;
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
        }

        h1 {
            font-size: 24px;
            margin: 0;
        }

        p {
            margin-top: 20px;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #999;
        }
    </style>
</head>

<body>
    <div class="container" style="margin-bottom: 1rem">
        <h1>{{ $title }}</h1>
        <p>{!! $description !!}</p>
        @if ($type != 2)
            <p>If you still wish to make a booking with us, please click the button below to return to our website and
                make a new booking.</p>
            <a href="{{ URL::to('/') }}" class="button">Visit our Website</a>
            <div class="container">
                <table>
                    <tr>
                        <th>Booking Reference</th>
                        <td>{{ $bookingdata->booking_id }}</td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td>{{ $bookingdata->customer_name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $bookingdata->customer_email }}</td>
                    </tr>
                    <tr>
                        <th>Date</th>
                        <td>{{ $bookingdata->type == 1 ? Helper::date_format($bookingdata->booking_date) : Helper::date_format($bookingdata->start_date) . ' - ' . Helper::date_format($bookingdata->end_date) }}
                        </td>
                    </tr>
                    <tr>
                        <th>Time</th>
                        <td>{{ Helper::time_format($bookingdata->start_time) . ' - ' . Helper::time_format($bookingdata->end_time) }}
                        </td>
                    </tr>
                    @if ($bookingdata->type == 2)
                        <tr>
                            <th>League Name</th>
                            <td>{{ $bookingdata->league_info->name }}</td>
                        </tr>
                    @endif
                    <tr>
                        <th>Dome Name</th>
                        <td>{{ $bookingdata->dome_info->name }}</td>
                    </tr>
                    <tr>
                        <th>Dome Address</th>
                        <td>{{ $bookingdata->dome_info->address }}</td>
                    </tr>
                    <tr>
                        <th>Number of Players</th>
                        <td>{{ $bookingdata->players }}</td>
                    </tr>
                    <tr>
                        <th>Paid Amount</th>
                        <td>{{ Helper::currency_format($bookingdata->paid_amount) }}</td>
                    </tr>
                    <tr>
                        <th>Due Amount</th>
                        <td>{{ Helper::currency_format($bookingdata->due_amount) }}</td>
                    </tr>
                    <tr>
                        <th>Total Amount</th>
                        <td>{{ Helper::currency_format($bookingdata->total_amount) }}</td>
                    </tr>
                    <tr>
                        <th>Refund Amount</th>
                        <td class="total">{{ Helper::currency_format($bookingdata->refunded_amount) }}</td>
                    </tr>
                </table>
            </div>
            <p class="footer">If you have any questions or concerns, please don't hesitate to contact us.</p>
        @endif
    </div>
</body>

</html>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Booking Confirmation Receipt</title>
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

        h2 {
            font-size: 18px;
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th {
            text-align: left;
            padding: 10px;
            background-color: #f7f7f7;
            border-bottom: 1px solid #ddd;
        }

        table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .total {
            font-weight: bold;
            font-size: 16px;
        }

        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #999;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 style="text-align: center;">Booking Receipt</h1>
        <p style="text-align: center;">Thank you for booking with us. Here are the details of your reservation.</p>
        <table>
            <tr>
                <th>Booking Reference </th>
                <td>{{ $bookingdata->booking_id }}</td>
            </tr>
            <tr>
                <th>Name </th>
                <td>{{ $bookingdata->customer_name }}</td>
            </tr>
            <tr>
                <th>Email </th>
                <td>{{ $bookingdata->customer_email }}</td>
            </tr>
            <tr>
                <th>Date </th>
                <td>{{ $bookingdata->type == 1 ? Helper::date_format($bookingdata->booking_date) : Helper::date_format($bookingdata->start_date) . ' - ' . Helper::date_format($bookingdata->end_date) }}
                </td>
            </tr>
            <tr>
                <th>Time </th>
                <td>{{ Helper::time_format($bookingdata->start_time) . ' - ' . Helper::time_format($bookingdata->end_time) }}
                </td>
            </tr>
            @if ($bookingdata->type == 2)
                <tr>
                    <th>League Name </th>
                    <td>{{ $bookingdata->league_info->name }}</td>
                </tr>
            @endif
            <tr>
                <th>Dome Name </th>
                <td>{{ $bookingdata->dome_info->name }}</td>
            </tr>
            <tr>
                <th>Dome Address </th>
                <td>{{ $bookingdata->dome_info->address }}</td>
            </tr>
            <tr>
                <th>Number of Players </th>
                <td>{{ $bookingdata->players }}</td>
            </tr>
            <tr>
                <th>Paid Amount </th>
                <td>{{ Helper::currency_format($bookingdata->paid_amount) }}</td>
            </tr>
            <tr>
                <th>Due Amount </th>
                <td>{{ Helper::currency_format($bookingdata->due_amount) }}</td>
            </tr>
            <tr>
                <th>Total Amount </th>
                <td class="total">{{ Helper::currency_format($bookingdata->total_amount) }}</td>
            </tr>
        </table>
        <p class="footer">If you have any questions or concerns, please don't hesitate to contact us.</p>
    </div>
</body>

</html>

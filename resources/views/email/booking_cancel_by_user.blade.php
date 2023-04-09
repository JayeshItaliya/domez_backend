<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Booking Cancellation Confirmation</title>
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
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Booking Cancellation Confirmation</h1>
        <p>We're sorry to hear that you have cancelled your booking. Here are the details of your cancellation:</p>
        <table>
            <tr>
                <th>Booking Reference:</th>
                <td>123456789</td>
            </tr>
            <tr>
                <th>Name:</th>
                <td>John Doe</td>
            </tr>
            <tr>
                <th>Email:</th>
                <td>johndoe@example.com</td>
            </tr>
            <tr>
                <th>Check-in Date:</th>
                <td>April 15, 2023</td>
            </tr>
            <tr>
                <th>Check-out Date:</th>
                <td>April 18, 2023</td>
            </tr>
            <tr>
                <th>Room Type:</th>
                <td>Deluxe Double Room</td>
            </tr>
            <tr>
                <th>Number of Guests:</th>
                <td>2 Adults, 1 Child</td>
            </tr>
            <tr>
                <th>Price per Night:</th>
                <td>$150</td>
            </tr>
            <tr>
                <th>Total Price:</th>
                <td class="total">$450</td>
            </tr>
            <tr>
                <th>Cancellation Fee:</th>
                <td>$50</td>
            </tr>
            <tr>
                <th>Refund Amount:</th>
                <td class="total">$400</td>
            </tr>
        </table>
        <p class="footer">If you have any questions or concerns, please don't hesitate to contact

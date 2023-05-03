<!DOCTYPE html>
<html>

<head>
    <title>New Dome Request</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 16px;
            line-height: 1.5;
            background-color: #f5f5f5;
            padding: 20px;
        }

        h1 {
            font-size: 24px;
            margin-top: 0;
            text-align: center;
        }

        p {
            margin-bottom: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 4px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .btn {
            display: inline-block;
            background-color: #000;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
        }

        .btn:hover {
            background-color: #292929;
        }
    </style>
</head>

<body>
    <div class="container">
        <div style="display: flex; justify-content:center;">
            <!-- Company Logo -->
            <img class="logo" src="{{ $logo }}" style="text-align:center" alt="Company Logo">
        </div>
        <h1>New Dome Request</h1>
        <p>Hello {{ $admin }},</p>
        <p>A new dome owner has submitted a request to join our platform. Here are the details:</p>
        <ul>
            <li><strong>Name:</strong> {{ $enquirydata->name }}</li>
            <li><strong>Email:</strong> {{ $enquirydata->email }}</li>
            <li><strong>Phone:</strong> {{ $enquirydata->phone }}</li>
            <li><strong>Dome Name:</strong> {{ $enquirydata->dome_name }}</li>
            <li><strong>Address:</strong> {{ $enquirydata->venue_address }}</li>
            <li><strong>City:</strong> {{ $enquirydata->dome_city }}</li>
            <li><strong>Zip / Postal Code:</strong> {{ $enquirydata->dome_zipcode }}</li>
            <li><strong>State / Province:</strong> {{ $enquirydata->dome_state }}</li>
            <li><strong>Country:</strong> {{ $enquirydata->dome_country }}</li>
        </ul>
        <p>Please review the information and take appropriate action. You can contact the seller using the provided
            email or phone number.</p>
        <p>Thank you!</p>
        <p style="font-size:0.9em;">Regards,<br />Domez Team</p>
    </div>
</body>

</html>

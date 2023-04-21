<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Login Credentials</title>
    <style>
        /* Basic styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
        }

        h1 {
            color: #0066cc;
            text-align: center;
        }

        table {
            background-color: #fff;
            border-collapse: collapse;
            margin: 0 auto;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #0066cc;
            color: #fff;
        }

        /* Responsive design for mobile devices */
        @media only screen and (max-width: 600px) {
            table {
                width: 100%;
            }

            td {
                display: block;
                text-align: center;
            }

            td:before {
                content: attr(data-label);
                font-weight: bold;
                display: inline-block;
                margin-bottom: 5px;
            }
        }
    </style>
</head>

<body>
    <h1>Login Credentials</h1>
    <table>
        <tr>
            <th>Username:</th>
            <td data-label="{{ $name }}">{{ $name }}</td>
        </tr>
        <tr>
            <th>Email:</th>
            <td data-label="{{ $email }}">{{ $email }}</td>
        </tr>
        <tr>
            <th>Password:</th>
            <td data-label="{{ $password }}">{{ $password }}</td>
        </tr>
    </table>
    <p style="font-size:0.9em;">Regards,<br />Domez Team</p>
</body>

</html>

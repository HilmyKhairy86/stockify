<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Activity Report</title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            background-color: #ffffff;
            margin: 20px;
            line-height: 1.6;
        }

        .table-container {
            margin: 0 auto;
            width: 90%;
            padding: 10px;
            background-color: #f9f9f9;
        }

        h1 {
            text-align: center;
            font-size: 1.5em;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        thead {
            background-color: #e6e6e6;
        }

        th, td {
            border: 1px solid #cccccc;
            padding: 10px;
            text-align: left;
        }

        th {
            font-size: 0.85rem;
            text-transform: uppercase;
            font-weight: bold;
            color: #333333;
        }

        td {
            font-size: 0.9rem;
            color: #333333;
        }

        tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        tbody tr:nth-child(even) {
            background-color: #ffffff;
        }

        .footer {
            text-align: center;
            font-size: 0.85rem;
            margin-top: 20px;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="table-container">
        <h1>Activity Report</h1>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>User</th>
                    <th>Activity</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <!-- Replace the following rows with dynamic data -->
                @foreach ($data as $index => $d)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $d->user_id }} - {{ $d->user->name }}</td>
                    <td>{{ $d->kegiatan }}</td>
                    <td>{{ $d->tanggal }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="footer">
        Generated on {{ date('Y-m-d') }}
    </div>
</body>
</html>

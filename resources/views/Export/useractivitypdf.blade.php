<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formal Report Table</title>
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
            border: 1px solid #000;
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
            background-color: #d4d4d4;
        }

        th, td {
            border: 1px solid #000;
            padding: 8px 12px;
            text-align: left;
        }

        th {
            text-transform: uppercase;
            font-weight: bold;
            font-size: 0.95rem;
        }

        tbody tr:nth-child(odd) {
            background-color: #f2f2f2;
        }

        tbody tr:nth-child(even) {
            background-color: #ffffff;
        }

        tbody td {
            font-size: 0.9rem;
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

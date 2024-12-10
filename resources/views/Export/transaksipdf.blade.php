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
            width: 95%;
            border: 1px solid #000;
            padding: 15px;
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
            padding: 10px;
            text-align: left;
        }

        th {
            text-transform: uppercase;
            font-weight: bold;
            font-size: 0.9rem;
            background-color: #eaeaea;
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

        .status {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 5px;
            font-size: 0.85rem;
            font-weight: bold;
            text-align: center;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-diterima {
            background-color: #d4edda;
            color: #155724;
        }

        .status-ditolak, .status-dikeluarkan {
            background-color: #f8d7da;
            color: #721c24;
        }

        .badge {
            display: inline-block;
            padding: 3px 6px;
            font-size: 0.85rem;
            font-weight: bold;
            border-radius: 5px;
        }

        .badge-in {
            background-color: #c8e6c9;
            color: #2e7d32;
        }

        .badge-out {
            background-color: #ffcdd2;
            color: #c62828;
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
        <h1>Product Activity Report</h1>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Product</th>
                    <th>User</th>
                    <th>Type</th>
                    <th>Quantity</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Notes</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $index => $d)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $d->product_id }} - {{ $d->product->name }}</td>
                    <td>{{ $d->user_id }} - {{ $d->user->name }}</td>
                    <td>
                        @if ($d->type == 'masuk')
                        <span class="badge badge-in">Masuk</span>
                        @else
                        <span class="badge badge-out">Keluar</span>
                        @endif
                    </td>
                    <td>{{ $d->quantity }}</td>
                    <td>{{ $d->date }}</td>
                    <td>
                        @switch($d->status)
                            @case('pending')
                                <span class="status status-pending">Pending</span>
                                @break
                            @case('diterima')
                                <span class="status status-diterima">Diterima</span>
                                @break
                            @case('ditolak')
                                <span class="status status-ditolak">Ditolak</span>
                                @break
                            @case('dikeluarkan')
                                <span class="status status-dikeluarkan">Dikeluarkan</span>
                                @break
                        @endswitch
                    </td>
                    <td>{{ $d->notes }}</td>
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

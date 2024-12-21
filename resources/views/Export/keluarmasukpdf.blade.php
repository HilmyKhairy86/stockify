<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Report</title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            margin: 20px;
            background-color: #f9f9f9;
        }

        h1 {
            text-align: center;
            font-size: 1.5em;
            margin-bottom: 20px;
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
        }

        @media (min-width: 1024px) {
            .grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .card {
            background-color: #ffffff;
            border: 1px solid #cccccc;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 10px;
        }

        h3 {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 15px;
            color: #333333;
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

        .status {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 0.85rem;
            font-weight: bold;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-diterima {
            background-color: #d4edda;
            color: #155724;
        }

        .status-ditolak,
        .status-dikeluarkan {
            background-color: #f8d7da;
            color: #721c24;
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
    <div>
        <h1>Product Keluar Masuk Report</h1>
        <div class="card">
            <h3>Product Masuk</h3>
            <table>
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>SKU</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($masuk as $m)
                    <tr>
                        <td>{{ $m->product->name }}</td>
                        <td>{{ $m->product->sku }}</td>
                        <td>
                            @switch($m->status)
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
                        <td>{{ $m->date }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Product Keluar Card -->
        <div class="card">
            <h3>Product Keluar</h3>
            <table>
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>SKU</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($keluar as $k)
                    <tr>
                        <td>{{ $k->product->name }}</td>
                        <td>{{ $k->product->sku }}</td>
                        <td>
                            @switch($k->status)
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
                        <td>{{ $k->date }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="footer">
      Generated on {{ date('Y-m-d') }}
    </div>
</body>
</html>

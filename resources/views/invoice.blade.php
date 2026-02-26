<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow p-4">

        <h2 class="text-center text-primary mb-4">Chicken Shop Invoice</h2>

        <p><strong>Invoice ID:</strong> {{ $order->id }}</p>
        <p><strong>Date:</strong> {{ $order->created_at->format('d M Y') }}</p>

        <hr>

        <h5>Customer</h5>
        <p>{{ $order->customer_name }}</p>
        <p>{{ $order->phone }}</p>

        <hr>

        <table class="table table-bordered">
            <tr>
                <th>Item</th>
                <td>{{ $order->item_name }}</td>
            </tr>
            <tr>
                <th>Rate / KG</th>
                <td>Rs {{ $order->rate_per_kg }}</td>
            </tr>
            <tr>
                <th>Weight</th>
                <td>{{ $order->weight }} KG</td>
            </tr>
            <tr class="table-success">
                <th>Total</th>
                <td><strong>Rs {{ $order->total_price }}</strong></td>
            </tr>
        </table>

        <div class="text-center mt-4">
            <button onclick="window.print()" class="btn btn-primary">
                🖨️ Print
            </button>

            <a href="{{ route('orders.index') }}" class="btn btn-secondary">
                Back
            </a>
        </div>

    </div>
</div>

</body>
</html>

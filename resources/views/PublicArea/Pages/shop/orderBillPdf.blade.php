<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Bill</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.5;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            border: 1px solid #ccc;
            padding: 20px;
            background: #fff;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #2c3e50;
        }
        .order-info, .billing-info, .order-items, .order-summary {
            margin-bottom: 20px;
        }
        .order-info h3, .billing-info h3, .order-summary h3 {
            font-size: 16px;
            color: #2c3e50;
            margin-bottom: 10px;
        }
        .order-info p, .billing-info p {
            margin: 5px 0;
        }
        .order-items table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .order-items th, .order-items td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        .order-items th {
            background: #f8f9fa;
            font-weight: bold;
        }
        .order-summary table {
            width: 100%;
            border-collapse: collapse;
        }
        .order-summary td {
            padding: 5px;
        }
        .summary-total {
            font-weight: bold;
            font-size: 14px;
        }
         .footer a {
            color: #e0ecf3;
            text-decoration: none;
            margin: 0 15px;
            transition: color 0.3s ease;
        }

        .footer a:hover {
            color: #ffffff;
            text-decoration: underline;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Order Bill - Optcare</h1>
            <p>Order #{{ $order->id }} | Date: {{ $order->created_at->format('d M Y, h:i A') }}</p>
        </div>

        <div class="order-info">
            <h3>Order Details</h3>
            <p><strong>Order Status:</strong> {{ ucfirst($order->status) }}</p>
            <p><strong>Payment Status:</strong> {{ $order->payment_status === 'completed' ? 'Paid' : 'Unpaid' }}</p>
            <p><strong>Total Amount:</strong> Rs.{{ number_format($order->total, 2) }}</p>
        </div>

        <div class="billing-info">
            <h3>Billing Information</h3>
            <p><strong>Name:</strong> {{ $order->first_name }}</p>
            <p><strong>Email:</strong> {{ $order->email }}</p>
            <p><strong>Phone:</strong> {{ $order->phone }}</p>
            <p><strong>Address:</strong> {{ $order->address }}, {{ $order->town_city }}, {{ $order->state }} {{ $order->zip }}, {{ $order->country }}</p>
        </div>

        <div class="order-items">
            <h3>Order Items</h3>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product</th>
                        <th>SKU</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->orderItems as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->product->sku ?? 'N/A' }}</td>
                            <td>
                                @if($item->discount > 0)
                                    <del>Rs.{{ number_format($item->price, 2) }}</del>
                                    Rs.{{ number_format($item->price * (1 - ($item->discount / 100)), 2) }}
                                    ({{ $item->discount }}% OFF)
                                @else
                                    Rs.{{ number_format($item->price, 2) }}
                                @endif
                            </td>
                            <td>{{ $item->quantity }}</td>
                            <td>Rs.{{ number_format($item->subtotal, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="order-summary">
            <h3>Order Summary</h3>
            <table>
                <tr>
                    <td>Items ({{ $order->orderItems->sum('quantity') }}):</td>
                    <td>Rs.{{ number_format($order->orderItems->sum('subtotal'), 2) }}</td>
                </tr>
                @if($order->shipping_cost > 0)
                    <tr>
                        <td>Shipping:</td>
                        <td>Rs.{{ number_format($order->shipping_cost, 2) }}</td>
                    </tr>
                @endif
                @if($order->tax > 0)
                    <tr>
                        <td>Tax:</td>
                        <td>Rs.{{ number_format($order->tax, 2) }}</td>
                    </tr>
                @endif
                <tr class="summary-total">
                    <td>Total:</td>
                    <td>Rs.{{ number_format($order->total, 2) }}</td>
                </tr>
            </table>
        </div>

        @if($order->note)
            <div class="order-notes">
                <h3>Order Notes</h3>
                <p>{{ $order->note }}</p>
            </div>
        @endif

            <div class="footer">
            <div>Connect with us</div>
            <div class="social-links">
                <a href="#" class="social-icon"><i class="fab fa-facebook"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-whatsapp"></i></a>
            </div>
            <div class="divider"></div>
            <div>No. 120, Galle Road, Colombo 03, Sri Lanka</div>
            <div>optcare@gmail.com • (+94) 702 74 0542</div>
            <div style="margin-top: 15px;">
                <a href="#">Unsubscribe</a>
                <a href="#">Privacy Policy</a>
            </div>
        </div>
    </div>
</body>
</html>

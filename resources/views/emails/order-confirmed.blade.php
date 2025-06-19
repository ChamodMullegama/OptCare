<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Confirmation - OptCare</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    /* Reset styles */
    body, html {
      margin: 0;
      padding: 0;
      font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
      line-height: 1.6;
      color: #333;
    }

    /* Main container */
    .container {
      max-width: 600px;
      margin: 20px auto;
      background-color: #f0f4f8;
      box-shadow: 0 4px 20px rgba(0,0,0,0.08);
      border-radius: 12px;
      overflow: hidden;
    }

    /* Header section */
    .header {
      background: linear-gradient(135deg, #2e7d9a 0%, #1a5f7a 100%);
      padding: 20px;
      text-align: center;
      position: relative;
    }

    .logo {
      font-size: 30px;
      font-weight: 700;
      color: white;
      letter-spacing: 2px;
      text-transform: uppercase;
      text-shadow: 1px 1px 3px rgba(0,0,0,0.2);
    }

    .tagline {
      color: #e0ecf3;
      font-style: italic;
      font-size: 16px;
      margin-top: 5px;
      opacity: 0.9;
    }

    /* Content sections */
    .content {
      padding: 30px;
      background-color: #ffffff;
    }

    .section {
      margin-bottom: 30px;
    }

    h1 {
      color: #2e7d9a;
      font-size: 26px;
      margin-bottom: 20px;
      font-weight: 700;
      position: relative;
      padding-bottom: 10px;
      text-align: center;
    }

    h1::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 60px;
      height: 3px;
      background: linear-gradient(to right, #4a90e2, transparent);
    }

    h2, h3 {
      color: #4a90e2;
      font-size: 20px;
      margin-bottom: 15px;
      font-weight: 600;
      letter-spacing: 0.5px;
    }

    p {
      margin-bottom: 15px;
      font-size: 16px;
      color: #444;
      line-height: 1.8;
    }

    /* Order details sections */
    .order-details, .billing-info {
      background: linear-gradient(to bottom, #e6f0fa 0%, #ffffff 100%);
      padding: 25px;
      border-radius: 10px;
      border-left: 5px solid #4a90e2;
      box-shadow: 0 3px 10px rgba(0,0,0,0.05);
    }

    /* Table styles */
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 15px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }

    th, td {
      padding: 12px 15px;
      text-align: left;
      border-bottom: 1px solid #e0ecf3;
    }

    th {
      background-color: #2e7d9a;
      color: white;
      font-weight: 600;
    }

    tr:nth-child(even) {
      background-color: #f8fbfe;
    }

    tr:hover {
      background-color: #e6f0fa;
    }

    /* Footer section */
    .footer {
      background: linear-gradient(135deg, #2e7d9a 0%, #1a5f7a 100%);
      color: #e0ecf3;
      text-align: center;
      padding: 30px 20px;
      font-size: 14px;
    }

    .social-links {
      margin: 20px 0;
    }

    .social-icon {
      display: inline-block;
      width: 40px;
      height: 40px;
      background-color: #e0ecf3;
      color: #2e7d9a;
      border-radius: 50%;
      text-align: center;
      line-height: 40px;
      margin: 0 10px;
      font-size: 18px;
      transition: all 0.3s ease;
    }

    .social-icon:hover {
      transform: scale(1.15);
      background-color: #ffffff;
      color: #1a5f7a;
    }

    .divider {
      height: 1px;
      background: linear-gradient(to right, transparent, #b3d4e9 50%, transparent);
      margin: 20px 0;
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

    /* Responsive adjustments */
    @media screen and (max-width: 480px) {
      .container {
        margin: 10px;
      }
      .content {
        padding: 20px;
      }
      .logo {
        font-size: 24px;
      }
      th, td {
        padding: 8px 10px;
        font-size: 14px;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <!-- Header with logo -->
    <div class="header">
      <div class="logo">OptCare</div>
      <div class="tagline">Your vision, our care</div>
    </div>

    <!-- Main content area -->
    <div class="content">
      <h1>Order Confirmation</h1>

      <div class="section">
        <p>Dear {{ $order->first_name }},</p>
        <p>Thank you for your order! We are pleased to confirm that your order has been successfully processed. Below are the details of your order:</p>
      </div>

      <div class="section order-details">
        <h2>Order Information</h2>
        <p><strong>Order ID:</strong> #{{ $order->id }}</p>
        <p><strong>Date:</strong> {{ $order->created_at->format('d M Y') }}</p>
        <p><strong>Total:</strong> Rs.{{ number_format($order->total, 2) }}</p>
        <p><strong>Payment Status:</strong> {{ ucfirst($order->payment_status) }}</p>
      </div>

      <div class="section billing-info">
        <h2>Billing Information</h2>
        <p><strong>Name:</strong> {{ $order->first_name }}</p>
        <p><strong>Email:</strong> {{ $order->email }}</p>
        <p><strong>Address:</strong> {{ $order->address }}, {{ $order->town_city }}, {{ $order->state }}, {{ $order->zip }}, {{ $order->country }}</p>
        <p><strong>Phone:</strong> {{ $order->phone }}</p>
        @if($order->note)
          <p><strong>Notes:</strong> {{ $order->note }}</p>
        @endif
      </div>

      <div class="section">
        <h2>Order Items</h2>
        <table>
          <thead>
            <tr>
              <th>Product</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Subtotal</th>
            </tr>
          </thead>
          <tbody>
            @foreach($order->orderItems as $item)
            <tr>
              <td>{{ $item->product->name }}</td>
              <td>Rs.{{ number_format($item->price * (1 - ($item->discount / 100)), 2) }}</td>
              <td>{{ $item->quantity }}</td>
              <td>Rs.{{ number_format($item->subtotal, 2) }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <div class="section">
        <p>If you have any questions or need further assistance, please contact our support team.</p>
        <p>Best regards,<br>OptCare Team</p>
      </div>
    </div>

    <!-- Footer with contact and social -->
    <div class="footer">
      <div>Connect with us</div>
      <div class="social-links">
        <a href="#" class="social-icon"><i class="fab fa-facebook"></i></a>
        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
        <a href="#" class="social-icon"><i class="fab fa-whatsapp"></i></a>
      </div>
      <div class="divider"></div>
      <div>59 Street, Kandy, Sri Lanka</div>
      <div>optcare@gmail.com • (+94) 222 468 5678</div>
      <div style="margin-top: 15px;">
        <a href="#">Unsubscribe</a>
        <a href="#">Privacy Policy</a>
      </div>
    </div>
  </div>
</body>
</html>

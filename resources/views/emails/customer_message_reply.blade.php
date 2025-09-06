<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OptCare - Customer Reply</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        /* (Same CSS styles from your OTP email) */
        body,
        html {
            margin: 0;
            padding: 0;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #f0f4f8;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border-radius: 12px;
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #2e7d9a 0%, #1a5f7a 100%);
            padding: 20px;
            text-align: center;
        }

        .logo {
            font-size: 30px;
            font-weight: 700;
            color: white;
            letter-spacing: 2px;
            text-transform: uppercase;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);
        }

        .tagline {
            color: #e0ecf3;
            font-style: italic;
            font-size: 16px;
            margin-top: 5px;
            opacity: 0.9;
        }

        .content {
            padding: 30px;
            background-color: #ffffff;
        }

        .section {
            margin-bottom: 40px;
        }

        h1 {
            color: #2e7d9a;
            font-size: 26px;
            margin-bottom: 20px;
            font-weight: 700;
            position: relative;
            padding-bottom: 10px;
        }

        h1::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background: linear-gradient(to right, #4a90e2, transparent);
        }

        h2 {
            color: #4a90e2;
            font-size: 20px;
            margin-bottom: 15px;
            font-weight: 600;
        }

        p {
            margin-bottom: 20px;
            font-size: 16px;
            color: #444;
            line-height: 1.8;
        }

        .featured {
            background: linear-gradient(to bottom, #e6f0fa 0%, #ffffff 100%);
            padding: 25px;
            border-radius: 10px;
            border-left: 5px solid #4a90e2;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
        }

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
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="logo">OptCare</div>
                <img src="{{ asset('PublicArea/images/logo.png') }}" alt="OptCare Logo" class="logo-image">
            <div class="tagline">Your vision, our care</div>
        </div>

        <!-- Main Content -->
        <div class="content">
            <div class="section">
                <h1>Dear {{ $customerName }},</h1>
                <p>Thank you for contacting us. Below is our response to your message.</p>
            </div>

            <div class="section featured">
                <h2>Your Message</h2>
                <p>{{ $originalMessage }}</p>
            </div>

            <div class="section featured">
                <h2>Our Reply</h2>
                <p>{{ $replyMessage }}</p>
            </div>

            <p>If you have any further questions, please feel free to reach out. We are here to help you.</p>
        </div>

        <!-- Footer -->
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

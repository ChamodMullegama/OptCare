<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>OptCare - Eye Health OTP</title>
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
      background-color: #f0f4f8; /* Light blue for a calming eye health theme */
      box-shadow: 0 4px 20px rgba(0,0,0,0.08);
      border-radius: 12px;
      overflow: hidden;
    }

    /* Header section */
    .header {
      background: linear-gradient(135deg, #2e7d9a 0%, #1a5f7a 100%); /* Blue gradient for eye health */
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
      color: #e0ecf3; /* Light blue for contrast */
      font-style: italic;
      font-size: 16px;
      margin-top: 5px;
      opacity: 0.9;
    }

    /* Hero section */
    .hero {
      width: 100%;
      height: 200px;
      background: url('https://via.placeholder.com/600x200?text=OptCare+Eye+Health') no-repeat center;
      background-size: cover;
      position: relative;
    }

    .hero-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0,0,0,0.2);
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .hero-text {
      color: white;
      font-size: 24px;
      font-weight: 600;
      text-shadow: 0 2px 4px rgba(0,0,0,0.3);
      text-align: center;
      padding: 0 20px;
    }

    /* Content sections */
    .content {
      padding: 30px;
      background-color: #ffffff;
    }

    .section {
      margin-bottom: 40px;
    }

    h1 {
      color: #2e7d9a; /* Matching header blue */
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
      background: linear-gradient(to right, #4a90e2, transparent); /* Blue gradient line */
    }

    h2 {
      color: #4a90e2; /* Softer blue for headings */
      font-size: 20px;
      margin-bottom: 15px;
      font-weight: 600;
      letter-spacing: 0.5px;
    }

    p {
      margin-bottom: 20px;
      font-size: 16px;
      color: #444;
      line-height: 1.8;
    }

    /* Featured product */
    .featured {
      background: linear-gradient(to bottom, #e6f0fa 0%, #ffffff 100%); /* Light blue gradient */
      padding: 25px;
      border-radius: 10px;
      border-left: 5px solid #4a90e2;
      box-shadow: 0 3px 10px rgba(0,0,0,0.05);
      transition: all 0.3s ease;
    }

    .featured:hover {
      transform: translateY(-3px);
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    /* Call to action button */
    .cta-button {
      display: inline-block;
      background: linear-gradient(45deg, #4a90e2 0%, #2e7d9a 100%);
      color: white;
      padding: 12px 35px;
      text-decoration: none;
      border-radius: 30px;
      font-weight: 600;
      font-size: 16px;
      margin: 15px 0;
      transition: all 0.3s ease;
      box-shadow: 0 3px 6px rgba(0,0,0,0.1);
    }

    .cta-button:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 12px rgba(0,0,0,0.15);
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
      background: linear-gradient(to right, transparent, #b3d4e9 50%, transparent); /* Light blue divider */
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
      .hero {
        height: 150px;
      }
      .hero-text {
        font-size: 20px;
      }
      .logo {
        font-size: 24px;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <!-- Header with logo -->
    <div class="header">
                   <img src="{{ asset('PublicArea/images/logo.png') }}" alt="OptCare Logo" class="logo-image">

      <div class="tagline">Your vision, our care</div>
    </div>

    <!-- Main content area -->
    <div class="content">
      <div class="section">
        <h1>Welcome to OptCare</h1>
        <p>Dear valued patient,</p>
        <p>We are delighted to assist you with your eye health journey. To complete your registration, please use the OTP code provided below.</p>
      </div>

      <!-- Featured product or service -->
      <div class="section featured">
        <h2>OTP for Registration</h2>
        <p>{!! nl2br(e($messageBody)) !!}</p>
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

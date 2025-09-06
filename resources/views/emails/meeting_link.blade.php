<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>OptCare - Appointment Meeting Link</title>
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
      margin-bottom: 15px;
      font-size: 16px;
      color: #444;
      line-height: 1.8;
    }

    .appointment-details {
      background: #e6f0fa;
      padding: 20px;
      border-radius: 8px;
      border-left: 4px solid #4a90e2;
      margin: 20px 0;
    }

    .detail-item {
      margin-bottom: 10px;
      display: flex;
    }

    .detail-label {
      font-weight: 600;
      color: #2e7d9a;
      min-width: 100px;
    }

    .meeting-link {
      display: inline-block;
      background: #4a90e2;
      color: white;
      padding: 10px 20px;
      text-decoration: none;
      border-radius: 5px;
      font-weight: 600;
      margin: 10px 0;
      transition: all 0.3s ease;
    }

    .meeting-link:hover {
      background: #2e7d9a;
    }

    /* Footer section */
    .footer {
      background: linear-gradient(135deg, #2e7d9a 0%, #1a5f7a 100%);
      color: #e0ecf3;
      text-align: center;
      padding: 25px 20px;
      font-size: 14px;
    }

    .social-links {
      margin: 15px 0;
    }

    .social-icon {
      display: inline-block;
      width: 35px;
      height: 35px;
      background-color: #e0ecf3;
      color: #2e7d9a;
      border-radius: 50%;
      text-align: center;
      line-height: 35px;
      margin: 0 8px;
      font-size: 16px;
      transition: all 0.3s ease;
    }

    .social-icon:hover {
      transform: scale(1.1);
      background-color: #ffffff;
    }

    .footer a {
      color: #e0ecf3;
      text-decoration: none;
      margin: 0 10px;
    }

    .footer a:hover {
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
      .detail-item {
        flex-direction: column;
      }
      .detail-label {
        margin-bottom: 5px;
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

    <!-- Main content area -->
    <div class="content">
      <div class="section">
        <h1>Appointment Confirmation</h1>
        <p>Hello {{ $patientName }},</p>
        <p>Your appointment has been successfully scheduled. Below are your appointment details:</p>
      </div>

      <div class="appointment-details">
        <div class="detail-item">
          <span class="detail-label">Date:</span>
          <span>{{ $date }}</span>
        </div>
        <div class="detail-item">
          <span class="detail-label">Time:</span>
          <span>{{ $time }}</span>
        </div>
        <div class="detail-item">
          <span class="detail-label">Meeting Link:</span>
          <span>
            <a href="{{ $meetingLink }}" class="meeting-link">
              Join Virtual Consultation
            </a>
          </span>
        </div>
      </div>

      <div class="section">
        <p>Please click the button above to join your virtual consultation at the scheduled time.</p>
        <p>For the best experience, we recommend:</p>
        <ul style="margin-left: 20px; color: #444;">
          <li>Joining 5 minutes before your appointment time</li>
          <li>Using a device with a good camera and microphone</li>
          <li>Ensuring you have a stable internet connection</li>
        </ul>
      </div>
    </div>

    <!-- Footer with contact and social -->
    <div class="footer">
      <div>Connect with us</div>
      <div class="social-links">
        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
        <a href="#" class="social-icon"><i class="fab fa-whatsapp"></i></a>
      </div>
      <div>59 Street, Kandy, Sri Lanka</div>
      <div>optcare@gmail.com • (+94) 222 468 5678</div>
      <div style="margin-top: 15px;">
        <a href="#">Privacy Policy</a> | <a href="#">Contact Support</a>
      </div>
    </div>
  </div>
</body>
</html>

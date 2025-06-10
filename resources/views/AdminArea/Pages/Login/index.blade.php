<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap Gallery - Medical Admin Templates & Dashboards</title>

    <!-- Meta -->
    <meta name="description" content="Marketplace for Bootstrap Admin Dashboards">
    <meta property="og:title" content="Admin Templates - Dashboard Templates">
    <meta property="og:description" content="Marketplace for Bootstrap Admin Dashboards">
    <meta property="og:type" content="Website">
    <link rel="shortcut icon" href="{{ asset('AdminArea/images/favicon.svg') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- *************
			************ CSS Files *************
		************* -->
    <link rel="stylesheet" href="{{ asset('AdminArea/fonts/remix/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminArea/css/main.min.css') }}">

  </head>

  <body class="login-bg">

    <!-- Container starts -->
    <div class="container">

      <!-- Auth wrapper starts -->
      <div class="auth-wrapper">

        <!-- Form starts -->
        <form action="{{ url('/') }}">

          <div class="auth-box">
            <a href="{{ url('/') }}" class="auth-logo mb-4">
              <img src="{{ asset('AdminArea/images/logo-dark.svg') }}" alt="Bootstrap Gallery">
            </a>

            <h4 class="mb-4">Login</h4>

            <div class="mb-3">
              <label class="form-label" for="email">Your email <span class="text-danger">*</span></label>
              <input type="text" id="email" class="form-control" placeholder="Enter your email">
            </div>

            <div class="mb-2">
              <label class="form-label" for="pwd">Your password <span class="text-danger">*</span></label>
              <div class="input-group">
                <input type="password" id="pwd" class="form-control" placeholder="Enter password">
                <button class="btn btn-outline-secondary" type="button">
                  <i class="fas fa-eye text-primary"></i>

                </button>
              </div>
            </div>

            <div class="d-flex justify-content-end mb-3">
              <a href="{{ url('forgot-password') }}" class="text-decoration-underline"></a>
            </div>

            <div class="mb-3 d-grid gap-2">
              <button type="submit" class="btn btn-primary">Login</button>

            </div>

          </div>

        </form>
        <!-- Form ends -->

      </div>
      <!-- Auth wrapper ends -->

    </div>
    <!-- Container ends -->

  </body>

</html>

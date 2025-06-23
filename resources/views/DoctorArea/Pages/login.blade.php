<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OptCare - Doctor Login</title>

    <!-- Meta -->
    <meta name="description" content="OptCare Admin Dashboard">
    <meta property="og:title" content="OptCare Admin Dashboard">
    <meta property="og:description" content="OptCare Admin Dashboard">
    <meta property="og:type" content="Website">
  <link rel="shortcut icon" href="{{ asset('PublicArea/images/favicon.ico') }}">
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
            <form action="{{ route('doctor.login') }}" method="POST">
                @csrf
                <div class="auth-box">
                    <a href="{{ route('doctor.login') }}" class="auth-logo mb-4">
                     <img src="{{ asset('PublicArea/images/logo.png') }}" alt="OptCare" style="margin-left: 40px;">
                    </a>



                    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0 list-unstyled">  <!-- Added list-unstyled class -->
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

                    <div class="mb-3">
                        <label class="form-label" for="email">Doctor email <span class="text-danger">*</span></label>
                        <input type="email" id="email" name="email"
                            class="form-control @error('email') is-invalid @enderror" placeholder="Enter your email"
                            value="{{ old('email') }}" required>
                    </div>

                    <div class="mb-2">
                        <label class="form-label" for="password">Doctor password <span
                                class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="password" id="password" name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Enter password" required>
                            <button class="btn btn-outline-secondary" type="button"
                                onclick="togglePassword('password')">
                                <i class="fas fa-eye text-primary"></i>
                            </button>
                        </div>
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

    <script>
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = input.nextElementSibling.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>

</html>

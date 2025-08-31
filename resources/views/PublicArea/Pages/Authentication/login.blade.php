@extends('PublicArea.Layout.main')
@section('Publiccontainer')
<section class="page-title">
    <div class="bg-layer" style="background-image: url({{ asset('PublicArea/images/background/page-title.jpg') }});"></div>
    <div class="auto-container">
        <div class="content-box">
            <h1>Login</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Login</li>
            </ul>
        </div>
    </div>
</section>
<section class="appointment-section">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-6 col-md-6 col-sm-12 image-column">
                <div class="image-inner mr_20">
                    <img src="{{ asset('PublicArea/images/project/project-13.jpg') }}" alt="Appointment Image" style="width: 100%; height: auto;">
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 form-column">
                <div class="form-inner ml_40">
                    <br><br><br><br><br>
                    <h3>Fill Login Form</h3>
                    @if(Session::has('customer_email'))
                        <div class="alert alert-success text-center">
                            You are already logged in as <strong>{{ Session::get('customer_name') }}</strong>.
                        </div>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="theme-btn btn-one">Logout</button>
                        </form>
                    @else
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="row clearfix">
                            @if ($errors->any())
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif
                            @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                                </div>
                            @endif
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <input type="email" name="email" placeholder="Email Address" value="{{ old('email') }}" required>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <input type="text" name="password" placeholder="Password" required>
                            </div>
                            <div class="col-lg-12 col-md-6 col-sm-12 form-group message-btn">
                                <button type="submit" class="theme-btn btn-one">Log in</button>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group text-center">
                                <label for="checkbox">Don't have an account? <a href="{{ route('register') }}">Register</a></label>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group text-center">
                                <a href="{{ route('google.login') }}" class="theme-btn btn-one" style="padding: 10px 60px; font-size: 14px; background-color: #dd4b39; border-color: #dd4b39; display: inline-block; margin-bottom: 10px; color: #fff; transition: all 0.3s ease; text-decoration: none; border-radius: 40px; width: 500px;" onmouseover="this.style.backgroundColor='black'; this.style.borderColor='black';" onmouseout="this.style.backgroundColor='#dd4b39'; this.style.borderColor='#dd4b39';">
                                    <i class="fab fa-google"></i> Google Auth
                                </a>
                            </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group text-center">
                                <a href="{{ route('facebook.login') }}" class="theme-btn btn-one" style="padding: 10px 60px; font-size: 14px; background-color: #3b5998; border-color: #3b5998; display: inline-block; margin-bottom: 10px; color: #fff; text-decoration: none; border-radius: 40px; width: 500px;" onmouseover="this.style.backgroundColor='black'; this.style.borderColor='black';" onmouseout="this.style.backgroundColor='#3b5998'; this.style.borderColor='#3b5998';">
                                    <i class="fab fa-facebook-f"></i> Facebook Auth
                                </a>
                            </div>
                        </div>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

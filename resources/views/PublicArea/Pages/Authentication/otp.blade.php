@extends('PublicArea.Layout.main')
@section('Publiccontainer')
<section class="page-title">
    <div class="bg-layer" style="background-image: url({{ asset('PublicArea/images/background/page-title.jpg') }});"></div>
    <div class="auto-container">
        <div class="content-box">
            <h1>Verify OTP</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Verify OTP</li>
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
                    <h3>Enter OTP</h3>
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
                    @if (session('success'))
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        </div>
                    @endif
                    @if (Session::has('otp_fallback'))
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <div class="alert alert-warning">
                                Email delivery failed. Use this fallback OTP: <strong>{{ Session::get('otp_fallback') }}</strong>
                            </div>
                        </div>
                    @endif
                    <form action="{{ route('verify.otp') }}" method="post">
                        @csrf
                        <div class="row clearfix">
                            <input type="hidden" name="email" value="{{ $email }}">
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <input type="text" name="otp" placeholder="Enter OTP" required>
                            </div>
                            <div class="col-lg-12 col-md-6 col-sm-12 form-group message-btn">
                                <button type="submit" class="theme-btn btn-one">Verify OTP</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@extends('PublicArea.Layout.main')
@section('Publiccontainer')
<section class="page-title">
    <div class="bg-layer" style="background-image: url({{ asset('PublicArea/images/background/page-title.jpg') }});"></div>
    <div class="auto-container">
        <div class="content-box">
            <h1>Create Account</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Registration</li>
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
                    <h3>Fill Registration Form</h3>
                    <form action="{{ route('register') }}" method="post">
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
                            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                <input type="text" name="first_name" placeholder="First name*" value="{{ old('first_name') }}" required>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                <input type="text" name="last_name" placeholder="Last name*" value="{{ old('last_name') }}" required>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <input type="email" name="email" placeholder="Email*" value="{{ old('email') }}" required>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <input type="text" name="phone" placeholder="Phone" value="{{ old('phone') }}" required>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <div class="select-box">
                                    <select class="wide" name="gender" required>
                                        <option data-display="Gender*">Gender*</option>
                                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <input type="text" name="birth_date" placeholder="Birth Day" id="datepicker" value="{{ old('birth_date') }}" required>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <input type="text" name="password" placeholder="Password*" required>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <input type="text" name="password_confirmation" placeholder="Confirm Password*" required>
                            </div>
                            <div class="col-lg-12 col-md-6 col-sm-12 form-group message-btn">
                                <button type="submit" class="theme-btn btn-one">Register</button>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group text-center">
                                <label for="checkbox">Already have an account? <a href="{{ route('login') }}">Login</a></label>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group text-center">
                                <a href="#" class="theme-btn btn-one" style="padding: 10px 60px; font-size: 14px; background-color: #dd4b39; border-color: #dd4b39; display: inline-block; margin-bottom: 10px; color: #fff; transition: all 0.3s ease; text-decoration: none; border-radius: 40px; width: 500px;" onmouseover="this.style.backgroundColor='black'; this.style.borderColor='black';" onmouseout="this.style.backgroundColor='#dd4b39'; this.style.borderColor='#dd4b39';">
                                    <i class="fab fa-google"></i> Google Auth
                                </a>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group text-center">
                                <a href="#" class="theme-btn btn-one" style="padding: 10px 60px; font-size: 14px; background-color: #3b5998; border-color: #3b5998; display: inline-block; margin-bottom: 10px; color: #fff; transition: all 0.3s ease; text-decoration: none; border-radius: 40px; width: 500px;" onmouseover="this.style.backgroundColor='black'; this.style.borderColor='black';" onmouseout="this.style.backgroundColor='#3b5998'; this.style.borderColor='#3b5998';">
                                    <i class="fab fa-facebook-f"></i> Facebook Auth
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('css')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endpush

@push('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script>
$(document).ready(function() {
    $("#datepicker").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        yearRange: "-100:+0",
        maxDate: new Date(),
        onSelect: function(dateText) {
            var birthDate = new Date(dateText);
            var today = new Date();
            var age = today.getFullYear() - birthDate.getFullYear();
            var monthDiff = today.getMonth() - birthDate.getMonth();
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            // Optionally, you can store age in a hidden input if needed on the client side
        }
    });
});
</script>
@endpush

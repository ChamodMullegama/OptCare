@extends('PublicArea.Layout.main')
@section('Publiccontainer')

        <section class="page-title">
        <div class="bg-layer" style="background-image: url({{ asset('PublicArea/images/background/page-title.jpg') }});"></div>

            <div class="auto-container">
                <div class="content-box">
                    <h1>Create Account</h1>
                    <ul class="bread-crumb clearfix">
                        <li><a href="index.html">Home</a></li>
                        <li>Registration</li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- End Page Title -->


        <!-- appointment-section -->
   <section class="appointment-section">
    <div class="auto-container">
        <div class="row clearfix">
            <!-- Left Column with Image -->
            <div class="col-lg-6 col-md-6 col-sm-12 image-column">
                <div class="image-inner mr_20">
                    <img src="{{ asset('PublicArea/images/project/project-13.jpg') }}" alt="Appointment Image" style="width: 100%; height: auto;">
                </div>
            </div>

            <!-- Right Column with Form -->
     <div class="col-lg-6 col-md-12 col-sm-12 form-column">
    <div class="form-inner ml_40">
        <h3>Fill Registration Form</h3>
        <form action="appointment.html" method="post">
            <div class="row clearfix">

                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                    <input type="text" name="fname" placeholder="First name*" required="">
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                    <input type="text" name="lname" placeholder="Last name*" required="">
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <input type="email" name="email" placeholder="Email*" required="">
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <input type="text" name="phone" placeholder="Phone" required="">
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <div class="select-box">
                        <select class="wide">
                            <option data-display="Gender*">Gender*</option>
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <input type="text" name="date" placeholder="Birth Day" id="datepicker">
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <input type="text" name="User Name*" placeholder="User Name" required="">
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <input type="text" name="Password*" placeholder="Password" required="">
                </div>

                <!-- Google Auth Button in middle of row -->


                <div class="col-lg-12 col-md-6 col-sm-12 form-group message-btn">
                    <button type="submit" class="theme-btn btn-one">Register</button>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 form-group text-center">
                    <label for="checkbox">Alredy Have An Account <a href="{{ route('Authentication.login') }}">Login?</a></label>
                </div>
            </div>
        </form>
    </div>
</div>

        </div>
    </div>
</section>



@endsection

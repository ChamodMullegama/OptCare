@extends('PublicArea.Layout.main')
@section('Publiccontainer')

        <section class="page-title">
        <div class="bg-layer" style="background-image: url({{ asset('PublicArea/images/background/page-title.jpg') }});"></div>

            <div class="auto-container">
                <div class="content-box">
                    <h1>Login</h1>
                    <ul class="bread-crumb clearfix">
                        <li><a href="index.html">Home</a></li>
                        <li>Login</li>
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
        <br><br><br><br><br>
        <h3>Fill Login Form</h3>
        <form action="appointment.html" method="post">
            <div class="row clearfix">



                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <input type="text" name="User Name*" placeholder="User Name" required="">
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <input type="text" name="Password*" placeholder="Password" required="">
                </div>

                <!-- Google Auth Button in middle of row -->


                <div class="col-lg-12 col-md-6 col-sm-12 form-group message-btn">
                    <button type="submit" class="theme-btn btn-one">Log in</button>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 form-group text-center">
                    <label for="checkbox">Do not have account <a href="{{ route('Authentication.register') }}">Register?</a></label>
                </div>
    <!-- Google Auth Button -->
<div class="col-lg-12 col-md-12 col-sm-12 form-group text-center">
    <a href="#" class="theme-btn btn-one" style="
        padding: 10px 60px; /* smaller height, wider width */
        font-size: 14px;
        background-color: #dd4b39;
        border-color: #dd4b39;
        display: inline-block;
        margin-bottom: 10px;
        color: #fff;
        transition: all 0.3s ease;
        text-decoration: none;
        border-radius: 40px;
        width: 500px; /* fixed typo: was 'with' */
    " onmouseover="this.style.backgroundColor='black'; this.style.borderColor='black';" onmouseout="this.style.backgroundColor='#dd4b39'; this.style.borderColor='#dd4b39';">
        <i class="fab fa-google"></i> Google Auth
    </a>
</div>

<!-- Facebook Auth Button -->
<div class="col-lg-12 col-md-12 col-sm-12 form-group text-center">
    <a href="#" class="theme-btn btn-one" style="
        padding: 10px 60px; /* smaller height, wider width */
        font-size: 14px;
        background-color: #3b5998;
        border-color: #3b5998;
        display: inline-block;
        margin-bottom: 10px;
        color: #fff;
        transition: all 0.3s ease;
        text-decoration: none;
        border-radius: 40px;
        width: 500px; /* fixed typo: was 'with' */
    " onmouseover="this.style.backgroundColor='black'; this.style.borderColor='black';" onmouseout="this.style.backgroundColor='#3b5998'; this.style.borderColor='#3b5998';">
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

        <!-- appointment-section end -->


        <!-- subscribe-section -->
        <section class="subscribe-section p_relative bg-color-2">
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-12 col-sm-12 text-column">
                        <div class="text">
                            <h2><i class="icon-41"></i>Join Us & Increase Your <br />Business.</h2>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 form-column">
                        <div class="form-inner ml_30 mt_5">
                            <form action="index-3.html" method="post">
                                <div class="form-group">
                                    <input type="email" name="email" placeholder="Your email address" required="">
                                    <button type="submit" class="theme-btn">Subscribe</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

@endsection

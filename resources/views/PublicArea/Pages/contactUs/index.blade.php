@extends('PublicArea.Layout.main')
@section('Publiccontainer')
        <!-- Page Title -->
        <section class="page-title">
            <div class="bg-layer" style="background-image: url({{ asset('PublicArea/images/background/page-title.jpg') }});"></div>
            <div class="auto-container">
                <div class="content-box">
                    <h1>Contact Us</h1>
                    <ul class="bread-crumb clearfix">
                        <li><a href="index.html">Home</a></li>
                        <li>Contact Us</li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- End Page Title -->


        <!-- contact-info-section -->
   <section class="contact-info-section centred">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-4 col-md-6 col-sm-12 info-column">
                <div class="single-item">
                    <div class="icon-box"><i class="fas fa-map-marker-alt"></i></div>
                    <h3>Office Location</h3>
                    <p>629 12th St, Modesto, CA 95354 <br />United States</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 info-column">
                <div class="single-item">
                    <div class="icon-box"><i class="fas fa-envelope"></i></div>
                    <h3>Company Email</h3>
                    <p><a href="mailto:example@gmail.com">example@gmail.com</a><br /><a href="mailto:example@gmail.com">example@gmail.com</a></p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 info-column">
                <div class="single-item">
                    <div class="icon-box"><i class="fas fa-phone-alt"></i></div>
                    <h3>Contact Us</h3>
                    <p><a href="tel:11165458856">+(111)65-458-856</a><br /><a href="tel:11165458857">+(111)65-458-857</a></p>
                </div>
            </div>
        </div>
    </div>
</section>

        <!-- contact-info-section end -->


        <!-- contact-style-two -->
        <section class="contact-style-two p_relative">
            <div class="pattern-layer">
                <div class="pattern-1" style="background-image: url(assets/images/shape/shape-55.png);"></div>
                <div class="pattern-2" style="background-image: url(assets/images/shape/shape-56.png);"></div>
            </div>
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="col-lg-8 col-md-12 col-sm-12 big-column offset-lg-2">
                        <div class="form-inner">
                            <h2>Leave a Comment</h2>
                            <form method="post" action="sendemail.php" id="contact-form">
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <input type="text" name="username" placeholder="Your Name" required="">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <input type="email" name="email" placeholder="Your email" required="">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <input type="text" name="phone" required="" placeholder="Phone">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <input type="text" name="subject" required="" placeholder="Subject">
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <textarea name="message" placeholder="Message"></textarea>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn mr-0 centred">
                                        <button class="theme-btn btn-one" type="submit" name="submit-form">Submit Now</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- contact-style-two end -->


        <!-- google-map-section -->
        <section class="google-map-section p_relative">
            <div class="map-inner p_relative d_block">
                <div
                    class="google-map"
                    id="contact-google-map"
                    data-map-lat="40.712776"
                    data-map-lng="-74.005974"
                    data-icon-path="assets/images/icons/map-marker-2.png"
                    data-map-title="Brooklyn, New York, United Kingdom"
                    data-map-zoom="12"
                    data-markers='{
                        "marker-1": [40.712776, -74.005974, "<h4>Branch Office</h4><p>77/99 New York</p>","assets/images/icons/map-marker-2.png"]
                    }'>

                </div>
            </div>
        </section>
        <!-- google-map-section end -->


        <!-- subscribe-section -->
<section class="subscribe-section p_relative bg-color-2">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-6 col-md-12 col-sm-12 text-column">
                <div class="text">
                    <h2><i class="fas fa-eye"></i> Stay Updated on Eye Care Tips & News</h2>
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


        <!-- subscribe-section end -->
@endsection

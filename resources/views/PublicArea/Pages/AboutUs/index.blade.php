@extends('PublicArea.Layout.main')
@section('Publiccontainer')


   <!-- Page Title -->
       <section class="page-title">
        <div class="bg-layer" style="background-image: url({{ asset('PublicArea/images/background/page-title.jpg') }});"></div>

            <div class="auto-container">
                <div class="content-box">
                    <h1>About Us</h1>
                    <ul class="bread-crumb clearfix">
                        <li><a href="index.html">Home</a></li>
                        <li>About Us</li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- End Page Title -->


        <!-- about-section -->
        <section class="about-section">
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                        <div class="image_block_one">
                            <div class="image-box mr_30 pr_130 pb_100">
                                <div class="shape" style="background-image: url({{ asset('PublicArea/images/shape/shape-1.png') }});"></div>
                                <figure class="image"><img src="{{ asset('PublicArea/images/resource/process-1.png') }}" alt=""></figure>
                                <div class="text p_absolute r_0 b_0">
                                    <h2>30</h2>
                                    <h4>Years of Experience in This Field</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                        <div class="content_block_one">
                            <div class="content-box ml_30">
                                <div class="sec-title left p_relative d_block mb_25">
                                    <span class="sub-title">Who We Are?</span>
                                    <h2>The Great Place Of Eyecare Hospital Center</h2>
                                </div>
                                <div class="text p_relative d_block">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nost rud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur excepteur sint occaecat.</p>
                                </div>
                                <div class="inner-box">
                                    <div class="row clearfix">
                                        <div class="col-lg-6 col-md-6 col-sm-12 single-column">
                                            <div class="single-item">
                                                <h3>Our Mission</h3>
                                                <ul class="list-style-one clearfix">
                                                    <li>High-quality work</li>
                                                    <li>Straightforward pricing</li>
                                                    <li>Rapid response times</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 single-column">
                                            <div class="single-item">
                                                <h3>Our Vision</h3>
                                                <ul class="list-style-one clearfix">
                                                    <li>Emergency power solutions</li>
                                                    <li>Wiring and installation</li>
                                                    <li>Full-service electrical layout</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        <!-- funfact-section end -->
             <section class="chooseus-style-two about-page p_relative">
    <div class="shape-3 p_absolute t_0 r_0" style="background-image: url('{{ asset('PublicArea/images/shape/shape-51.png') }}');"></div>
    <div class="shape-2" style="background-image: url('{{ asset('PublicArea/images/shape/shape-21.png') }}');"></div>

    <!-- Video Background Column -->
    <div class="video-column" style="background-image: url('{{ asset('PublicArea/images/service/service-1.jpg') }}');">
        <div class="video-inner">
            <div class="video-btn">
                <a href="https://www.youtube.com/watch?v=nfP5N9Yc72A&amp;t=28s" class="lightbox-image" data-caption="">
                    <i class="fas fa-play"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Content Column -->
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                <div class="content_block_five">
                    <div class="content-box mr_70">
                        <div class="sec-title light mb_35">
                            <span class="sub-title">Why Choose</span>
                            <h2 class="mb_25">Great Reasons For People Choose Optcare</h2>
                            <p class="pt_2">Lorem ipsum dolor sit amet consectur adipicing elit sed do esmod tempor incididunt labore aliqua.</p>
                        </div>
                        <div class="inner-box">
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-6 col-sm-12 single-column">
                                    <div class="single-item p_relative d_block">
                                        <h4><a href="index-2.html">Quality Staff</a></h4>
                                        <p>Lorem ipsum dolor amet conad sed do usmod tempor.</p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 single-column">
                                    <div class="single-item p_relative d_block">
                                        <h4><a href="index-2.html">Quality Assistance</a></h4>
                                        <p>Lorem ipsum dolor amet conad sed do usmod tempor.</p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 single-column">
                                    <div class="single-item p_relative d_block">
                                        <h4><a href="index-2.html">Affordable Price</a></h4>
                                        <p>Lorem ipsum dolor amet conad sed do usmod tempor.</p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 single-column">
                                    <div class="single-item p_relative d_block">
                                        <h4><a href="index-2.html">Optimized Solutions</a></h4>
                                        <p>Lorem ipsum dolor amet conad sed do usmod tempor.</p>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- inner-box -->
                    </div> <!-- content-box -->
                </div> <!-- content_block_five -->
            </div> <!-- content-column -->
        </div> <!-- row -->
    </div> <!-- auto-container -->
</section>
   <!-- team-section -->
        <section class="team-section p_relative">
            <div class="pattern-layer" style="background-image: url(assets/images/shape/shape-9.png);"></div>
            <div class="auto-container">
                <div class="sec-title p_relative left mb_50">
                    <span class="sub-title">nd Our Team</span>
                    <h2>The Most Qualified Skillful & <br />Professional staff</h2>
                    <a href="team.html" class="theme-btn btn-two">View All Team</a>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-6 col-sm-12 team-block">
                        <div class="team-block-one wow fadeInUp animated animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                            <div class="inner-box p_relative d_block pr_55">
                                 <figure class="image-box p_relative d_block">
                            <img src="{{ asset('PublicArea/images/team/team-8.jpg') }}" alt="">
                        </figure>
                                <div class="lower-content p_absolute r_0 b_45 b_shadow_6 z_1 tran_5">
                                    <h3 class="d_block lh_30 mb_3 tran_5"><a href="team-details.html" class="d_iblock color_black">Catherine Denuve</a></h3>
                                    <span class="designation p_relative d_block fs_16 lh_20 font_family_poppins tran_5">Optegra eye</span>
                                    <ul class="social-links clearfix p_absolute l_25 b_14 tran_5">
                                        <li class="p_relative d_iblock pull-left mr_25"><a href="about-5.html" class="d_iblock fs_15"><i class="fab fa-facebook-f"></i></a></li>
                                        <li class="p_relative d_iblock pull-left mr_25"><a href="about-5.html" class="d_iblock fs_15"><i class="fab fa-twitter"></i></a></li>
                                        <li class="p_relative d_iblock pull-left mr_25"><a href="about-5.html" class="d_iblock fs_15"><i class="fab fa-linkedin-in"></i></a></li>
                                        <li class="p_relative d_iblock pull-left"><a href="about-5.html" class="d_iblock fs_15"><i class="fab fa-pinterest-p"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

                       <!-- testimonial-section -->
<section class="testimonial-section p_relative centred">
    <div class="pattern-layer" style="background-image: url(assets/images/shape/shape-6.png);"></div>
    <div class="auto-container">
        <div class="sec-title mb_60">
            <span class="sub-title">Testimonials</span>
            <h2>What Our Client Say <br />About Optcare</h2>
        </div>
        <div class="two-item-carousel owl-carousel owl-theme owl-nav-none dots-style-one">
            <div class="testimonial-block-one">
                <div class="inner-box p_relative d_block">
                    <div class="icon-box"><i class="fas fa-quote-left"></i></div>
                    <p>Adipisicing elit sed do eiusmodim tempor incid labore etax dolore magna aliqua enim minium quis veniam nostrud exercition ulamco laboris nisar aliquip commodo consequat duis aute irure dolor in reprehenderit in vol uptate velit esse.</p>
                    <h4>Rachel McAdams</h4>
                    <span class="designation">Electrician</span>
                </div>
            </div>
            <div class="testimonial-block-one">
                <div class="inner-box p_relative d_block">
                    <div class="icon-box"><i class="fas fa-quote-left"></i></div>
                    <p>Adipisicing elit sed do eiusmodim tempor incid labore etax dolore magna aliqua enim minium quis veniam nostrud exercition ulamco laboris nisar aliquip commodo consequat duis aute irure dolor in reprehenderit in vol uptate velit esse.</p>
                    <h4>Alex Smith</h4>
                    <span class="designation">Electrician</span>
                </div>
            </div>
            <div class="testimonial-block-one">
                <div class="inner-box p_relative d_block">
                    <div class="icon-box"><i class="fas fa-quote-left"></i></div>
                    <p>Adipisicing elit sed do eiusmodim tempor incid labore etax dolore magna aliqua enim minium quis veniam nostrud exercition ulamco laboris nisar aliquip commodo consequat duis aute irure dolor in reprehenderit in vol uptate velit esse.</p>
                    <h4>Rachel McAdams</h4>
                    <span class="designation">Electrician</span>
                </div>
            </div>
            <div class="testimonial-block-one">
                <div class="inner-box p_relative d_block">
                    <div class="icon-box"><i class="fas fa-quote-left"></i></div>
                    <p>Adipisicing elit sed do eiusmodim tempor incid labore etax dolore magna aliqua enim minium quis veniam nostrud exercition ulamco laboris nisar aliquip commodo consequat duis aute irure dolor in reprehenderit in vol uptate velit esse.</p>
                    <h4>Alex Smith</h4>
                    <span class="designation">Electrician</span>
                </div>
            </div>
            <div class="testimonial-block-one">
                <div class="inner-box p_relative d_block">
                    <div class="icon-box"><i class="fas fa-quote-left"></i></div>
                    <p>Adipisicing elit sed do eiusmodim tempor incid labore etax dolore magna aliqua enim minium quis veniam nostrud exercition ulamco laboris nisar aliquip commodo consequat duis aute irure dolor in reprehenderit in vol uptate velit esse.</p>
                    <h4>Rachel McAdams</h4>
                    <span class="designation">Electrician</span>
                </div>
            </div>
            <div class="testimonial-block-one">
                <div class="inner-box p_relative d_block">
                    <div class="icon-box"><i class="fas fa-quote-left"></i></div>
                    <p>Adipisicing elit sed do eiusmodim tempor incid labore etax dolore magna aliqua enim minium quis veniam nostrud exercition ulamco laboris nisar aliquip commodo consequat duis aute irure dolor in reprehenderit in vol uptate velit esse.</p>
                    <h4>Alex Smith</h4>
                    <span class="designation">Electrician</span>
                </div>
            </div>
        </div>
    </div>
</section>

        <!-- testimonial-section end -->
</section>



@endsection

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
                            <h2>07</h2>
                            <h4>Years of Excellence in Eye Care</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                <div class="content_block_one">
                    <div class="content-box ml_30">
                        <div class="sec-title left p_relative d_block mb_25">
                            <span class="sub-title">Who We Are?</span>
                            <h2>Dedicated to Advanced Eye Care and Patient Wellness</h2>
                        </div>
                        <div class="text p_relative d_block">
                            <p>Optcare is committed to providing cutting-edge eye health services, including AI-powered OCT scan analysis and accessible online appointment booking to deliver personalized care to every patient.</p>
                        </div>
                        <div class="inner-box">
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-6 col-sm-12 single-column">
                                    <div class="single-item">
                                        <h3>Our Mission</h3>
                                        <ul class="">
                                            <li><i class="fas fa-check-circle"></i> Deliver accurate and fast eye diagnostics</li>
                                            <li><i class="fas fa-calendar-check"></i> Provide easy access to eye specialists online</li>
                                            <li><i class="fas fa-book-reader"></i> Promote awareness and education about eye health</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 single-column">
                                    <div class="single-item">
                                        <h3>Our Vision</h3>
                                        <ul class="">
                                            <li><i class="fas fa-star"></i> Be the most trusted eye care provider in the region</li>
                                            <li><i class="fas fa-lightbulb"></i> Use innovative technology to improve vision care</li>
                                            <li><i class="fas fa-hand-holding-heart"></i> Make eye health services affordable and accessible</li>
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
</section>


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
                            <h2 class="mb_25">Great Reasons To Choose Optcare</h2>
                            <p class="pt_2">Optcare combines cutting-edge AI technology with accessible eye care services to improve vision health for all.</p>
                        </div>
                        <div class="inner-box">
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-6 col-sm-12 single-column">
                                    <div class="single-item p_relative d_block">
                                        <h4><a href="index-2.html">Expert AI Analysis</a></h4>
                                        <p>Fast, accurate OCT scan interpretation to detect retinal diseases early and improve treatment outcomes.</p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 single-column">
                                    <div class="single-item p_relative d_block">
                                        <h4><a href="index-2.html">Online Appointments</a></h4>
                                        <p>Conveniently book consultations with qualified eye specialists from the comfort of your home.</p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 single-column">
                                    <div class="single-item p_relative d_block">
                                        <h4><a href="index-2.html">Affordable & Free Services</a></h4>
                                        <p>Providing free OCT scan analysis and affordable eye care options for everyone.</p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 single-column">
                                    <div class="single-item p_relative d_block">
                                        <h4><a href="index-2.html">Patient Education</a></h4>
                                        <p>Empowering patients with knowledge about eye health and prevention to maintain clear vision.</p>
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
    <span class="sub-title">Meet Our Team</span>
    <h2>Our Skilled & Professional <br>Optic Care Team</h2>
    <a href="" class="theme-btn btn-two">View All Team Members</a>
</div>

        <div class="row clearfix">
            @foreach($teams as $team)
            <div class="col-lg-4 col-md-6 col-sm-12 team-block">
                <div class="team-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                    <div class="inner-box p_relative d_block pr_55">
                        <figure class="image-box p_relative d_block">
                            @if($team->image)
                                <img src="{{ asset('storage/' . $team->image) }}" alt="{{ $team->name }}">
                            @else
                                <img src="{{ asset('PublicArea/images/team/default.jpg') }}" alt="Default Team Member">
                            @endif
                        </figure>
                        <div class="lower-content p_absolute r_0 b_45 b_shadow_6 z_1 tran_5">
                            <h3 class="d_block lh_30 mb_3 tran_5">
                                <a href="" class="d_iblock color_black">{{ $team->name }}</a>
                            </h3>
                            <span class="designation p_relative d_block fs_16 lh_20 font_family_poppins tran_5">{{ $team->role }}</span>
                            <ul class="social-links clearfix p_absolute l_25 b_14 tran_5">
                                <li class="p_relative d_iblock pull-left mr_25">
                                    <a href="#" class="d_iblock fs_15"><i class="fab fa-facebook-f"></i></a>
                                </li>
                                <li class="p_relative d_iblock pull-left mr_25">
                                    <a href="#" class="d_iblock fs_15"><i class="fab fa-twitter"></i></a>
                                </li>
                                <li class="p_relative d_iblock pull-left mr_25">
                                    <a href="#" class="d_iblock fs_15"><i class="fab fa-linkedin-in"></i></a>
                                </li>
                                <li class="p_relative d_iblock pull-left">
                                    <a href="#" class="d_iblock fs_15"><i class="fab fa-pinterest-p"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

                       <!-- testimonial-section -->
<section class="testimonial-section p_relative centred">
    <div class="pattern-layer" style="background-image: url(assets/images/shape/shape-6.png);"></div>
    <div class="auto-container">
        <div class="sec-title mb_60">
            <span class="sub-title">Testimonials</span>
            <h2>What Our Patients Say <br />About Optcare</h2>
        </div>

        @if($reviews->count() > 0)
        <div class="two-item-carousel owl-carousel owl-theme owl-nav-none dots-style-one">
            @foreach($reviews->take(6) as $review) <!-- Limit to 6 reviews -->
            <div class="testimonial-block-one">
                <div class="inner-box p_relative d_block">
                    <div class="icon-box"><i class="fas fa-quote-left"></i></div>
                    <p>{{ Str::limit($review->message, 150) }}</p> <!-- Limit message length -->
                    <h4>{{ $review->name }}</h4>
                    <span class="designation">{{ $review->created_at->format('M d, Y') }}</span> <!-- Show review date -->
                </div>
            </div>
            @endforeach
        </div>

        <!-- View All Reviews Button -->

        @else
        <div class="alert alert-info text-center">
            <p>No reviews yet. Be the first to share your experience!</p>
        </div>
        @endif
    </div>
</section>
 <section class="contact-style-two p_relative">
            <div class="pattern-layer">
                <div class="pattern-1" style="background-image: url(assets/images/shape/shape-55.png);"></div>
                <div class="pattern-2" style="background-image: url(assets/images/shape/shape-56.png);"></div>
            </div>
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="col-lg-8 col-md-12 col-sm-12 big-column offset-lg-2">
                        <div class="form-inner">
                            <h2>Submit a Review</h2>

                             <form action="{{ route('review.add') }}" method="post">
                              @csrf
@if (session('success'))
    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    </div>
@endif

                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <input type="text" name="name" placeholder="Your Name" required="">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <input type="email" name="email" placeholder="Your email" required="">
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <textarea name="message" placeholder="Message"></textarea>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn mr-0 centred">
                                        <button class="theme-btn btn-one" type="submit" name="submit-form">Submit Review</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- testimonial-section end -->
</section>



@endsection

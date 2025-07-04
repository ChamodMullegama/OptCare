@extends('PublicArea.Layout.main')
@section('Publiccontainer')

 <!-- banner-section -->
 {{-- <section class="banner-style-two centred p_relative">
    <div class="banner-carousel owl-theme owl-carousel owl-dots-none">
        <div class="slide-item p_relative">
            <div class="image-layer p_absolute" style="background-image:url('{{ asset('PublicArea/images/banner/banner-1.jpg') }}')"></div>
            <div class="pattern-layer">
                <div class="pattern-1" style="background-image: url('{{ asset('PublicArea/images/shape/shape-3.png') }}');"></div>
                <div class="pattern-2" style="background-image: url('{{ asset('PublicArea/images/shape/shape-12.png') }}');"></div>
                <div class="pattern-3" style="background-image: url('{{ asset('PublicArea/images/shape/shape-13.png') }}');"></div>
                <div class="eye-icon rotate-me" style="background-image: url('{{ asset('PublicArea/images/icons/icon-1.png') }}');"></div>
            </div>
            <div class="auto-container">
                <div class="content-box">
                    <span class="big-title animation_text_word"></span>
                    <h3>Eye Care & Holistic Health Center</h3>
                    <h2>Eye Care & Holistic Health Center</h2>
                    <p>We solve all your eye care needs by providing personalized and holistic eye care for you and your family!</p>
                    <div class="btn-box">
                        <a href="contact.html" class="theme-btn btn-one">Contact Now</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="slide-item p_relative">
            <div class="image-layer p_absolute" style="background-image:url('{{ asset('PublicArea/images/banner/banner-2.jpg') }}')"></div>
            <div class="pattern-layer">
                <div class="pattern-1" style="background-image: url('{{ asset('PublicArea/images/shape/shape-3.png') }}');"></div>
                <div class="pattern-2" style="background-image: url('{{ asset('PublicArea/images/shape/shape-12.png') }}');"></div>
                <div class="pattern-3" style="background-image: url('{{ asset('PublicArea/images/shape/shape-13.png') }}');"></div>
                <div class="eye-icon rotate-me" style="background-image: url('{{ asset('PublicArea/images/icons/icon-1.png') }}');"></div>
            </div>
            <div class="auto-container">
                <div class="content-box">
                    <span class="big-title animation_text_word"></span>
                    <h3>Eye Care & Holistic Health Center</h3>
                    <h2>Eye Care & Holistic Health Center</h2>
                    <p>We solve all your eye care needs by providing personalized and holistic eye care for you and your family!</p>
                    <div class="btn-box">
                        <a href="contact.html" class="theme-btn btn-one">Contact Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}

<section class="banner-style-two centred p_relative">
    <div class="banner-carousel owl-theme owl-carousel owl-dots-none">
        <div class="slide-item p_relative">
            <div class="image-layer p_absolute" style="background-image:url('{{ asset('PublicArea/images/banner/banner-1.jpg') }}')"></div>
            <div class="pattern-layer">
                <div class="pattern-1" style="background-image: url('{{ asset('PublicArea/images/shape/shape-3.png') }}');"></div>
                <div class="pattern-2" style="background-image: url('{{ asset('PublicArea/images/shape/shape-12.png') }}');"></div>
                <div class="pattern-3" style="background-image: url('{{ asset('PublicArea/images/shape/shape-13.png') }}');"></div>
                <div class="eye-icon rotate-me" style="background-image: url('{{ asset('PublicArea/images/icons/icon-1.png') }}');"></div>
            </div>
            <div class="auto-container">
                <div class="content-box">
                    <span class="big-title animation_text_word"></span>

                    <h3>AI-Based OCT Analysis</h3>
                    <h2>Free OCT Scan Analysis </h2>
              <p>Get quick and accurate OCT scan results at no cost — safe, simple, and fast for everyone.</p>
                    <div class="btn-box">
                        <a href="{{ route('oct.uploadOctPublic') }}" class="theme-btn btn-one">Oct Scan Analysis</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="slide-item p_relative">
            <div class="image-layer p_absolute" style="background-image:url('{{ asset('PublicArea/images/banner/banner-2.jpg') }}')"></div>
            <div class="pattern-layer">
                <div class="pattern-1" style="background-image: url('{{ asset('PublicArea/images/shape/shape-3.png') }}');"></div>
                <div class="pattern-2" style="background-image: url('{{ asset('PublicArea/images/shape/shape-12.png') }}');"></div>
                <div class="pattern-3" style="background-image: url('{{ asset('PublicArea/images/shape/shape-13.png') }}');"></div>
                <div class="eye-icon rotate-me" style="background-image: url('{{ asset('PublicArea/images/icons/icon-1.png') }}');"></div>
            </div>
            <div class="auto-container">
                <div class="content-box">
                    <span class="big-title animation_text_word"></span>
 <h3>Smart Eye Care Platform</h3>
                    <h2>Book Appointments Online</h2>
                    <p>Consult eye specialists easily through our trusted online platform. Fast, free, and accessible for everyone.</p>


                    <div class="btn-box">
                        <a href="{{ route('PublicAreaAppointment.appointment') }}" class="theme-btn btn-one">Online Appointment</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


        <!-- banner-section -->
        {{-- <section class="banner-style-two centred p_relative">
            <div class="banner-carousel owl-theme owl-carousel owl-dots-none">
                <div class="slide-item p_relative">
                    <div class="image-layer p_absolute" style="background-image:url('{{ asset('PublicArea/images/banner/banner-1.jpg') }}')"></div>
                    <div class="pattern-layer">
                        <div class="pattern-1" style="background-image: url('{{ asset('PublicArea/images/shape/shape-3.png') }}');"></div>
                        <div class="pattern-2" style="background-image: url('{{ asset('PublicArea/images/shape/shape-12.png') }}');"></div>
                        <div class="pattern-3" style="background-image: url('{{ asset('PublicArea/images/shape/shape-13.png') }}');"></div>
                        <div class="eye-icon rotate-me" style="background-image: url('{{ asset('PublicArea/images/icons/icon-1.png') }}');"></div>
                    </div>
                    <div class="auto-container">
                        <div class="content-box">
                            <span class="big-title animation_text_word"></span>
                            <h3>Eye Care & Holistic Health Center</h3>
                            <h2>Eye Care & Holistic Health Center</h2>
                            <p>We solve all your eye care needs by providing personalized and holistic eye care for you and your family!</p>
                            <div class="btn-box">
                                <a href="contact.html" class="theme-btn btn-one">Contact Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slide-item p_relative">
                    <div class="image-layer p_absolute" style="background-image:url('{{ asset('PublicArea/images/banner/banner-2.jpg') }}')"></div>
                    <div class="pattern-layer">
                        <div class="pattern-1" style="background-image: url('{{ asset('PublicArea/images/shape/shape-3.png') }}');"></div>
                        <div class="pattern-2" style="background-image: url('{{ asset('PublicArea/images/shape/shape-12.png') }}');"></div>
                        <div class="pattern-3" style="background-image: url('{{ asset('PublicArea/images/shape/shape-13.png') }}');"></div>
                        <div class="eye-icon rotate-me" style="background-image: url('{{ asset('PublicArea/images/icons/icon-1.png') }}');"></div>
                    </div>
                    <div class="auto-container">
                        <div class="content-box">
                            <span class="big-title animation_text_word"></span>
                            <h3>Eye Care & Holistic Health Center</h3>
                            <h2>Eye Care & Holistic Health Center</h2>
                            <p>We solve all your eye care needs by providing personalized and holistic eye care for you and your family!</p>
                            <div class="btn-box">
                                <a href="contact.html" class="theme-btn btn-one">Contact Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}
        <!-- banner-section end -->

        <!-- banner-section end -->


        <!-- feature-style-two -->
        <section class="feature-style-two p_relative pt_100 pb_100">
            <div class="pattern-layer">
             <div class="pattern-1" style="background-image: url('{{ asset('PublicArea/images/shape/shape-14.png') }}');"></div>
<div class="pattern-2" style="background-image: url('{{ asset('PublicArea/images/shape/shape-15.png') }}');"></div>

            </div>
           <div class="auto-container">
    <div class="row clearfix">
        <div class="col-lg-3 col-md-6 col-sm-12 feature-block">
            <div class="feature-block-two wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500m">
                <div class="inner-box">
                    <div class="icon-box"><i class="fas fa-user-md"></i></div> <!-- Qualified Doctors -->
                    <h3><a href="#">Expert Doctors</a></h3>
                        <p>Our platform is supported by experienced ophthalmologists to ensure reliable AI-assisted results.</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 feature-block">
            <div class="feature-block-two wow fadeInUp animated" data-wow-delay="200ms" data-wow-duration="1500m">
                <div class="inner-box">
           <div class="icon-box"><i class="fas fa-laptop-medical"></i></div> <!-- Online & Modern Systems -->
<h3><a href="#">Modern Tech</a></h3>
<p>OptCare offers cutting-edge equipment and an online appointment system for faster, smarter eye care.</p>

                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 feature-block">
            <div class="feature-block-two wow fadeInUp animated" data-wow-delay="400ms" data-wow-duration="1500m">
                <div class="inner-box">
                    <div class="icon-box"><i class="fas fa-notes-medical"></i></div> <!-- Emergency Help -->
                                          <h3><a href="#">Quick Diagnostics</a></h3>
                        <p>Get instant analysis of your retina scans powered by AI for fast and accessible healthcare decisions.</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 feature-block">
            <div class="feature-block-two wow fadeInUp animated" data-wow-delay="600ms" data-wow-duration="1500m">
                <div class="inner-box">
                    <div class="icon-box"><i class="fas fa-user-friends"></i></div> <!-- Individual Approach -->
                    <h3><a href="index-2.html">Individual Approach</a></h3>
                        <p>We provide user-friendly insights and educational support tailored to your eye health conditions.</p>
                </div>
            </div>
        </div>
    </div>
</div>

        </section>
        <!-- feature-style-two end -->


    <section class="about-style-two p_relative">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                <div class="content_block_four">
                    <div class="content-box mt_15">
                        <div class="sec-title mb_25">
                            <span class="sub-title">Who We Are?</span>
                            <h2>The Trusted Platform for AI-Powered Eye Diagnosis</h2>
                        </div>
                        <div class="text">
                            <p>OptCare is a smart web-based solution dedicated to early detection and education in eye care. By combining Optical Coherence Tomography (OCT) scan analysis with the power of AI, we aim to assist healthcare professionals and empower patients with timely, accurate, and accessible vision insights.</p>
                        </div>
                        <div class="inner-box p_relative mb_40">
                            <div class="single-item">
                                <div class="icon-box"><i class="fas fa-eye"></i></div>
                                <h3>Enhancing Patient <br />Vision Outcomes</h3>
                            </div>
                            <div class="single-item">
                                <div class="icon-box"><i class="fas fa-user-md"></i></div>
                                <h3>AI Support for <br />Eye Specialists</h3>
                            </div>
                        </div>

                        <div class="btn-box">
                            <a href="team.html" class="theme-btn btn-one">View All Team</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                <div class="image_block_three">
                    <div class="image-box ml_13 pr_20 pl_60">
                        <div class="shape">
                            <div class="shape-1" style="background-image: url('{{ asset('PublicArea/images/shape/shape-16.png') }}');"></div>
                            <div class="shape-2" style="background-image: url('{{ asset('PublicArea/images/shape/shape-16.png') }}');"></div>
                        </div>
                        <figure class="image">
                            <img src="{{ asset('PublicArea/images/resource/about-1.png') }}" alt="">
                        </figure>

                        <div class="text p_absolute l_0 b_40">
                            <h2>07</h2>
                            <h4>Years of Combined Expertise in Vision & AI</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



        <!-- service-style-two -->
      <section class="service-style-two p_relative">
    <div class="pattern-layer">
        <div class="pattern-1 p_absolute l_20 b_20" style="background-image: url('{{ asset('PublicArea/images/shape/shape-18.png') }}');"></div>
        <div class="pattern-2 p_absolute t_20 r_20" style="background-image: url('{{ asset('PublicArea/images/shape/shape-19.png') }}');"></div>
    </div>
    <div class="auto-container">
        <div class="sec-title centred mb_50">
            <span class="sub-title">Our Services</span>
            <h2>A Global Leader, Treatment <br />of Eye Disease</h2>
        </div>
        <div class="row clearfix">
            @foreach($services as $service)
                <div class="col-lg-4 col-md-6 col-sm-12 service-block">
                    <div class="service-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <figure class="image-box">
                                @if($service->images->isNotEmpty())
                                    <img src="{{ asset('storage/' . $service->images->first()->image) }}" alt="{{ $service->title }}">
                                @else
                                    <img src="{{ asset('PublicArea/images/service/service-2.jpg') }}" alt="{{ $service->title }}">
                                @endif
                                <a href="{{ url('services/' . Str::slug($service->title)) }}"><i class="fas fa-link"></i></a>
                            </figure>
                            <div class="lower-content">
                                <div class="icon-box"><i class="fas fa-eye"></i></div>
                                <h3><a href="{{ url('services/' . Str::slug($service->title)) }}">{{ $service->title }}</a></h3>
                                <p class="p_relative d_block">{{ Str::limit(strip_tags($service->description), 100) }}</p>


                                {{-- <div class="link p_relative d_block"><a href="{{ url('services/' . Str::slug($service->title)) }}">Read More</a></div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
        <!-- service-style-two end -->


     <!-- chooseus-style-two -->
<section class="chooseus-style-two p_relative">
    <div class="shape p_absolute t_0 r_0" style="background-image: url('{{ asset('PublicArea/images/shape/shape-20.png') }}');"></div>
    <div class="shape-2" style="background-image: url('{{ asset('PublicArea/images/shape/shape-21.png') }}');"></div>
    <div class="video-column" style="background-image: url('{{ asset('PublicArea/images/project/project-21.jpg') }}');">
        <div class="video-inner">
            <div class="video-btn">
                <a href="https://www.youtube.com/watch?v=nfP5N9Yc72A&amp;t=28s" class="lightbox-image" data-caption=""><i class="fas fa-play"></i></a>
            </div>
        </div>
    </div>
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-6 col-md-12 col-sm-12 offset-lg-6">
                <div class="content_block_five">
                    <div class="content-box ml_70">
                        <div class="sec-title light mb_35">
                            <span class="sub-title">Why Choose</span>
                            <h2 class="mb_25">Why Patients Prefer OptCare Services</h2>
                            <p class="pt_2">OptCare combines AI-driven OCT scan analysis and free online doctor appointments, making quality eye care accessible to everyone — at no cost.</p>
                        </div>
                        <div class="inner-box">
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-6 col-sm-12 single-column">
                                    <div class="single-item p_relative d_block">
                                        <h4><a href="#">Free OCT Scan Analysis</a></h4>
                                        <p>Upload your eye scan and receive instant AI-powered diagnostic results — 100% free.</p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 single-column">
                                    <div class="single-item p_relative d_block">
                                        <h4><a href="#">Free Online Appointments</a></h4>
                                        <p>Schedule appointments with eye care specialists anytime, anywhere, completely free.</p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 single-column">
                                    <div class="single-item p_relative d_block">
                                        <h4><a href="#">Vision Health Education</a></h4>
                                        <p>Access easy-to-understand guides to protect and maintain your long-term eye health.</p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 single-column">
                                    <div class="single-item p_relative d_block">
                                        <h4><a href="#">Simple & Fast</a></h4>
                                        <p>Our platform is designed for all users — easy access, fast results, no technical skills needed.</p>
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

<!-- chooseus-style-two end -->


        <!-- funfact-style-two -->
<section class="funfact-style-two p_relative">
    <div class="auto-container">
        <div class="inner-container bg-color-2 p_relative">
            <div class="counter-block-one wow slideInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                <div class="inner-box">
                    <div class="icon-box p_relative d_block fs_60">
                        <i class="fas fa-user-md"></i> <!-- Expert Doctors -->
                    </div>
                    <div class="count-outer count-box">
                        <span class="count-text" data-speed="1500" data-stop="90">0</span>
                    </div>
                    <p>Expert Doctors</p>
                </div>
            </div>
            <div class="counter-block-one wow slideInUp animated" data-wow-delay="200ms" data-wow-duration="1500ms">
                <div class="inner-box">
                    <div class="icon-box p_relative d_block fs_60">
                        <i class="fas fa-concierge-bell"></i> <!-- Different Services -->
                    </div>
                    <div class="count-outer count-box">
                        <span class="count-text" data-speed="1500" data-stop="2.6">0</span>
                    </div>
                    <p>Different Services</p>
                </div>
            </div>
            <div class="counter-block-one wow slideInUp animated" data-wow-delay="400ms" data-wow-duration="1500ms">
                <div class="inner-box">
                    <div class="icon-box p_relative d_block fs_60">
                        <i class="fas fa-smile"></i> <!-- Happy Patients -->
                    </div>
                    <div class="count-outer count-box">
                        <span class="count-text" data-speed="1500" data-stop="35">0</span>
                    </div>
                    <p>Happy Patients</p>
                </div>
            </div>
            <div class="counter-block-one wow slideInUp animated" data-wow-delay="600ms" data-wow-duration="1500ms">
                <div class="inner-box">
                    <div class="icon-box p_relative d_block fs_60">
                        <i class="fas fa-trophy"></i> <!-- Awards Win -->
                    </div>
                    <div class="count-outer count-box">
                        <span class="count-text" data-speed="1500" data-stop="10">0</span>
                    </div>
                    <p>Awards Win</p>
                </div>
            </div>
        </div>
    </div>
</section>

        <!-- funfact-style-two end -->


        <!-- team-style-two -->
        <section class="team-style-two">
            <div class="auto-container">
                <div class="sec-title centred mb_60">
                    <span class="sub-title">Ophthalmologist</span>
                    <h2>The Most Qualified Skillful & <br />Professional Doctors</h2>
                </div>
                <div class="row clearfix">
       @forelse($doctorS->take(6) as $doctor)

            <div class="col-lg-4 col-md-6 col-sm-12 team-block">
<div class="team-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms" style="margin-bottom: 20px;">

                    <div class="inner-box p_relative d_block pr_55">
                        <figure class="image-box p_relative d_block">
                            @if($doctor->profile_image)
                                <img src="{{ asset('storage/' . $doctor->profile_image) }}"
                                     alt="{{ $doctor->first_name }} {{ $doctor->last_name }}"
                                     style="width: 100%; height: 350px; object-fit: cover;">
                            @else
                                <img src="{{ asset('assets/images/team/doctor-placeholder.jpg') }}"
                                     alt="No Image"
                                     style="width: 100%; height: 350px; object-fit: cover;">
                            @endif
                        </figure>
                        <div class="lower-content p_absolute r_0 b_45 b_shadow_6 z_1 tran_5">
                            <h3 class="d_block lh_30 mb_3 tran_5">
                                <a href="{{ route('PublicAreDoctors.details', $doctor->id) }}" class="d_iblock color_black">
                                    Dr. {{ $doctor->first_name }} {{ $doctor->last_name }}
                                </a>
                            </h3>
                            <span class="designation p_relative d_block fs_16 lh_20 font_family_poppins tran_5">
                                {{ $doctor->designation ?? 'Medical Specialist' }}
                            </span>
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
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <h4>No doctors found</h4>
                <a href="{{ route('PublicAreDoctors.all') }}" type="submit" class="theme-btn btn-one"
                        style="padding: 10px 30px; font-size: 14px; background-color: #03c0b4; border-color: #03c0b4; color: #fff; transition: all 0.3s ease; border-radius: 40px;"
                        onmouseover="this.style.backgroundColor='black'; this.style.borderColor='black';"
                        onmouseout="this.style.backgroundColor='#1abc9c'; this.style.borderColor='#1abc9c';">View All Doctors</a>
            </div>
            @endforelse
        </div>
            </div>
             <div class="more-btn centred mt_60">
                    <a href="{{ route('PublicAreDoctors.all') }}" class="theme-btn btn-one">View All Doctors</a>
                </div>
        </div>
    </div>
</div>


            </div>
        </section>
        <!-- team-style-two end -->


        <!-- testimonial-style-two -->
      <section class="testimonial-style-two pt_100">
    <div class="bg-layer" style="background-image: url('{{ asset('PublicArea/images/banner/banner-2.jpg') }}');"></div>
    <div class="pattern-layer">
        <div class="pattern-1" style="background-image: url('{{ asset('PublicArea/images/shape/shape-22.png') }}');"></div>
        <div class="pattern-2" style="background-image: url('{{ asset('PublicArea/images/shape/shape-23.png') }}');"></div>
    </div>
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-xl-6 col-lg-12 col-md-12 content-column">
                <div class="content_block_six">
                    <div class="content-box p_relative z_2">
                        <div class="sec-title p_relative mb_35">
                            <span class="sub-title">Testimonial <i class="fa fa-quote-left"></i></span>
                            <h2>What Our Client Say About Optcare</h2>
                        </div>
                        <div class="single-item-carousel owl-carousel owl-theme owl-nav-none dots-style-one">
                            <div class="testimonial-content">
                                <div class="text p_relative d_block">
                                    <p><i class="fa fa-quote-left"></i> Optcare’s AI eye scan helped me detect early issues. The free online appointments made it easy and convenient. Friendly doctors and great service overall. Highly recommended! <i class="fa fa-quote-right"></i>.</p>
                                </div>
                                <div class="">
                                    <h3>Nimal Perera</h3>
                                    <span class="designation">Colombo</span>
                                </div>
                            </div>
                            <div class="testimonial-content">
                                <div class="text p_relative d_block">
                                    <p><i class="fa fa-quote-left"></i> Thanks to Optcare, I received quick diagnosis and helpful advice. The online system is simple to use. Eye health education was very useful. Truly a lifesaver for us! <i class="fa fa-quote-right"></i>.</p>
                                </div>
                                <div class="">

                                    <h3>Kumari Silva</h3>
                                    <span class="designation">Kandy</span>
                                </div>
                            </div>
                            <div class="testimonial-content">
                                <div class="text p_relative d_block">
                                    <p><i class="fa fa-quote-left"></i> Very professional and caring staff. The AI scan was impressive and accurate. Booking appointments online was smooth. I feel more confident about my vision health now. <i class="fa fa-quote-right"></i>.</p>
                                </div>
                                <div class="">

                                    <h3>Sunil Fernando</h3>
                                    <span class="designation">Galle</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

        <!-- testimonial-style-two end -->


        <!-- process-section -->
<section class="process-section p_relative centred">
    <div class="pattern-layer">
        <div class="pattern-1 rotate-me" style="background-image: url('{{ asset('PublicArea/images/icons/icon-1.png') }}');"></div>
        <div class="pattern-2" style="background-image: url('{{ asset('PublicArea/images/shape/shape-25.png') }}');"></div>
    </div>
    <div class="auto-container">
        <div class="sec-title centred mb_85">
            <span class="sub-title">How It Works</span>
            <h2>Easy Steps to Book Your <br />Free Eye Care Appointment</h2>
        </div>
        <div class="inner-container p_relative">
            <div class="shape" style="background-image: url('{{ asset('PublicArea/images/shape/shape-24.png') }}');"></div>
            <div class="row clearfix">
                <div class="col-lg-4 col-md-6 col-sm-12 processing-block">
                    <div class="process-block-one">
                        <div class="inner-box">
                            <div class="image-box">
                                <span class="count-text">01</span>
                                <figure class="image"><img src="{{ asset('PublicArea/images/resource/process-1.png') }}" alt=""></figure>
                            </div>
                            <h3>Choose a Specialist</h3>
                            <p>Browse and select a qualified eye care doctor based on your needs and preferences.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 processing-block">
                    <div class="process-block-one">
                        <div class="inner-box">
                            <div class="image-box">
                                <span class="count-text">02</span>
                                <figure class="image"><img src="{{ asset('PublicArea/images/resource/process-2.png') }}" alt=""></figure>
                            </div>
                            <h3>Book Appointment</h3>
                            <p>Pick your preferred date and time and submit your free appointment request online.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 processing-block">
                    <div class="process-block-one">
                        <div class="inner-box">
                            <div class="image-box">
                                <span class="count-text">03</span>
                                <figure class="image"><img src="{{ asset('PublicArea/images/resource/process-3.png') }}" alt=""></figure>
                            </div>
                            <h3>Meet Your Doctor</h3>
                            <p>Connect with your eye doctor virtually or in person and receive personalized care advice.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


        <!-- process-section end -->


        <!-- skills-section -->
<section class="skills-section p_relative">
    <div class="pattern-layer">
        <div class="pattern-1" style="background-image: url('{{ asset('PublicArea/images/shape/shape-27.png') }}');"></div>
        <div class="pattern-2" style="background-image: url('{{ asset('PublicArea/images/shape/shape-28.png') }}');"></div>
    </div>
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                <div class="image_block_four">
                    <div class="image-box mr_70 pb_100">
                        <div class="shape" style="background-image: url('{{ asset('PublicArea/images/shape/shape-26.png') }}');"></div>
                        <div class="icon-box rotate-me">
                            <i class="fas fa-eye"></i>
                        </div>
                        <figure class="image image-1">
                            <img src="{{ asset('PublicArea/images/team/team-4.jpg') }}" alt="">
                        </figure>
                        <figure class="image image-2">
                            <img src="{{ asset('PublicArea/images/news/news-10.jpg') }}" alt="">
                        </figure>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                <div class="content_block_seven">
                    <div class="content-box ml_30">
                        <div class="sec-title mb_30">
                            <span class="sub-title">About OptCare</span>
                            <h2 class="mb_15">AI-Based Eye Care Services for All Ages</h2>
                            <p class="pt_12">OptCare offers AI-powered retinal disease detection, free online doctor appointments, and educational support to promote better vision care for both children and adults.</p>
                        </div>
                        <div class="progress-box">
                            <div class="progress-box p_relative d_block mb_25">
                                <h5><i class="fas fa-robot"></i> AI Diagnosis Accuracy</h5>
                                <div class="bar">
                                    <div class="bar-inner count-bar" data-percent="95%"></div>
                                    <div class="count-text">95%</div>
                                </div>
                            </div>
                            <div class="progress-box p_relative d_block mb_25">
                                <h5><i class="fas fa-calendar-check"></i> Free Online Appointments</h5>
                                <div class="bar">
                                    <div class="bar-inner count-bar" data-percent="100%"></div>
                                    <div class="count-text">100%</div>
                                </div>
                            </div>
                            <div class="progress-box p_relative d_block">
                                <h5><i class="fas fa-book-medical"></i> Vision Health Education</h5>
                                <div class="bar">
                                    <div class="bar-inner count-bar" data-percent="80%"></div>
                                    <div class="count-text">80%</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


        <!-- skills-section end -->


        <!-- project-section -->
<section class="project-section alternat-2 p_relative">
    <div class="outer-container">
        <div class="project-carousel-2 owl-carousel owl-theme owl-dots-none owl-nav-none">
            @isset($galleries)
                @forelse($galleries as $gallery)
                    <div class="project-block-one">
                        <div class="inner-box">
                            <figure class="image-box">

                                    <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title ?? '' }}">



                            </figure>
                            <div class="view-btn">
                                <a href="{{ isset($gallery->image) ? asset('storage/' . $gallery->image) : '#' }}" class="lightbox-image" data-fancybox="gallery">
                                    <i class="fas fa-search-plus"></i>
                                </a>
                            </div>
                            <div class="text">
                                <h3><a href="#">{{ $gallery->title ?? 'Untitled' }}</a></h3>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p>No galleries found.</p>
                    </div>
                @endforelse
            @else
                <div class="col-12">
                    <p>Galleries data not available.</p>
                </div>
            @endisset
        </div>
    </div>
</section>


        <!-- project-section end -->


        <!-- news-section -->
    <section class="news-section p_relative">
    <div class="auto-container">
        <div class="sec-title centred mb_50">
            <span class="sub-title">Articles</span>
            <h2>Resources to Keep You Informed <br />with Our Blog</h2>
        </div>
        <div class="row clearfix">
            @foreach($blogs as $key => $blog)
                @php
                    $primaryImage = $blog->images->firstWhere('isPrimary', 1) ?? $blog->images->first();
                @endphp
                <div class="col-lg-4 col-md-6 col-sm-12 news-block">
                    <div class="news-block-one wow fadeInUp animated" data-wow-delay="{{ $key * 300 }}ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <figure class="image-box">
                                @if($primaryImage)
                                    <img src="{{ asset('storage/'.$primaryImage->image) }}" alt="{{ $blog->title }}"
                                         style="width: 100%; height: 250px; object-fit: cover; object-position: center;">
                                @else
                                    <img src="{{ asset('PublicArea/images/news/news-2.jpg') }}" alt="{{ $blog->title }}"
                                         style="width: 100%; height: 250px; object-fit: cover; object-position: center;">
                                @endif
                                <a href="{{ route('PublicAreaBlog.details', $blog->blogId) }}"><i class="fas fa-link"></i></a>
                            </figure>
                            <div class="lower-content">
                                <div class="inner">
                                    <div class="category"><a href="{{ route('PublicAreaBlog.details', $blog->blogId) }}">{{ $blog->tags ?: 'General' }}</a></div>
                                    <h3><a href="{{ route('PublicAreaBlog.details', $blog->blogId) }}">{{ $blog->title }}</a></h3>
                                    <ul class="post-info clearfix">
                                        <li><i class="fas fa-calendar-alt"></i>{{ \Carbon\Carbon::parse($blog->date)->format('d M, Y') }}</li>
                                        <li><i class="fas fa-star"></i><a href="{{ route('PublicAreaBlog.details', $blog->blogId) }}">{{ $blog->special_thing }}</a></li>
                                    </ul>
                                    <p>{{ Str::limit(strip_tags($blog->content), 100) }}</p>
                                    <div class="link"><a href="{{ route('PublicAreaBlog.details', $blog->blogId) }}">Read more</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
        <!-- news-section end -->

        <section class="cta-section alternat-2 p_relative bg-color-1">
            <div class="pattern-layer">
         <div class="pattern-1" style="background-image: url({{ asset('PublicArea/images/shape/shape-29.png') }});"></div>
<div class="pattern-2" style="background-image: url({{ asset('PublicArea/images/shape/shape-30.png') }});"></div>

            </div>
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                        <div class="image-box mr_25 mt_60">
                           <div class="shape" style="background-image: url({{ asset('PublicArea/images/shape/shape-30.png') }});"></div>
<figure class="image p_relative z_1"><img src="{{ asset('PublicArea/images/resource/car-1.png') }}" alt=""></figure>

                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                        <div class="content-box ml_35">
                            <div class="sec-title left mb_25">
                                  <span class="sub-title">Emergency Eye Care</span>
                        <h2>Need Immediate Eye Care? <br />Call for <span>Urgent Support!</span></h2>
                            </div>
                            <div class="text">
                             <p>OptCare offers 24/7 emergency eye care services to help protect your vision whenever you need it most.</p>
                            </div>
                      <div class="support-box">
    <div class="icon-box">
        <i class="fas fa-phone-alt"></i> <!-- Font Awesome phone icon -->
    </div>
    <h4>For Emergency</h4>
    <h3><a href="tel:123045615523">(+94) 81 569 7452</a></h3>
</div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- cta-section -->
        {{-- <section class="cta-section alternat-2 p_relative bg-color-1">
            <div class="pattern-layer">
                <div class="pattern-1" style="background-image: url(assets/images/shape/shape-29.png);"></div>
                <div class="pattern-2" style="background-image: url(assets/images/shape/shape-30.png);"></div>
            </div>
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                        <div class="image-box mr_25 mt_60">
                            <div class="shape" style="background-image: url(assets/images/shape/shape-30.png);"></div>
                            <figure class="image p_relative z_1"><img src="assets/images/resource/car-1.png" alt=""></figure>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                        <div class="content-box ml_35">
                            <div class="sec-title left mb_25">
                                <span class="sub-title">Emergency Need</span>
                                <h2>Need a Doctor <br />for Check-up? Call for an <span>Emergency Service!</span></h2>
                            </div>
                            <div class="text">
                                <p>All of our services are backed by our 100% satisfaction guarantee Our electricians can install anything.</p>
                            </div>
                            <div class="support-box">
                                <div class="icon-box"><i class="icon-32"></i></div>
                                <h4>For Emergency</h4>
                                <h3><a href="tel:123045615523">+1 (230)-456-155-23</a></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}
        <!-- cta-section end -->
@endsection

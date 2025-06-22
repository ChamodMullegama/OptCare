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
                    <p>No. 120, Galle Road, Colombo 03 <br />Sri Lanka</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 info-column">
                <div class="single-item">
                    <div class="icon-box"><i class="fas fa-envelope"></i></div>
                    <h3>Company Email</h3>
                    <p><a href="mailto:example@gmail.com">optcare@gmail.com</a><br /><a href="mailto:example@gmail.com">optcareinfo@gmail.com</a></p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 info-column">
                <div class="single-item">
                    <div class="icon-box"><i class="fas fa-phone-alt"></i></div>
                    <h3>Contact Us</h3>
                    <p><a href="tel:0112346782">(+94) 11 234 6782</a><br /><a href="tel:0702740542">(+94) 702 74 0542</a></p>
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
                            <h2>Leave a Massage</h2>
                             <form action="{{ route('PublicAreaCustomerMessage.add') }}" method="post">
                              @csrf
@if (session('success'))
    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
        <div class="alert alert-success text-center">
          <i class="fas fa-check-circle"></i> {{ session('success') }}
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
     <!-- google-map-section -->
<section class="google-map-section p_relative">
    <div class="map-inner p_relative d_block">
        <div class="google-map" id="contact-google-map">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6661.172472060013!2d79.84555886148223!3d6.919645334563549!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2591514038547%3A0xa12560c4d858fc3f!2sNawaloka%20Hospitals%20PLC!5e0!3m2!1sen!2slk!4v1750627676214!5m2!1sen!2slk"
                width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>


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
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                              <i class="fas fa-check-circle"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form action="{{ route('publicAreaSubscription.add') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="email" name="email" placeholder="Your email address" value="{{ old('email') }}" required>
                            <button type="submit" class="theme-btn">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@push('css')

@endpush


        <!-- subscribe-section end -->
@endsection

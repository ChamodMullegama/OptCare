@extends('PublicArea.Layout.main')
@section('Publiccontainer')

<!-- Page Title -->
<section class="page-title">
    <div class="bg-layer" style="background-image: url({{ asset('PublicArea/images/background/page-title.jpg') }});"></div>
    <div class="auto-container">
        <div class="content-box">
            <h1>Doctor Profile</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('PublicAreDoctors.all') }}">Doctors</a></li>
                <li>Dr. {{ $doctor->first_name }} {{ $doctor->last_name }}</li>
            </ul>
        </div>
    </div>
</section>
<!-- End Page Title -->

<!-- team-details -->
<section class="team-details p_relative">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-5 col-md-12 col-sm-12 image-column">
                <figure class="image-box">
                    @if($doctor->profile_image)
                        <img src="{{ asset('storage/' . $doctor->profile_image) }}"
                             alt="Dr. {{ $doctor->first_name }} {{ $doctor->last_name }}"
                             style="width: 100%; height: 600px; object-fit: cover;">
                    @else
                        <img src="{{ asset('assets/images/team/doctor-placeholder.jpg') }}"
                             alt="No Image"
                             style="width: 100%; height: 600px; object-fit: cover;">
                    @endif
                </figure>
            </div>
            <div class="col-lg-7 col-md-12 col-sm-12 content-column">
                <div class="team-details-content">
                    <div class="team-info">
                        <h2>Dr. {{ $doctor->first_name }} {{ $doctor->last_name }}</h2>
                        <span class="designation">{{ $doctor->designation ?? 'Medical Specialist' }}</span>

                         <p>{!! Str::limit($doctor->bio, 5000) !!}</p>

                        <ul class="list clearfix">
                            <li><span>Specialization:</span>{{ $doctor->designation ?? 'General Medicine' }}</li>
                            <li><span>Qualification:</span>{{ $doctor->qualification ?? 'MBBS, MD' }}</li>
                            <li><span>Experience:</span>{{ $doctor->blood_group }} Year</li>
                            <li><span>Gender:</span>{{ ucfirst($doctor->gender) }}</li>
                            <li><span>Location:</span>{{ $doctor->city ?? 'City' }}, {{ $doctor->country ?? 'Country' }}</li>
                            <li><span>Phone:</span><a href="tel:{{ $doctor->mobile_number }}">{{ $doctor->mobile_number }}</a></li>
                            <li><span>Email:</span><a href="mailto:{{ $doctor->email }}">{{ $doctor->email }}</a></li>
                        </ul>

                        <ul class="social-link clearfix">
                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                        </ul>
                    </div>

                    <div class="skills-box">
                        <div class="text">
                            <h3>Professional Skills</h3>
                            <p>Specialized in various medical procedures with excellent patient satisfaction rates.</p>
                        </div>
                        <div class="progress-box">
                            <div class="progress-box p_relative d_block mb_25">
                                <h5>Patient Satisfaction</h5>
                                <div class="bar">
                                    <div class="bar-inner count-bar" data-percent="{{ $doctor->patients_percentage ?? '95%' }}"></div>
                                    <div class="count-text">{{ $doctor->patients_percentage ?? '95%' }}</div>
                                </div>
                            </div>
                            <div class="progress-box p_relative d_block mb_25">
                                <h5>Successful Procedures</h5>
                                <div class="bar">
                                    <div class="bar-inner count-bar" data-percent="{{ $doctor->surgeries_percentage ?? '90%' }}"></div>
                                    <div class="count-text">{{ $doctor->surgeries_percentage ?? '90%' }}</div>
                                </div>
                            </div>
                            <div class="progress-box p_relative d_block">
                                <h5>Positive Reviews</h5>
                                <div class="bar">
                                    <div class="bar-inner count-bar" data-percent="{{ $doctor->reviews_percentage ?? '85%' }}"></div>
                                    <div class="count-text">{{ $doctor->reviews_percentage ?? '85%' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>





                  <div class="contact-box">
    <div class="text">
        <h3>Put Review</h3>
    </div>
    <div class="form-inner">
        <form action="{{ route('review.doctorReviewAdd') }}" method="post">
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
                @if (session('success'))
    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    </div>
@endif
            @endif
            @csrf
            <input type="hidden" name="doctorId" value="{{ $doctor->doctorId }}">

            <div class="row clearfix">
                <div class="col-lg-6 col-md-6 col-sm-12 column">
                    <div class="form-group">
                        <input type="text" name="name" placeholder="Your name" required>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 column">
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Your Email" required>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 column">
                    <div class="form-group">
                        <textarea name="message" placeholder="Your Message" required></textarea>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 column">
                    <div class="form-group message-btn">
                        <button type="submit" class="theme-btn btn-one">Submit Review</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


                </div>
            </div>
        </div>
    </div>
</section>
<section class="testimonial-section p_relative centred">
    <div class="pattern-layer" style="background-image: url(assets/images/shape/shape-6.png);"></div>
    <div class="auto-container">
        <div class="sec-title mb_60">
            <span class="sub-title">Testimonials</span>
            <h2>What Our Clients Say <br />About Dr. {{ $doctor->first_name }} {{ $doctor->last_name }}</h2>
        </div>

        @if($doctor_reviews->count() > 0)
        <div class="two-item-carousel owl-carousel owl-theme owl-nav-none dots-style-one">
            @foreach($doctor_reviews as $review)
            <div class="testimonial-block-one">
                <div class="inner-box p_relative d_block">
                    <div class="icon-box"><i class="fas fa-quote-left"></i></div>
                    <p>{{ Str::limit($review->message, 150) }}</p>
                    <h4>{{ $review->name }}</h4>
                    <span class="designation">{{ $review->created_at->format('M d, Y') }}</span>
                </div>
            </div>
            @endforeach
        </div>
        @else
  
        @endif
    </div>
</section>
<!-- team-details end -->

@endsection

@push('scripts')
<script>
    $(document).ready(function(){
        // Progress bar animation
        $('.count-bar').each(function(){
            $(this).animate({
                width: $(this).attr('data-percent')
            }, 2000);
        });
    });
</script>
@endpush

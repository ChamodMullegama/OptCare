@extends('PublicArea.Layout.main')

@section('Publiccontainer')
    <!-- Page Title -->
    <section class="page-title">
        <div class="bg-layer" style="background-image: url({{ asset('PublicArea/images/background/page-title.jpg') }});"></div>
        <div class="auto-container">
            <div class="content-box">
                <h1>Doctor Appointment</h1>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('PublicAreaAppointment.appointment') }}">Doctor Appointment</a></li>
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
                                <li><span>Experience:</span>{{ $doctor->blood_group ?? 'N/A' }} Year</li>
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

                        <div class="contact-box">
                            <div class="text">
                                <h3>Book Appointment</h3>
                            </div>
                            <div class="form-inner">
                                <form action="{{ route('PublicAreaAppointment.book') }}" method="post">
                                    @csrf
                                    @if (session('success'))
                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                            <div class="alert alert-success text-center">
                                                {{ session('success') }}
                                            </div>
                                        </div>
                                    @endif
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
                                    <input type="hidden" name="doctorId" value="{{ $doctor->doctorId }}">
                                    <div class="row clearfix">
                                        <div class="col-lg-6 col-md-6 col-sm-12 column">
                                            <div class="form-group">
                                                <input type="text" name="name" placeholder="Your name" value="{{ old('name') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 column">
                                            <div class="form-group">
                                                <input type="email" name="email" placeholder="Your Email" value="{{ old('email') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 column">
                                            <div class="form-group">
                                                <input type="text" name="phone" placeholder="Your phone number" value="{{ old('phone') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 column">
                                            <div class="form-group">
                                                <input type="date" name="date" class="form-control"
                                                       min="{{ date('Y-m-d') }}" value="{{ old('date') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                            <div class="select-box">
                                                <select name="time" class="wide" required>
                                                    <option value="">Select time</option>
                                                    @for($hour = 8; $hour <= 18; $hour++)
                                                        <option value="{{ sprintf('%02d:00', $hour) }}" {{ old('time') == sprintf('%02d:00', $hour) ? 'selected' : '' }}>
                                                            {{ sprintf('%02d:00', $hour) }}
                                                        </option>
                                                        @if($hour < 18)
                                                            <option value="{{ sprintf('%02d:30', $hour) }}" {{ old('time') == sprintf('%02d:30', $hour) ? 'selected' : '' }}>
                                                                {{ sprintf('%02d:30', $hour) }}
                                                            </option>
                                                        @endif
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 column">
                                            <div class="form-group">
                                                <textarea name="message" placeholder="Your Message">{{ old('message') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 column">
                                            <div class="form-group message-btn">
                                                <button type="submit" class="theme-btn btn-one">Book Appointment</button>
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
    <!-- team-details end -->
@endsection

@push('css')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endpush

@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script>
        $(function() {
            $("#datepicker").datepicker({
                dateFormat: "yy-mm-dd",
                minDate: 0
            });
        });
    </script>
    <script>
        $(document).ready(function(){
            $('.count-bar').each(function(){
                $(this).animate({
                    width: $(this).attr('data-percent')
                }, 2000);
            });
        });
    </script>
@endpush

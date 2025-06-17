@extends('PublicArea.Layout.main')

@section('Publiccontainer')
    <!-- Page Title -->
    <section class="page-title">
        <div class="bg-layer" style="background-image: url({{ asset('PublicArea/images/background/page-title.jpg') }});"></div>
        <div class="auto-container">
            <div class="content-box">
                <h1>Doctors Appointment</h1>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Doctors Appointment</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- End Page Title -->

    <!-- team-section -->
    <section class="team-page-section p_relative">
        <div class="auto-container">
            <!-- Search Box -->
            <div class="row mb-4">
                <div class="col-md-12 mx-auto">
                    @if (session('success'))
                        <div class="alert alert-success text-center">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('PublicAreaAppointment.appointmentsearch') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" name="doctor_name" class="form-control"
                                           placeholder="Doctor name" value="{{ old('doctor_name') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="date" name="date" class="form-control"
                                           min="{{ date('Y-m-d') }}" value="{{ old('date') }}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select name="time" class="form-control" required>
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
                            <div class="col-md-3">
                                <button type="submit" class="theme-btn btn-one w-100">
                                    <i class="fas fa-search"></i> Search
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <!-- consultancy-section -->
        <section class="consultancy-section">
            <div class="auto-container">
                <div class="inner-container">
                    <h2>Quick Online Consultancy Only <br />on Few Minutes</h2>
                    <form action="contact.html" method="post">
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                <div class="form-group">
                                    <input type="text" name="name" placeholder="Your name" required="">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                <div class="form-group">
                                    <input type="email" name="email" placeholder="Email" required="">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                <div class="form-group">
                                    <div class="icon"><i class="fas fa-angle-down"></i></div>
                                    <input type="text" name="date" placeholder="Appointment date" id="datepicker">
                                </div>
                            </div>
                        </div>
                        <div class="message-btn">
                            <button type="submit" class="theme-btn btn-one">Contact Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!-- consultancy-section end -->

            <div class="row clearfix">
                @forelse($doctors as $doctor)
                    <div class="col-lg-4 col-md-6 col-sm-12 team-block">
                        <div class="team-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
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
                                        <a href="{{ route('PublicAreaAppointment.details', $doctor->id) }}" class="d_iblock color_black">
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
                        <a href="{{ route('PublicAreaAppointment.appointment') }}" class="theme-btn btn-one"
                           style="padding: 10px 30px; font-size: 14px; background-color: #03c0b4; border-color: #03c0b4; color: #fff; transition: all 0.3s ease; border-radius: 40px;"
                           onmouseover="this.style.backgroundColor='black'; this.style.borderColor='black';"
                           onmouseout="this.style.backgroundColor='#1abc9c'; this.style.borderColor='#1abc9c';">View All Doctors</a>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
    <!-- team-section end -->
@endsection

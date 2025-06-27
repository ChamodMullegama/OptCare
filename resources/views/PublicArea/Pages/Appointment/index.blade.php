@extends('PublicArea.Layout.main')

@section('Publiccontainer')
    <!-- Page Title -->
    <section class="page-title">
        <div class="bg-layer" style="background-image: url({{ asset('PublicArea/images/background/page-title.jpg') }});"></div>
        <div class="auto-container">
            <div class="content-box">
                <h1>Appointment</h1>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Appointment</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- End Page Title -->

    <!-- team-section -->
    <section class="team-page-section p_relative">
        <div class="auto-container">
            <!-- Search Box -->
            <div class="row mb-5">
                <div class="col-12">
                    <div class="search-box-wrapper p-4" style="background: linear-gradient(135deg, #1abc9c 0%, #16a085 100%); border-radius: 15px; box-shadow: 0 10px 30px rgba(26, 188, 156, 0.3);">
                        <div class="text-center mb-4">
                            <h3 style="color: white; margin-bottom: 10px;">
                                <i class="fas fa-search"></i> Find Your Doctor
                            </h3>
                            <p style="color: rgba(255,255,255,0.9); margin-bottom: 0;">Search for available doctors by name, date and time</p>
                        </div>

                        @if (session('success'))
                            <div class="alert alert-success text-center mb-3">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger mb-3">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('PublicAreaAppointment.appointmentsearch') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-lg-3 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label text-white mb-2">
                                            <i class="fas fa-user-md"></i> Doctor Name
                                        </label>
                                        <input type="text" name="doctor_name" class="form-control form-control-lg"
                                               placeholder="Enter doctor name"
                                               style="border-radius: 10px; border: none; box-shadow: 0 2px 10px rgba(0,0,0,0.1);"
                                               value="{{ old('doctor_name', isset($searchParams) ? $searchParams['doctor_name'] : '') }}">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label text-white mb-2">
                                            <i class="fas fa-calendar-alt"></i> Appointment Date
                                        </label>
                                        <input type="date" name="date" class="form-control form-control-lg"
                                               min="{{ date('Y-m-d') }}"
                                               style="border-radius: 10px; border: none; box-shadow: 0 2px 10px rgba(0,0,0,0.1);"
                                               value="{{ old('date', isset($searchParams) ? $searchParams['date'] : '') }}" required>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label text-white mb-2">
                                            <i class="fas fa-clock"></i> Preferred Time
                                        </label>
                                        <select name="time" class="form-control form-control-lg"
                                                style="border-radius: 10px; border: none; box-shadow: 0 2px 10px rgba(0,0,0,0.1);" required>
                                            <option value="">Select time</option>
                                            @for($hour = 8; $hour <= 18; $hour++)
                                                @php
                                                    $timeValue = sprintf('%02d:00', $hour);
                                                    $selectedTime = old('time', isset($searchParams) ? $searchParams['time'] : '');
                                                    $displayTime = date('g:i A', strtotime($timeValue));
                                                @endphp
                                                <option value="{{ $timeValue }}" {{ $selectedTime == $timeValue ? 'selected' : '' }}>
                                                    {{ $displayTime }}
                                                </option>
                                                @if($hour < 18)
                                                    @php
                                                        $timeValueHalf = sprintf('%02d:30', $hour);
                                                        $displayTimeHalf = date('g:i A', strtotime($timeValueHalf));
                                                    @endphp
                                                    <option value="{{ $timeValueHalf }}" {{ $selectedTime == $timeValueHalf ? 'selected' : '' }}>
                                                        {{ $displayTimeHalf }}
                                                    </option>
                                                @endif
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label text-white mb-2" style="opacity: 0;">Actions</label>
                                        <div class="d-flex gap-2">
                                            <button type="submit" class="btn btn-light btn-lg flex-fill"
                                                    style="border-radius: 10px; font-weight: 600; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                                                <i class="fas fa-search"></i> Search
                                            </button>
                                        <a href="{{ route('PublicAreaAppointment.appointment') }}"
                                            class="btn btn-outline-light btn-lg"
                                            style="border-radius: 10px; font-weight: 600; border: 2px solid white; margin-left: 7px;">
                                                <i class="fas fa-times"></i>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Search Results Info -->
            @if(isset($searchParams) && ($searchParams['doctor_name'] || $searchParams['date'] || $searchParams['time']))
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="search-results-info p-4" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 12px; border-left: 4px solid #1abc9c; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                            <div class="d-flex align-items-center mb-3">
                                <div class="result-icon me-3">
                                    <i class="fas fa-search" style="color: #1abc9c; font-size: 24px;"></i>
                                </div>
                                <div>
                                    <h5 style="color: #2c3e50; margin-bottom: 5px;">Search Results</h5>
                                    <span class="badge" style="background-color: #1abc9c; font-size: 12px;">{{ count($doctors) }} {{ count($doctors) == 1 ? 'doctor' : 'doctors' }} found</span>
                                </div>
                            </div>

                            <div class="search-criteria">
                                <p class="mb-2" style="color: #6c757d; font-size: 14px;">
                                    <strong>Search filters applied:</strong>
                                </p>
                                <div class="d-flex flex-wrap gap-2">
                                    @if($searchParams['doctor_name'])
                                        <span class="badge bg-primary">
                                            <i class="fas fa-user-md me-1"></i>{{ $searchParams['doctor_name'] }}
                                        </span>
                                    @endif
                                    @if($searchParams['date'])
                                        <span class="badge bg-info">
                                            <i class="fas fa-calendar me-1"></i>{{ \Carbon\Carbon::parse($searchParams['date'])->format('M d, Y') }}
                                        </span>
                                    @endif
                                    @if($searchParams['time'])
                                        <span class="badge bg-warning text-dark">
                                            <i class="fas fa-clock me-1"></i>{{ \Carbon\Carbon::parse($searchParams['time'])->format('g:i A') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

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

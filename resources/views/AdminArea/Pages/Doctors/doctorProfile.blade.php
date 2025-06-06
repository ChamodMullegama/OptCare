<!-- resources/views/AdminArea/Pages/Doctors/profile.blade.php -->
@extends('AdminArea.Layout.main')
@section('Admincontainer')

<div class="app-hero-header d-flex align-items-center">
    <!-- Breadcrumb starts -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <i class="ri-home-8-line lh-1 pe-3 me-3 border-end"></i>
            <a href="index.html">Home</a>
        </li>
        <li class="breadcrumb-item text-primary" aria-current="page">
            Doctor Profile
        </li>
    </ol>
    <!-- Breadcrumb ends -->
</div>

<div class="app-body">

    <!-- Row starts -->
    <div class="row gx-3">
        <div class="col-xxl-6 col-sm-12">
            <div class="card mb-3 bg-1">
                <div class="card-body mh-230">

                    <!-- Row starts -->
                    <div class="row gx-3">
                        <div class="col-sm-3">
                            <img src="{{ $doctor->profile_image ? asset('storage/' . $doctor->profile_image) : asset('assets/images/user2.png') }}" class="img-fluid rounded-3" alt="Doctor Image">
                        </div>
                        <div class="col-sm-9">
                            <div class="text-white mt-3">
                                <h6>Hello I am,</h6>
                                <h3>{{ $doctor->first_name }} {{ $doctor->last_name }}</h3>
                                <h6>{{ $doctor->qualification ?? 'N/A' }} , {{ $doctor->designation ?? 'N/A' }}</h6>
                                <h6>{{ $doctor->blood_group }} Years Experience Overall</h6> <!-- Assuming 25 as starting age for simplicity -->
                          <div class="rating-stars d-flex">
    <i class="ri-star-fill text-warning"></i>
    <i class="ri-star-fill text-warning"></i>
    <i class="ri-star-fill text-warning"></i>
    <i class="ri-star-fill text-warning"></i>
    <i class="ri-star-line text-warning"></i> <!-- Empty star -->
</div>

                                <div class="mt-1">{{ $doctor->reviews_count ?? 0 }} Reviews</div>
                            </div>
                        </div>
                    </div>
                    <!-- Row ends -->

                </div>
            </div>
        </div>
        <div class="col-xxl-2 col-sm-4">
            <div class="card mb-3">
                <div class="card-body mh-230">

                    <!-- Card details start -->
                    <div>
                        <div class="d-flex flex-column align-items-center">
                            <div class="icon-box xl bg-primary-subtle rounded-5 mb-2 no-shadow">
                                <i class="ri-empathize-line fs-1 text-primary"></i>
                            </div>
                            <h1 class="text-primary">{{ $doctor->patients_count ?? 0 }}</h1>
                            <h6>Patients</h6>
                            <span class="badge bg-primary">{{ $doctor->patients_percentage ?? '0%' }} High</span>
                        </div>
                    </div>
                    <!-- Card details end -->

                </div>
            </div>
        </div>
        <div class="col-xxl-2 col-sm-4">
            <div class="card mb-3">
                <div class="card-body mh-230">

                    <!-- Card details start -->
                    <div>
                        <div class="d-flex flex-column align-items-center">
                            <div class="icon-box xl bg-danger-subtle rounded-5 mb-2 no-shadow">
                                <i class="ri-lungs-line fs-1 text-danger"></i>
                            </div>
                            <h1 class="text-danger">{{ $doctor->surgeries_count ?? 0 }}</h1>
                            <h6>Surgeries</h6>
                            <span class="badge bg-danger">{{ $doctor->surgeries_percentage ?? '0%' }} High</span>
                        </div>
                    </div>
                    <!-- Card details end -->

                </div>
            </div>
        </div>
        <div class="col-xxl-2 col-sm-4">
            <div class="card mb-3">
                <div class="card-body mh-230">

                    <!-- Card details start -->
                    <div>
                        <div class="d-flex flex-column align-items-center">
                            <div class="icon-box xl bg-success-subtle rounded-5 mb-2 no-shadow">
                                <i class="ri-star-line fs-1 text-success"></i>
                            </div>
                            <h1 class="text-success">{{ $doctor->reviews_count ?? 0 }}</h1>
                            <h6>Reviews</h6>
                            <span class="badge bg-success">{{ $doctor->reviews_percentage ?? '0%' }} High</span>
                        </div>
                    </div>
                    <!-- Card details end -->

                </div>
            </div>
        </div>
    </div>
    <!-- Row ends -->

    <!-- Row starts -->
    <div class="row gx-3">
        <div class="col-xl-8 col-sm-12">

            <!-- Row starts -->
            <div class="row gx-3">
                <div class="col-sm-12">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="card-title">About</h5>
                        </div>
                        <div class="card-body">
                            <p>{!! Str::limit($doctor->bio, 5000) !!}</p>
                            <div class="">
                                <h6>Specialized in</h6>
                                <div class="d-flex flex-wrap gap-2">
                                    @if ($doctor->designation)
                                        @foreach (explode(', ', $doctor->designation) as $specialty)
                                            <span class="badge bg-primary">{{ $specialty }}</span>
                                        @endforeach
                                    @else
                                        <span class="badge bg-primary">N/A</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row ends -->
      <div class="col-sm-12">
                    <div class="card mb-3">
                      <div class="card-header">
                        <h5 class="card-title">Reviews</h5>
                      </div>
                      <div class="card-body">

                        <!-- Reviews starts -->
                        <div class="d-grid gap-5">
                          <div class="d-flex">
                            <img src="assets/images/patient1.png" class="img-4x rounded-2" alt="Medical Admin Template">
                            <div class="ms-3">
                              <span class="badge border border-primary text-primary mb-3">Excellent</span>
                              <h6>Wendi Combs</h6>
                              <p class="mb-2">I am consulting with her for last 10 years and she is really good in
                                thyroid. Her experience has greatest strength. By looking at the report she will
                                diagnosis the problem and listen to us. We might think she is in a hurry to complete the
                                patient but her experience makes her 100%.</p>
                              <p><i class="ri-thumb-up-line"></i> I recommend the doctor.</p>
                              <div class="rating-stars">
                                <div class="readonly5"></div>
                              </div>
                            </div>
                          </div>
                          <div class="d-flex">
                            <img src="assets/images/patient2.png" class="img-4x rounded-2" alt="Medical Admin Template">
                            <div class="ms-3">
                              <span class="badge border border-primary text-primary mb-3">Excellent</span>
                              <h6>Nick Morrow</h6>
                              <p class="mb-2">Dr.Jessika is my physician from past four years. Till now, whatever
                                treatment and advice she has given me is of the best kind. I am extremely satisfied with
                                it. There may be about 10 minutes of waiting period before consultation. The hospital
                                and staff are good as well.</p>
                              <p><i class="ri-thumb-up-line"></i> I recommend the doctor.</p>
                              <div class="rating-stars">
                                <div class="readonly5"></div>
                              </div>
                            </div>
                          </div>
                          <div class="d-flex">
                            <img src="assets/images/patient3.png" class="img-4x rounded-2" alt="Medical Admin Template">
                            <div class="ms-3">
                              <span class="badge border border-danger text-danger mb-3">Bad</span>
                              <h6>Carole Dodson</h6>
                              <p class="mb-2">Its a not recommerded example. Its a not recommerded example. Its a not
                                recommerded example. Its a not recommerded example.
                              </p>
                              <p><i class="ri-thumb-down-line"></i> I do not recommend the doctor.</p>
                              <div class="rating-stars">
                                <div class="readonly2"></div>
                              </div>
                            </div>
                          </div>
                          <div class="d-grid">
                            <button class="btn btn-primary">Load More</button>
                          </div>
                        </div>
                        <!-- Reviews ends -->

                      </div>
                    </div>
                  </div>
        </div>

        <div class="col-xl-4 col-sm-12">

            <!-- Row starts -->
            <div class="row gx-3">
                <div class="col-xl-12 col-sm-6">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="card-title">Availability</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-wrap gap-1 mb-3">
                                @php
                                    $availability = $doctor->availability ?? [];
                                @endphp
                                @foreach (['sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat'] as $day)
                                    <span class="p-2 lh-1 bg-light rounded-2 box-shadow">
                                        {{ strtoupper(substr($day, 0, 1)) . substr($day, 1) }} -
                                        {{ $availability[$day]['from'] ?? 'NA' }} - {{ $availability[$day]['to'] ?? 'NA' }}
                                    </span>
                                @endforeach
                            </div>
                            <a href="#" class="btn btn-primary disabled">
                                Book Appointment
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row ends -->

        </div>
    </div>
    <!-- Row ends -->

</div>

@endsection

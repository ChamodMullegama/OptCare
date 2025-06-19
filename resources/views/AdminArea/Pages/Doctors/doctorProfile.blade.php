@extends('AdminArea.Layout.main')
@section('Admincontainer')

<div class="app-hero-header d-flex align-items-center">
    <!-- Breadcrumb starts -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <i class="ri-home-8-line lh-1 pe-3 me-3 border-end"></i>
            <a href="{{ route('admin.dashboard') }}">Home</a>
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
                                <h6>{{ $doctor->blood_group }} Years Experience Overall</h6> <!-- Assuming 25 as starting age -->
                                <div class="rating-stars d-flex">
                                    <i class="ri-star-fill text-warning"></i>
                                    <i class="ri-star-fill text-warning"></i>
                                    <i class="ri-star-fill text-warning"></i>
                                    <i class="ri-star-fill text-warning"></i>
                                    <i class="ri-star-line text-warning"></i>
                                </div>
                                <div class="mt-1">{{ $totalReviews }} Reviews</div>
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
                            <h1 class="text-primary">{{ $totalAppointments }}</h1>
                            <h6>Total Appointments</h6>
                            <span class="badge bg-primary">{{ $doctor->patients_percentage }}</span>
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
                            <h1 class="text-danger">{{ $completedAppointments }}</h1>
                            <h6>Done Appointments</h6>
                            <span class="badge bg-danger">{{ $doctor->surgeries_percentage }}</span>
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
                            <h1 class="text-success">{{ $dueAppointments }}</h1>
                            <h6>Due Appointments</h6>
                            <span class="badge bg-success">{{ $doctor->reviews_percentage }}</span>
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
                            <p>{!! $doctor->bio ?? 'No bio available' !!}</p>
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
                            <div class="mt-3">
                                <h6>Contact Information</h6>
                                <p><strong>Email:</strong> {{ $doctor->email ?? 'N/A' }}</p>
                                <p><strong>Mobile:</strong> {{ $doctor->mobile_number ?? 'N/A' }}</p>
                                <p><strong>Address:</strong> {{ $doctor->address ?? 'N/A' }}, {{ $doctor->city ?? '' }}, {{ $doctor->state ?? '' }}, {{ $doctor->country ?? '' }}, {{ $doctor->postal_code ?? '' }}</p>
                            </div>
                            <div class="mt-3">
                                <h6>Personal Details</h6>
                                <p><strong>Age:</strong> {{ $doctor->age ?? 'N/A' }}</p>
                                <p><strong>Gender:</strong> {{ ucfirst($doctor->gender ?? 'N/A') }}</p>
                                <p><strong>Marital Status:</strong> {{ ucfirst($doctor->marital_status ?? 'N/A') }}</p>
                                <p><strong>Experience:</strong> {{ $doctor->blood_group ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                 <!-- Row starts -->
            <div class="row gx-3">
                <div class="col-sm-12">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="card-title">Today's Appointments ({{ now()->format('F j, Y') }})</h5>
                        </div>
                        <div class="card-body">
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
                            <div class="table-responsive">
                                <table class="table truncate m-0 border align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Patient Name</th>
                                            <th>Data</th>
                                            <th>Time</th>
                                            <th>Status</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($todayAppointments as $appointment)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $appointment->name }}</td>
                                                           <td>{{ $appointment->date }}</td>
                                                <td>{{ $appointment->time ?? 'N/A' }}</td>
                                                <td>
                                                    <span class="badge bg-{{ $appointment->status === 'accepted' ? 'success' : ($appointment->status === 'rejected' || $appointment->status === 'canceled' ? 'danger' : ($appointment->status === 'completed' ? 'info' : 'warning')) }}">
                                                        {{ ucfirst($appointment->status) }}
                                                    </span>
                                                </td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">No appointments scheduled for today</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="card-title">Due Appointments</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table truncate m-0 border align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Patient Name</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Status</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($dueAppointmentsList as $appointment)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $appointment->name }}</td>
                                                <td>{{ $appointment->date }}</td>
                                                <td>{{ $appointment->time ?? 'N/A' }}</td>
                                                <td>
                                                    <span class="badge bg-{{ $appointment->status === 'accepted' ? 'success' : 'warning' }}">
                                                        {{ ucfirst($appointment->status) }}
                                                    </span>
                                                </td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">No due appointments found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row ends -->

            <!-- Row starts -->
            <div class="row gx-3">
                <div class="col-xxl-6 col-sm-12">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="card-title">Latest Reviews</h5>
                        </div>
                        <div class="card-body">
                            <div class="scroll300">
                                <div class="d-grid gap-3">
                                    @forelse($latestReviews as $review)
                                        <div class="d-flex">

                                            <div class="ms-3">
                                                <h6>{{ $review->name }}</h6>
                                                <p class="mb-1">{{ Str::limit($review->message ?? 'No review text', 100) }}</p>
                                                <div class="rating-stars">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <i class="ri-star-{{ $i <= ($review->rating ?? 5) ? 'fill' : 'line' }} text-warning"></i>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-center">No reviews available.</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row ends -->
            </div>
            <!-- Row ends -->
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

@push('css')
<style>

</style>
@endpush

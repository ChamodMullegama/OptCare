@extends('DoctorArea.Layout.main')

@section('Doctorcontainer')
    <!-- App container starts -->
    <div class="app-container">
        <!-- App hero header starts -->
        <div class="app-hero-header d-flex align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <i class="ri-home-8-line lh-1 pe-3 me-3 border-end"></i>
                    <a href="{{ route('doctor.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item text-primary" aria-current="page">Doctor Dashboard</li>
            </ol>
            <div class="ms-auto d-lg-flex d-none flex-row">
                <div class="d-flex flex-row gap-1 day-sorting">
                    <button class="btn btn-sm btn-primary">Today</button>
                    <button class="btn btn-sm">7d</button>
                    <button class="btn btn-sm">2w</button>
                    <button class="btn btn-sm">1m</button>
                    <button class="btn btn-sm">3m</button>
                    <button class="btn btn-sm">6m</button>
                    <button class="btn btn-sm">1y</button>
                </div>
            </div>
        </div>
        <!-- App Hero header ends -->

        <!-- App body starts -->
        <div class="app-body">
            <!-- Row starts -->
            <div class="row">
                <div class="col-12 mt-4">
                    <!-- Row starts -->
                    <div class="row gx-3">
                        <div class="col-xxl-6 col-sm-12">
                            <div class="card mb-3 bg-1">
                                <div class="card-body mh-230">
                                    <div class="row gx-3">
                                        <div class="col-sm-3">
                                            <img src="{{ $doctor->profile_image ? asset('storage/' . $doctor->profile_image) : asset('assets/images/user2.png') }}"
                                                 class="img-fluid rounded-3" alt="Doctor Image">
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="text-white mt-3">
                                                <h6>Hello I am,</h6>
                                                <h3>{{ $doctor->first_name }} {{ $doctor->last_name }}</h3>
                                                <h6>{{ $doctor->qualification ?? 'N/A' }} , {{ $doctor->designation ?? 'N/A' }}</h6>
                                                <h6>{{ $doctor->blood_group }} Years Experience Overall</h6>
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
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-2 col-sm-4">
                            <div class="card mb-3">
                                <div class="card-body mh-230">
                                    <div class="d-flex flex-column align-items-center">
                                        <div class="icon-box xl bg-primary-subtle rounded-5 mb-2 no-shadow">
                                            <i class="ri-empathize-line fs-1 text-primary"></i>
                                        </div>
                                        <h1 class="text-primary">{{ $totalAppointments }}</h1>
                                        <h6>Total Appointments</h6>
                                        <span class="badge bg-primary">Updated Today</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-2 col-sm-4">
                            <div class="card mb-3">
                                <div class="card-body mh-230">
                                    <div class="d-flex flex-column align-items-center">
                                        <div class="icon-box xl bg-success-subtle rounded-5 mb-2 no-shadow">
                                            <i class="ri-checkbox-circle-line fs-1 text-success"></i>
                                        </div>
                                        <h1 class="text-success">{{ $completedAppointments }}</h1>
                                        <h6>Done Appointments</h6>
                                        <span class="badge bg-success">Updated Today</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-2 col-sm-4">
                            <div class="card mb-3">
                                <div class="card-body mh-230">
                                    <div class="d-flex flex-column align-items-center">
                                        <div class="icon-box xl bg-warning-subtle rounded-5 mb-2 no-shadow">
                                            <i class="ri-time-line fs-1 text-warning"></i>
                                        </div>
                                        <h1 class="text-warning">{{ $dueAppointments }}</h1>
                                        <h6>Due Appointments</h6>
                                        <span class="badge bg-warning">Updated Today</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Row ends -->
                </div>
            </div>
            <!-- Row ends -->

            <!-- Row starts -->
            <div class="row gx-3">
                <div class="col-xl-8 col-sm-12">
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
                                            <th>Time</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($todayAppointments as $appointment)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $appointment->name }}</td>
                                                <td>{{ $appointment->time ?? 'N/A' }}</td>
                                                <td>
                                                    <span class="badge bg-{{ $appointment->status === 'accepted' ? 'success' : ($appointment->status === 'rejected' || $appointment->status === 'canceled' ? 'danger' : ($appointment->status === 'completed' ? 'info' : 'warning')) }}">
                                                        {{ ucfirst($appointment->status) }}
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    @if ($appointment->status === 'pending')
                                                        <form action="{{ route('appointment.accept') }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $appointment->id }}">
                                                            <input type="hidden" name="redirect_to" value="{{ route('doctor.dashboard') }}">
                                                            <button type="submit" class="btn btn-outline-success btn-sm" title="Accept">
                                                                <i class="ri-check-line"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                    @if ($appointment->status === 'accepted')
                                                        <form action="{{ route('appointment.complete') }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $appointment->id }}">
                                                            <input type="hidden" name="redirect_to" value="{{ route('doctor.dashboard') }}">
                                                            <button type="submit" class="btn btn-outline-info btn-sm" title="Complete">
                                                                <i class="ri-checkbox-circle-line"></i>
                                                            </button>
                                                        </form>
                                                        <button class="btn btn-outline-primary btn-sm" onclick="showMeetingModal('{{ $appointment->id }}', '{{ $appointment->name }}', '{{ $appointment->email }}', '{{ $appointment->phone }}', '{{ $appointment->date }}', '{{ $appointment->time }}', '{{ $appointment->meeting_link ?? '' }}')">
                                                            <i class="ri-video-chat-line"></i>
                                                        </button>
                                                    @endif
                                                    @if ($appointment->status !== 'completed' && $appointment->status !== 'canceled')
                                                        <form action="{{ route('appointment.cancel') }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $appointment->id }}">
                                                            <input type="hidden" name="redirect_to" value="{{ route('doctor.dashboard') }}">
                                                            <button type="submit" class="btn btn-outline-warning btn-sm" title="Cancel">
                                                                <i class="ri-close-line"></i>
                                                            </button>
                                                        </form>
                                                        <button class="btn btn-outline-danger btn-sm" onclick="confirmDelete('{{ $appointment->id }}')">
                                                            <i class="ri-delete-bin-line"></i>
                                                        </button>
                                                    @endif
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
                                            <th>Actions</th>
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
                                                <td>
                                                    @if ($appointment->status === 'pending')
                                                        <form action="{{ route('appointment.accept') }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $appointment->id }}">
                                                            <input type="hidden" name="redirect_to" value="{{ route('doctor.dashboard') }}">
                                                            <button type="submit" class="btn btn-outline-success btn-sm" title="Accept">
                                                                <i class="ri-check-line"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                    @if ($appointment->status === 'accepted')
                                                        <form action="{{ route('appointment.complete') }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $appointment->id }}">
                                                            <input type="hidden" name="redirect_to" value="{{ route('doctor.dashboard') }}">
                                                            <button type="submit" class="btn btn-outline-info btn-sm" title="Complete">
                                                                <i class="ri-checkbox-circle-line"></i>
                                                            </button>
                                                        </form>
                                                        <button class="btn btn-outline-primary btn-sm" onclick="showMeetingModal('{{ $appointment->id }}', '{{ $appointment->name }}', '{{ $appointment->email }}', '{{ $appointment->phone }}', '{{ $appointment->date }}', '{{ $appointment->time }}', '{{ $appointment->meeting_link ?? '' }}')">
                                                            <i class="ri-video-chat-line"></i>
                                                        </button>
                                                    @endif
                                                    @if ($appointment->status !== 'completed' && $appointment->status !== 'canceled')
                                                        <form action="{{ route('appointment.cancel') }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $appointment->id }}">
                                                            <input type="hidden" name="redirect_to" value="{{ route('doctor.dashboard') }}">
                                                            <button type="submit" class="btn btn-outline-warning btn-sm" title="Cancel">
                                                                <i class="ri-close-line"></i>
                                                            </button>
                                                        </form>
                                                        <button class="btn btn-outline-danger btn-sm" onclick="confirmDelete('{{ $appointment->id }}')">
                                                            <i class="ri-delete-bin-line"></i>
                                                        </button>
                                                    @endif
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

            <!-- Row start: Graphs -->
            <div class="row gx-3">
                <div class="col-xl-6 col-lg-12">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="card-title">Appointment Status Distribution</h5>
                        </div>
                        <div class="card-body">
                            <div class="chart-height">
                                <div id="donut" class="auto-align-graph"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-12">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="card-title">Patient Gender Distribution</h5>
                        </div>
                        <div class="card-body">
                            <div class="chart-height">
                                <div id="pie" class="auto-align-graph"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-6 col-xl-12">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="card-title">Appointments Last 7 Days</h5>
                        </div>
                        <div class="card-body">
                            <div class="chart-height-xl">
                                <div id="barGraph" class="auto-align-graph"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-6 col-xl-12">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="card-title">Reviews Last 30 Days</h5>
                        </div>
                        <div class="card-body">
                            <div class="chart-height-xl">
                                <div id="lineGraph" class="auto-align-graph"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row end -->

            <!-- Delete Confirmation Modal -->
            <div class="modal fade" id="deleteAppointmentModal" tabindex="-1" aria-labelledby="deleteAppointmentModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="deleteAppointmentForm" action="{{ route('appointment.delete') }}" method="POST">
                            @csrf
                            <input type="hidden" id="appointmentId" name="id">
                            <input type="hidden" name="redirect_to" value="{{ route('doctor.dashboard') }}">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteAppointmentModalLabel">Confirm Deletion</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <div class="mb-2">
                                    <img src="{{ asset('AdminArea/images/bin.gif') }}" alt="Delete Confirmation" width="80">
                                </div>
                                <h5>Are you sure you want to delete this appointment?</h5>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Generate Meeting Modal -->
            <div class="modal fade" id="generateMeetingModal" tabindex="-1" aria-labelledby="generateMeetingModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="generateMeetingForm" action="{{ route('appointment.generate_meeting') }}" method="POST">
                            @csrf
                            <input type="hidden" id="meetingAppointmentId" name="id">
                            <div class="modal-header">
                                <h5 class="modal-title" id="generateMeetingModalLabel">Generate Meeting Link</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h6>Patient Details</h6>
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" id="meetingPatientName" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" id="meetingPatientEmail" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Phone</label>
                                    <input type="text" class="form-control" id="meetingPatientPhone" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Date</label>
                                    <input type="text" class="form-control" id="meetingPatientDate" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Time</label>
                                    <input type="text" class="form-control" id="meetingPatientTime" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Google Meet Link</label>
                                    <input type="url" class="form-control" id="meetingLink" name="meeting_link" placeholder="https://meet.google.com/xxx-xxxx-xxx" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Send to Email</button>
                                <button type="button" class="btn btn-info" onclick="sendSMS()">Send SMS</button>
                                <a id="joinMeetingButton" href="#" target="_blank" class="btn btn-success" style="display:none;">Join Meeting</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <!-- App body ends -->

        <!-- App footer starts -->

        <!-- App footer ends -->
    </div>
    <!-- App container ends -->
@endsection

@push('js')
<script>
    function confirmDelete(appointmentId) {
        document.getElementById('appointmentId').value = appointmentId;
        $('#deleteAppointmentModal').modal('show');
    }

    function showMeetingModal(id, name, email, phone, date, time, meetingLink) {
        document.getElementById('meetingAppointmentId').value = id;
        document.getElementById('meetingPatientName').value = name;
        document.getElementById('meetingPatientEmail').value = email;
        document.getElementById('meetingPatientPhone').value = phone;
        document.getElementById('meetingPatientDate').value = date;
        document.getElementById('meetingPatientTime').value = time;
        document.getElementById('meetingLink').value = meetingLink;

        const joinButton = document.getElementById('joinMeetingButton');
        if (meetingLink) {
            joinButton.href = meetingLink;
            joinButton.style.display = 'inline-block';
        } else {
            joinButton.style.display = 'none';
        }

        $('#generateMeetingModal').modal('show');
    }

    function sendSMS() {
        const appointmentId = document.getElementById('meetingAppointmentId').value;
        const meetingLink = document.getElementById('meetingLink').value;

        if (!meetingLink) {
            alert('Please enter a valid meeting link first.');
            return;
        }

        $.ajax({
            url: '{{ route('appointment.send_sms') }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id: appointmentId,
                meeting_link: meetingLink,
                redirect_to: '{{ route('doctor.dashboard') }}'
            },
            success: function(response) {
                if (response.success) {
                    alert('SMS sent successfully!');
                    window.location.reload();
                } else {
                    alert('Failed to send SMS: ' + response.message);
                }
            },
            error: function(xhr) {
                alert('An error occurred while sending SMS.');
            }
        });
    }

    // ApexCharts initialization
    // Donut Chart: Appointment Status Distribution
    var donutOptions = {
        series: [
            {{ $appointmentStatuses['pending'] ?? 0 }},
            {{ $appointmentStatuses['accepted'] ?? 0 }},
            {{ $appointmentStatuses['completed'] ?? 0 }},
            {{ $appointmentStatuses['canceled'] ?? 0 }}
        ],
        chart: {
            type: 'donut',
            height: 250
        },
        labels: ['Pending', 'Accepted', 'Completed', 'Canceled'],
        colors: ['#FFC107', '#28A745', '#17A2B8', '#DC3545'],
        dataLabels: {
            enabled: true
        },
        legend: {
            position: 'bottom'
        }
    };
    var donutChart = new ApexCharts(document.querySelector("#donut"), donutOptions);
    donutChart.render();

    // Pie Chart: Patient Gender Distribution
    var pieOptions = {
        series: [
            {{ $patientGenders['male'] ?? 0 }},
            {{ $patientGenders['female'] ?? 0 }},
            {{ $patientGenders['other'] ?? 0 }}
        ],
        chart: {
            type: 'pie',
            height: 250
        },
        labels: ['Male', 'Female', 'Other'],
        colors: ['#007BFF', '#FF69B4', '#6C757D'],
        dataLabels: {
            enabled: true
        },
        legend: {
            position: 'bottom'
        }
    };
    var pieChart = new ApexCharts(document.querySelector("#pie"), pieOptions);
    pieChart.render();

    // Bar Graph: Appointments Last 7 Days
    var barGraphOptions = {
        series: [{
            name: 'Appointments',
            data: {!! json_encode($barGraphCounts) !!}
        }],
        chart: {
            type: 'bar',
            height: 350
        },
        xaxis: {
            categories: {!! json_encode($barGraphDates) !!}
        },
        colors: ['#007BFF'],
        dataLabels: {
            enabled: false
        },
        title: {
            text: 'Daily Appointments',
            align: 'left'
        }
    };
    var barGraph = new ApexCharts(document.querySelector("#barGraph"), barGraphOptions);
    barGraph.render();

    // Line Graph: Reviews Last 30 Days
    var lineGraphOptions = {
        series: [{
            name: 'Reviews',
            data: {!! json_encode($lineGraphCounts) !!}
        }],
        chart: {
            type: 'line',
            height: 350
        },
        xaxis: {
            categories: {!! json_encode($lineGraphDates) !!},
            labels: {
                rotate: -45
            }
        },
        colors: ['#28A745'],
        dataLabels: {
            enabled: false
        },
        title: {
            text: 'Daily Reviews',
            align: 'left'
        },
        stroke: {
            curve: 'smooth'
        }
    };
    var lineGraph = new ApexCharts(document.querySelector("#lineGraph"), lineGraphOptions);
    lineGraph.render();
</script>
@endpush

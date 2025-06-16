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
                Appointments
            </li>
        </ol>
        <!-- Breadcrumb ends -->
    </div>

    <div class="app-body">
        <div class="row gx-3">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Custom tabs starts -->
                        <div class="custom-tabs-container">
                            <!-- Nav tabs starts -->
                            <ul class="nav nav-tabs" id="appointmentTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="pending-tab" data-bs-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="true">
                                        <i class="ri-time-line"></i> Pending
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="accepted-tab" data-bs-toggle="tab" href="#accepted" role="tab" aria-controls="accepted" aria-selected="false">
                                        <i class="ri-check-line"></i> Accepted
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="completed-tab" data-bs-toggle="tab" href="#completed" role="tab" aria-controls="completed" aria-selected="false">
                                        <i class="ri-check-double-line"></i> Completed
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="canceled-tab" data-bs-toggle="tab" href="#canceled" role="tab" aria-controls="canceled" aria-selected="false">
                                        <i class="ri-close-line"></i> Canceled
                                    </a>
                                </li>
                            </ul>
                            <!-- Nav tabs ends -->

                            <!-- Tab content starts -->
                            <div class="tab-content h-350">
                                <!-- Pending Appointments Tab -->
                                <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                                    <div class="row gx-3">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table id="basicExample" class="table table-hover">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Doctor Name</th>
                                                            <th>Patient Name</th>
                                                            <th>Email</th>
                                                            <th>Phone</th>
                                                            <th>Date</th>
                                                            <th>Time</th>
                                                            <th>Message</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($appointments->where('status', 'pending') as $appointment)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>
                                                                    @if($appointment->doctor)
                                                                        {{ $appointment->doctor->first_name }} {{ $appointment->doctor->last_name }}
                                                                    @else
                                                                        N/A
                                                                    @endif
                                                                </td>
                                                                <td>{{ $appointment->name }}</td>
                                                                <td>{{ $appointment->email }}</td>
                                                                <td>{{ $appointment->phone }}</td>
                                                                <td>{{ $appointment->date ?? 'N/A' }}</td>
                                                                <td>{{ $appointment->time ?? 'N/A' }}</td>
                                                                <td>{{ Str::limit($appointment->message, 30) }}</td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="8" class="text-center">No pending appointments found</td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Accepted Appointments Tab -->
                                <div class="tab-pane fade" id="accepted" role="tabpanel" aria-labelledby="accepted-tab">
                                    <div class="row gx-3">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table id="basicExample" class="table truncate m-0 align-middle">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Doctor Name</th>
                                                            <th>Patient Name</th>
                                                            <th>Email</th>
                                                            <th>Phone</th>
                                                            <th>Date</th>
                                                            <th>Time</th>
                                                            <th>Meeting Link</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($appointments->where('status', 'accepted') as $appointment)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>
                                                                    @if($appointment->doctor)
                                                                        {{ $appointment->doctor->first_name }} {{ $appointment->doctor->last_name }}
                                                                    @else
                                                                        N/A
                                                                    @endif
                                                                </td>
                                                                <td>{{ $appointment->name }}</td>
                                                                <td>{{ $appointment->email }}</td>
                                                                <td>{{ $appointment->phone }}</td>
                                                                <td>{{ $appointment->date ?? 'N/A' }}</td>
                                                                <td>{{ $appointment->time ?? 'N/A' }}</td>
                                                                <td>
                                                                    @if($appointment->meeting_link)
                                                                        <a href="{{ $appointment->meeting_link }}" target="_blank">Join Meeting</a>
                                                                    @else
                                                                        <span class="text-muted">Not generated</span>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="8" class="text-center">No accepted appointments found</td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Completed Appointments Tab -->
                                <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                                    <div class="row gx-3">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table id="basicExample" class="table truncate m-0 align-middle">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Doctor Name</th>
                                                            <th>Patient Name</th>
                                                            <th>Email</th>
                                                            <th>Phone</th>
                                                            <th>Date</th>
                                                            <th>Time</th>
                                                           
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($appointments->where('status', 'completed') as $appointment)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>
                                                                    @if($appointment->doctor)
                                                                        {{ $appointment->doctor->first_name }} {{ $appointment->doctor->last_name }}
                                                                    @else
                                                                        N/A
                                                                    @endif
                                                                </td>
                                                                <td>{{ $appointment->name }}</td>
                                                                <td>{{ $appointment->email }}</td>
                                                                <td>{{ $appointment->phone }}</td>
                                                                <td>{{ $appointment->date ?? 'N/A' }}</td>
                                                                <td>{{ $appointment->time ?? 'N/A' }}</td>
                                                                <td>
                                                                    <span class="badge bg-info">Completed</span>
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="8" class="text-center">No completed appointments found</td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Canceled Appointments Tab -->
                                <div class="tab-pane fade" id="canceled" role="tabpanel" aria-labelledby="canceled-tab">
                                    <div class="row gx-3">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table id="basicExample" class="table truncate m-0 align-middle">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Doctor Name</th>
                                                            <th>Patient Name</th>
                                                            <th>Email</th>
                                                            <th>Phone</th>
                                                            <th>Date</th>
                                                            <th>Time</th>
                                                            <th>Status</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($appointments->whereIn('status', ['canceled', 'rejected']) as $appointment)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>
                                                                    @if($appointment->doctor)
                                                                        {{ $appointment->doctor->first_name }} {{ $appointment->doctor->last_name }}
                                                                    @else
                                                                        N/A
                                                                    @endif
                                                                </td>
                                                                <td>{{ $appointment->name }}</td>
                                                                <td>{{ $appointment->email }}</td>
                                                                <td>{{ $appointment->phone }}</td>
                                                                <td>{{ $appointment->date ?? 'N/A' }}</td>
                                                                <td>{{ $appointment->time ?? 'N/A' }}</td>
                                                                <td>
                                                                    <span class="badge bg-danger">{{ ucfirst($appointment->status) }}</span>
                                                                </td>

                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="9" class="text-center">No canceled appointments found</td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Tab content ends -->
                        </div>
                        <!-- Custom tabs ends -->
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

@push('js')
<script>
    function confirmDelete(appointmentId) {
        document.getElementById('appointmentId').value = appointmentId;
        $('#deleteAppointmentModal').modal('show');
    }
</script>
@endpush

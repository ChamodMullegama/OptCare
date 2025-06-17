@extends('DoctorArea.Layout.main')

@section('Doctorcontainer')
<div class="app-hero-header d-flex align-items-center">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <i class="ri-home-8-line lh-1 pe-3 me-3 border-end"></i>
            <a href="{{ route('doctor.dashboard') }}">Home</a>
        </li>
        <li class="breadcrumb-item text-primary" aria-current="page">My Appointments</li>
    </ol>
</div>

<div class="app-body">
    <div class="row gx-3">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title">My Appointments</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basicExample" class="table truncate m-0 align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Patient Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Message</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($appointments as $appointment)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $appointment->name }}</td>
                                        <td>{{ $appointment->email }}</td>
                                        <td>{{ $appointment->phone }}</td>
                                        <td>{{ $appointment->date ?? 'N/A' }}</td>
                                        <td>{{ $appointment->time ?? 'N/A' }}</td>
                                        <td>{{ Str::limit($appointment->message, 50) }}</td>
                                        <td>
                                            <span class="badge bg-{{ $appointment->status === 'accepted' ? 'success' : ($appointment->status === 'rejected' ? 'danger' : ($appointment->status === 'completed' ? 'info' : ($appointment->status === 'canceled' ? 'danger' : 'warning'))) }}">
                                                {{ ucfirst($appointment->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            @if ($appointment->status === 'pending')
                                                <form action="{{ route('appointment.accept') }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $appointment->id }}">
                                                    <button type="submit" class="btn btn-outline-success btn-sm" title="Accept">
                                                        <i class="ri-check-line"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            @if ($appointment->status === 'accepted')
                                                <form action="{{ route('appointment.complete') }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $appointment->id }}">
                                                    <button type="submit" class="btn btn-outline-info btn-sm" title="Complete">
                                                        <i class="ri-checkbox-circle-line"></i>
                                                    </button>
                                                </form>
                                                <button class="btn btn-outline-primary btn-sm" onclick="showMeetingModal('{{ $appointment->id }}', '{{ $appointment->name }}', '{{ $appointment->email }}', '{{ $appointment->phone }}', '{{ $appointment->date }}', '{{ $appointment->time }}', '{{ $appointment->meeting_link ?? '' }}')">
                                                    <i class="ri-video-chat-line"></i> Generate Meeting
                                                </button>
                                            @endif
                                            @if ($appointment->status !== 'completed' && $appointment->status !== 'canceled')
                                                <form action="{{ route('appointment.cancel') }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $appointment->id }}">
                                                    <button type="submit" class="btn btn-outline-warning btn-sm" title="Cancel">
                                                        <i class="ri-close-line"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            @if ($appointment->status !== 'completed' && $appointment->status !== 'canceled')
                                                <button class="btn btn-outline-danger btn-sm" onclick="confirmDelete('{{ $appointment->id }}')">
                                                    <i class="ri-delete-bin-line"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">No appointments found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteAppointmentModal" tabindex="-1" aria-labelledby="deleteAppointmentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="deleteAppointmentForm" action="{{ route('appointment.delete') }}" method="POST">
                @csrf
                <input type="hidden" id="appointmentId" name="id">
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
                    <button type="button" class="btn btn-info" onclick="sendMeetingSms()">Send SMS</button>
                    <a id="joinMeetingButton" href="#" target="_blank" class="btn btn-success" style="display:none;">Join Meeting</a>
                </div>
            </form>
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

    function sendMeetingSms() {
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
                meeting_link: meetingLink
            },
            success: function(response) {
                if (response.success) {
                    alert('SMS sent successfully!');
                } else {
                    alert('Failed to send SMS: ' + response.message);
                }
            },
            error: function(xhr) {
                alert('An error occurred while sending SMS.');
            }
        });
    }
</script>
@endpush

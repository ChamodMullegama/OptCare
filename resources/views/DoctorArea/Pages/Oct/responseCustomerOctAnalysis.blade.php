@extends('DoctorArea.Layout.main')
@section('Doctorcontainer')

<div class="app-hero-header d-flex align-items-center">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <i class="ri-home-8-line lh-1 pe-3 me-3 border-end"></i>
            <a href="{{ route('doctor.dashboard') }}">Home</a>
        </li>
        <li class="breadcrumb-item text-primary" aria-current="page">
            Need Help Requests
        </li>
    </ol>
</div>

<div class="app-body">
    <div class="row gx-3">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title">Need Help Requests</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basicExample" class="table truncate m-0 align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>User Email</th>
                                    <th>Prediction</th>
                                    <th>Recommendation</th>
                                    <th>Image</th>
                                    <th>Created At</th>
                                    <th>Replied By</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($requests as $request)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $request->id }}</td>
                                    <td>{{ $request->customer_email ?? 'N/A' }}</td>
                                    <td>{{ $request->prediction }}</td>
                                    <td>{!! Str::limit($request->recommendation, 50) !!}</td>
                                    <td>
                                        @if ($request->image_path)
                                            <button class="btn btn-outline-info btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#imageModal"
                                                    onclick="showImage('{{ asset('storage/' . $request->image_path) }}')">
                                                <i class="ri-eye-line menu-icon"></i> View Oct Scan
                                            </button>
                                        @else
                                            <span>No Image</span>
                                        @endif
                                    </td>
                                    <td>{{ $request->created_at->format('Y-m-d H:i:s') }}</td>
                                    <td>{{ $request->replied_by_doctor_name ?? 'Not replied' }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <button class="btn btn-outline-danger btn-sm"
                                                    onclick="confirmDelete({{ $request->id }})">
                                                <i class="ri-delete-bin-line"></i>
                                            </button>
                                            <button class="btn btn-outline-primary btn-sm"
                                                    onclick="openReplyModal({{ $request->id }}, '{{ $request->customer_email }}', '{{ $request->prediction }}')">
                                                <i class="ri-mail-send-line"></i>
                                            </button>
                                            <button class="btn btn-outline-info btn-sm"
                                                    onclick="viewDetails(
                                                        {{ $request->id }},
                                                        '{{ $request->customer_email }}',
                                                        '{{ $request->prediction }}',
                                                        `{!! addslashes($request->recommendation) !!}`,
                                                        '{{ $request->image_path ? asset('storage/'.$request->image_path) : '' }}',
                                                        '{{ $request->created_at->format('Y-m-d H:i:s') }}',
                                                        `{{ $request->reply_message ?? 'No reply yet' }}`,
                                                        '{{ $request->replied_by_doctor_name ?? '' }}',
                                                        '{{ $request->replied_by_doctor_id ?? '' }}',
                                                        '{{ $request->replied_at ? $request->replied_at->format('Y-m-d H:i:s') : '' }}'
                                                    )">
                                                <i class="ri-eye-line"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center">No requests found</td>
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

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">OCT Scan Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" class="img-fluid">
            </div>
        </div>
    </div>
</div>

<!-- View Details Modal -->
<div class="modal fade" id="viewModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Request Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">ID</label>
                            <input type="text" class="form-control" id="viewId" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="text" class="form-control" id="viewEmail" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Prediction</label>
                            <input type="text" class="form-control" id="viewPrediction" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Created At</label>
                            <input type="text" class="form-control" id="viewCreatedAt" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Replied By</label>
                            <input type="text" class="form-control" id="viewDoctorName" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Replied At</label>
                            <input type="text" class="form-control" id="viewRepliedAt" readonly>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Recommendation</label>
                    <div class="border p-3 rounded bg-light" id="viewRecommendation"></div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Reply Message</label>
                    <textarea class="form-control" id="viewReplyMessage" rows="3" readonly></textarea>
                </div>
                <div class="text-center">
                    <img id="viewImage" src="" class="img-fluid rounded" style="max-height: 300px;">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Reply Modal -->
<div class="modal fade" id="replyModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('doctor.reply') }}" method="POST">
                @csrf
                <input type="hidden" name="id" id="replyId">
                <input type="hidden" name="doctor_id" value="{{ session('doctor.doctorId') }}">
                <input type="hidden" name="doctor_name" value="{{ session('doctor.name') }}">
                <div class="modal-header">
                    <h5 class="modal-title">Reply to Request</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="text" class="form-control" id="replyEmail" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Prediction</label>
                        <input type="text" class="form-control" id="replyPrediction" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Your Reply</label>
                        <textarea name="reply_message" class="form-control" rows="5" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Send Reply</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="deleteForm" action="{{ route('doctor.needHelp.delete') }}" method="POST">
                @csrf
                <input type="hidden" name="id" id="deleteId">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <div class="mb-2">
                        <img src="{{ asset('AdminArea/images/bin.gif') }}" alt="Delete Confirmation" width="80">
                    </div>
                    <h5>Are you sure you want to delete this request?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('js')
<script>
    // Show image in modal
    function showImage(src) {
        $('#modalImage').attr('src', src);
        $('#imageModal').modal('show');
    }

    // Confirm delete
    function confirmDelete(id) {
        $('#deleteId').val(id);
        $('#deleteModal').modal('show');
    }

    // Open reply modal
    function openReplyModal(id, email, prediction) {
        $('#replyId').val(id);
        $('#replyEmail').val(email);
        $('#replyPrediction').val(prediction);
        $('#replyModal').modal('show');
    }

    // View details
    function viewDetails(id, email, prediction, recommendation, image, createdAt, replyMessage, doctorName, doctorId, repliedAt) {
        $('#viewId').val(id);
        $('#viewEmail').val(email);
        $('#viewPrediction').val(prediction);
        $('#viewRecommendation').html(recommendation);
        $('#viewCreatedAt').val(createdAt);
        $('#viewReplyMessage').val(replyMessage || 'No reply yet');
        $('#viewImage').attr('src', image || '{{ asset('DoctorArea/images/no-image.png') }}');
        $('#viewDoctorName').val(doctorName || 'Not replied yet');
        $('#viewDoctorId').val(doctorId || 'N/A');
        $('#viewRepliedAt').val(repliedAt || 'N/A');
        $('#viewModal').modal('show');
    }
</script>
@endpush

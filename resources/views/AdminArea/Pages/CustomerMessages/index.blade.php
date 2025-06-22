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
            Patient Messages
        </li>
    </ol>
    <!-- Breadcrumb ends -->
</div>

<div class="app-body">
    <div class="row gx-3">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Patient Messages List</h5>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                      <table id="basicExample" class="table table-bordered align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>

                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Subject</th>
                                    <th>Message</th>
                                    <th>Received At</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customerMessage as $message)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        <td>{{ $message->name }}</td>
                                        <td>{{ $message->email }}</td>
                                        <td>{{ $message->phone ?? 'N/A' }}</td>
                                        <td>{{ $message->subject }}</td>
                                        <td>{{ Str::limit($message->message, 50) }}</td>
                                        <td>{{ $message->created_at->format('d M Y, h:i A') }}</td>
                                        <td>
                                            @if($message->replied_at)
                                                <span class="badge bg-success">Replied</span>
                                            @else
                                                <span class="badge bg-warning">Pending</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-inline-flex gap-1">
                                                <button class="btn btn-outline-primary btn-sm"
                                                        onclick="viewMessage('{{ $message->id }}', '{{ addslashes($message->subject) }}', '{{ addslashes($message->message) }}', '{{ addslashes($message->reply_message ?? '') }}')">
                                                    <i class="ri-eye-line"></i>
                                                </button>
                                                @if(!$message->replied_at)
                                                    <button class="btn btn-outline-success btn-sm"
                                                            onclick="openReplyModal('{{ $message->id }}', '{{ addslashes($message->name) }}', '{{ $message->email }}')">
                                                        <i class="ri-reply-line"></i>
                                                    </button>
                                                @endif
                                                <button class="btn btn-outline-danger btn-sm"
                                                        onclick="confirmDelete('{{ $message->id }}')">
                                                    <i class="ri-delete-bin-line"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- View Message Modal -->
<div class="modal fade" id="viewMessageModal" tabindex="-1" aria-labelledby="viewMessageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewMessageModalLabel">Message Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6>Subject: <span id="viewSubject"></span></h6>
                <p><strong>Message:</strong></p>
                <p id="viewMessage"></p>
                <p><strong>Reply:</strong></p>
                <p id="viewReply" class="text-muted"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Reply Message Modal -->
<div class="modal fade" id="replyMessageModal" tabindex="-1" aria-labelledby="replyMessageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="replyMessageForm" action="{{ route('customerMessage.reply') }}" method="POST">
                @csrf
                <input type="hidden" id="replyMessageId" name="id">
                <div class="modal-header">
                    <h5 class="modal-title" id="replyMessageModalLabel">Reply to Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>To: <span id="replyCustomerName"></span> (<span id="replyCustomerEmail"></span>)</strong></p>
                    <div class="mb-3">
                        <label for="reply_message" class="form-label">Reply Message</label>
                        <textarea class="form-control" id="reply_message" name="reply_message" rows="5" required></textarea>
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
<div class="modal fade" id="deleteMessageModal" tabindex="-1" aria-labelledby="deleteMessageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="deleteMessageForm" action="{{ route('customerMessage.delete') }}" method="POST">
                @csrf
                <input type="hidden" id="messageId" name="id">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteMessageModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <div class="mb-2">
                        <img src="{{ asset('AdminArea/images/bin.gif') }}" alt="Delete Confirmation" width="80">
                    </div>
                    <h5>Are you sure you want to delete this message?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('css')
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endpush

@push('js')
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>


    function confirmDelete(messageId) {
        document.getElementById('messageId').value = messageId;
        $('#deleteMessageModal').modal('show');
    }

    function viewMessage(id, subject, message, reply) {
        $('#viewSubject').text(subject);
        $('#viewMessage').text(message);
        $('#viewReply').text(reply || 'No reply sent yet.');
        $('#viewMessageModal').modal('show');
    }

    function openReplyModal(id, name, email) {
        $('#replyMessageId').val(id);
        $('#replyCustomerName').text(name);
        $('#replyCustomerEmail').text(email);
        $('#reply_message').val('');
        $('#replyMessageModal').modal('show');
    }
</script>
@endpush

@endsection

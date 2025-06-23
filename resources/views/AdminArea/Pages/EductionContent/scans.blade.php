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
            Eye Scans Management
        </li>
    </ol>
    <!-- Breadcrumb ends -->
</div>

<div class="app-body">
    <div class="row gx-3">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title">Eye Scans List</h5>
                    <button class="btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#addEyeScanModal">
                        Add New Eye Scan
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basicExample" class="table truncate m-0 align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Purpose</th>
                                    <th>Usage</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($eyeScans as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{!! Str::limit($item->description, 50) !!}</td>
                                    <td>{{ $item->purpose }}</td>
                                    <td>{{ $item->usage }}</td>
                                    <td>
                                        <button type="button" class="btn btn-outline-warning btn-sm"
                                            data-toggle="modal" data-target="#uploadImageModal"
                                            onclick="openUploadImageModal('{{ $item->eyeScanId }}')">
                                            <i class="ri-add-circle-line menu-icon"></i>
                                        </button>
                                        <a href="{{ route('EyeScans.viewEyeScanImageAll', $item->eyeScanId) }}"
                                            class="btn btn-outline-info btn-sm">
                                            <i class="ri-eye-line menu-icon"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <div class="d-inline-flex gap-1">
                                            <button class="btn btn-outline-danger btn-sm"
                                                onclick="confirmDelete('{{ $item->id }}')">
                                                <i class="ri-delete-bin-line"></i>
                                            </button>
                                            <button class="btn btn-outline-success btn-sm"
                                                onclick="editEyeScan('{{ $item->id }}', '{{ $item->name }}', `{{ $item->description }}`, '{{ $item->purpose }}', '{{ $item->usage }}')">
                                                <i class="ri-edit-box-line"></i>
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

<!-- Add Eye Scan Modal -->
<div class="modal fade" id="addEyeScanModal" tabindex="-1" aria-labelledby="addEyeScanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addEyeScanForm" action="{{ route('eyeScans.add') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addEyeScanModalLabel">Add New Eye Scan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <div id="fullEditorscans"></div>
                        <textarea class="form-control d-none" id="description" name="description" rows="10" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="purpose" class="form-label">Purpose</label>
                        <input type="text" class="form-control" id="purpose" name="purpose" required>
                    </div>
                    <div class="mb-3">
                        <label for="usage" class="form-label">Usage</label>
                        <input type="text" class="form-control" id="usage" name="usage" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Eye Scan Modal -->
<div class="modal fade" id="editEyeScanModal" tabindex="-1" aria-labelledby="editEyeScanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editEyeScanForm" action="{{ route('eyeScans.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="edit_eye_scan_id" name="id">
                <div class="modal-header">
                    <h5 class="modal-title" id="editEyeScanModalLabel">Edit Eye Scan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_description" class="form-label">Description</label>
                        <div id="editFullEditor"></div>
                        <textarea class="form-control d-none" id="edit_description" name="description" rows="10" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit_purpose" class="form-label">Purpose</label>
                        <input type="text" class="form-control" id="edit_purpose" name="purpose" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_usage" class="form-label">Usage</label>
                        <input type="text" class="form-control" id="edit_usage" name="usage" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteEyeScanModal" tabindex="-1" aria-labelledby="deleteEyeScanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="deleteEyeScanForm" action="{{ route('eyeScans.delete') }}" method="POST">
                @csrf
                <input type="hidden" id="eyeScanId" name="id">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteEyeScanModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <div class="mb-2">
                        <img src="{{ asset('AdminArea/images/bin.gif') }}" alt="Delete Confirmation" width="80">
                    </div>
                    <h5>Are you sure you want to delete this eye scan?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Upload Image Modal -->
<div class="modal fade" id="uploadImageModal" tabindex="-1" aria-labelledby="uploadImageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadImageModalLabel">Add New Eye Scan Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('EyeScans.eyeScanImageAdd') }}" method="POST" enctype="multipart/form-data" id="uploadImageForm">
                    @csrf
                    <input type="hidden" id="uploadEyeScanId" name="eyeScanId">
                    <div class="mb-3">
                        <label for="image" class="form-label">Select Image <span style="color: red;">*</span></label>
                        <input type="file" class="form-control" id="image" name="image" required accept="image/*">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Upload</button>
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('css')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endpush

@push('js')
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    // Initialize Quill editor for add form
    const addEditor = new Quill('#fullEditorscans', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, 3, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                ['link', 'image'],
                ['clean']
            ]
        }
    });

    // Initialize Quill editor for edit form
    const editEditor = new Quill('#editFullEditor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, 3, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                ['link', 'image'],
                ['clean']
            ]
        }
    });

    // Sync Quill editor content with textarea for add form
    addEditor.on('text-change', function() {
        document.getElementById('description').value = addEditor.root.innerHTML;
    });

    // Sync Quill editor content with textarea for edit form
    editEditor.on('text-change', function() {
        document.getElementById('edit_description').value = editEditor.root.innerHTML;
    });

    function editEyeScan(id, name, description, purpose, usage) {
        document.getElementById('edit_eye_scan_id').value = id;
        document.getElementById('edit_name').value = name;
        document.getElementById('edit_description').value = description;
        document.getElementById('edit_purpose').value = purpose;
        document.getElementById('edit_usage').value = usage;
        editEditor.root.innerHTML = description;
        $('#editEyeScanModal').modal('show');
    }

    function confirmDelete(eyeScanId) {
        document.getElementById('eyeScanId').value = eyeScanId;
        $('#deleteEyeScanModal').modal('show');
    }

    function openUploadImageModal(eyeScanId) {
        document.getElementById('uploadEyeScanId').value = eyeScanId;
        $('#uploadImageModal').modal('show');
    }
</script>
@endpush

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
            Eye Issues Management
        </li>
    </ol>
    <!-- Breadcrumb ends -->
</div>

<div class="app-body">
    <div class="row gx-3">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title">Eye Issues List</h5>
                    <button class="btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#addEyeIssueModal">
                        Add New Eye Issue
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basicExample" class="table truncate m-0 align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Symptoms</th>
                                    <th>Causes</th>
                                    <th>Treatments</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($eyeIssues as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->eyeIssueId }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{!! Str::limit($item->description, 50) !!}</td>
                                    <td>{{ $item->symptoms }}</td>
                                    <td>{{ $item->causes }}</td>
                                    <td>{{ $item->treatments }}</td>
                                    <td>
                                        <button type="button" class="btn btn-outline-warning btn-sm"
                                            data-toggle="modal" data-target="#uploadImageModal"
                                            onclick="openUploadImageModal('{{ $item->eyeIssueId }}')">
                                            <i class="ri-add-circle-line menu-icon"></i>
                                        </button>
                                        <a href="{{ route('EyeIssues.viewEyeIssueImageAll', $item->eyeIssueId) }}"
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
                                                onclick="editEyeIssue('{{ $item->id }}', '{{ $item->name }}', `{{ $item->description }}`, '{{ $item->symptoms }}', '{{ $item->causes }}', '{{ $item->treatments }}')">
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

<!-- Add Eye Issue Modal -->
<div class="modal fade" id="addEyeIssueModal" tabindex="-1" aria-labelledby="addEyeIssueModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addEyeIssueForm" action="{{ route('eyeIssues.add') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addEyeIssueModalLabel">Add New Eye Issue</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <div id="fullEditoreyeissue" style="min-height: 150px;"></div>
                        <textarea class="form-control d-none" id="description" name="description" rows="10" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="symptoms" class="form-label">Symptoms</label>
                        <input type="text" class="form-control" id="symptoms" name="symptoms" required>
                    </div>
                    <div class="mb-3">
                        <label for="causes" class="form-label">Causes</label>
                        <input type="text" class="form-control" id="causes" name="causes" required>
                    </div>
                    <div class="mb-3">
                        <label for="treatments" class="form-label">Treatments</label>
                        <input type="text" class="form-control" id="treatments" name="treatments" required>
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

<!-- Edit Eye Issue Modal -->
<div class="modal fade" id="editEyeIssueModal" tabindex="-1" aria-labelledby="editEyeIssueModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editEyeIssueForm" action="{{ route('eyeIssues.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="edit_eye_issue_id" name="id">
                <div class="modal-header">
                    <h5 class="modal-title" id="editEyeIssueModalLabel">Edit Eye Issue</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_description" class="form-label">Description</label>
                        <div id="editFullEditor" style="min-height: 150px;"></div>
                        <textarea class="form-control d-none" id="edit_description" name="description" rows="10" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit_symptoms" class="form-label">Symptoms</label>
                        <input type="text" class="form-control" id="edit_symptoms" name="symptoms" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_causes" class="form-label">Causes</label>
                        <input type="text" class="form-control" id="edit_causes" name="causes" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_treatments" class="form-label">Treatments</label>
                        <input type="text" class="form-control" id="edit_treatments" name="treatments" required>
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
<div class="modal fade" id="deleteEyeIssueModal" tabindex="-1" aria-labelledby="deleteEyeIssueModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="deleteEyeIssueForm" action="{{ route('eyeIssues.delete') }}" method="POST">
                @csrf
                <input type="hidden" id="eyeIssueId" name="id">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteEyeIssueModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <div class="mb-2">
                        <img src="{{ asset('AdminArea/images/bin.gif') }}" alt="Delete Confirmation" width="80">
                    </div>
                    <h5>Are you sure you want to delete this eye issue?</h5>
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
                <h5 class="modal-title" id="uploadImageModalLabel">Add New Eye Issue Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('EyeIssues.eyeIssueImageAdd') }}" method="POST" enctype="multipart/form-data" id="uploadImageForm">
                    @csrf
                    <input type="hidden" id="uploadEyeIssueId" name="eyeIssueId">
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
// Global variables to hold Quill instances
let addEditor = null;
let editEditor = null;

// Function to initialize Quill editors
function initializeQuillEditors() {
    // Initialize Quill editor for add form if not already initialized
    if (!addEditor) {
        addEditor = new Quill('#fullEditoreyeissue', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    ['link', 'image'],
                    ['clean']
                ]
            },
            placeholder: 'Enter description here...'
        });

        // Sync Quill editor content with textarea for add form
        addEditor.on('text-change', function() {
            document.getElementById('description').value = addEditor.root.innerHTML;
        });
    }

    // Initialize Quill editor for edit form if not already initialized
    if (!editEditor) {
        editEditor = new Quill('#editFullEditor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    ['link', 'image'],
                    ['clean']
                ]
            },
            placeholder: 'Enter description here...'
        });

        // Sync Quill editor content with textarea for edit form
        editEditor.on('text-change', function() {
            document.getElementById('edit_description').value = editEditor.root.innerHTML;
        });
    }
}

// Initialize editors when the page loads
document.addEventListener('DOMContentLoaded', function() {
    initializeQuillEditors();
});

// Re-initialize or reset Quill content when modals are shown
$('#addEyeIssueModal').on('show.bs.modal', function () {
    if (!addEditor) {
        initializeQuillEditors();
    }
    // Clear the editor content when opening the modal
    addEditor.root.innerHTML = '';
    document.getElementById('description').value = '';
    document.getElementById('name').value = '';
    document.getElementById('symptoms').value = '';
    document.getElementById('causes').value = '';
    document.getElementById('treatments').value = '';
});

$('#editEyeIssueModal').on('show.bs.modal', function () {
    if (!editEditor) {
        initializeQuillEditors();
    }
});

function editEyeIssue(id, name, description, symptoms, causes, treatments) {
    document.getElementById('edit_eye_issue_id').value = id;
    document.getElementById('edit_name').value = name;
    document.getElementById('edit_description').value = description;
    document.getElementById('edit_symptoms').value = symptoms;
    document.getElementById('edit_causes').value = causes;
    document.getElementById('edit_treatments').value = treatments;
    editEditor.root.innerHTML = description;
    $('#editEyeIssueModal').modal('show');
}

function confirmDelete(eyeIssueId) {
    document.getElementById('eyeIssueId').value = eyeIssueId;
    $('#deleteEyeIssueModal').modal('show');
}

function openUploadImageModal(eyeIssueId) {
    document.getElementById('uploadEyeIssueId').value = eyeIssueId;
    $('#uploadImageModal').modal('show');
}
</script>
@endpush

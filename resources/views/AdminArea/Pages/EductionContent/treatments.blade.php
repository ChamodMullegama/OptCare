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
            Treatments Management
        </li>
    </ol>
    <!-- Breadcrumb ends -->
</div>

<div class="app-body">
    <div class="row gx-3">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title">Treatments List</h5>
                    <button class="btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#addTreatmentModal">
                        Add New Treatment
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basicExample" class="table truncate m-0 align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>Treatment Name</th>
                                    <th>Description</th>
                                    <th>Related Eye Diseases</th>
                                    <th>Benefits</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($treatments as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->treatmentId }}</td>
                                    <td>{{ $item->treatment_name }}</td>
                                    <td>{!! Str::limit($item->description, 50) !!}</td>
                                    <td>{{ $item->related_eye_diseases }}</td>
                                    <td>{{ $item->benefits }}</td>
                                    <td>
                                        <button type="button" class="btn btn-outline-warning btn-sm"
                                            data-toggle="modal" data-target="#uploadImageModal"
                                            onclick="openUploadImageModal('{{ $item->treatmentId }}')">
                                            <i class="ri-add-circle-line menu-icon"></i>
                                        </button>
                                        <a href="{{ route('Treatments.viewTreatmentImageAll', $item->treatmentId) }}"
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
                                                onclick="editTreatment('{{ $item->id }}', '{{ $item->treatment_name }}', `{{ $item->description }}`, '{{ $item->related_eye_diseases }}', '{{ $item->benefits }}')">
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

<!-- Add Treatment Modal -->
<div class="modal fade" id="addTreatmentModal" tabindex="-1" aria-labelledby="addTreatmentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addTreatmentForm" action="{{ route('treatments.add') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addTreatmentModalLabel">Add New Treatment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="treatment_name" class="form-label">Treatment Name</label>
                        <input type="text" class="form-control" id="treatment_name" name="treatment_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <div id="fullEditortreatments" style="min-height: 150px;"></div>
                        <textarea class="form-control d-none" id="description" name="description" rows="10" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="related_eye_diseases" class="form-label">Related Eye Diseases</label>
                        <input type="text" class="form-control" id="related_eye_diseases" name="related_eye_diseases" required>
                    </div>
                    <div class="mb-3">
                        <label for="benefits" class="form-label">Benefits</label>
                        <input type="text" class="form-control" id="benefits" name="benefits" required>
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

<!-- Edit Treatment Modal -->
<div class="modal fade" id="editTreatmentModal" tabindex="-1" aria-labelledby="editTreatmentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editTreatmentForm" action="{{ route('treatments.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="edit_treatment_id" name="id">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTreatmentModalLabel">Edit Treatment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_treatment_name" class="form-label">Treatment Name</label>
                        <input type="text" class="form-control" id="edit_treatment_name" name="treatment_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_description" class="form-label">Description</label>
                        <div id="editFullEditor" style="min-height: 150px;"></div>
                        <textarea class="form-control d-none" id="edit_description" name="description" rows="10" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit_related_eye_diseases" class="form-label">Related Eye Diseases</label>
                        <input type="text" class="form-control" id="edit_related_eye_diseases" name="related_eye_diseases" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_benefits" class="form-label">Benefits</label>
                        <input type="text" class="form-control" id="edit_benefits" name="benefits" required>
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
<div class="modal fade" id="deleteTreatmentModal" tabindex="-1" aria-labelledby="deleteTreatmentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="deleteTreatmentForm" action="{{ route('treatments.delete') }}" method="POST">
                @csrf
                <input type="hidden" id="treatmentId" name="id">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteTreatmentModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <div class="mb-2">
                        <img src="{{ asset('AdminArea/images/bin.gif') }}" alt="Delete Confirmation" width="80">
                    </div>
                    <h5>Are you sure you want to delete this treatment?</h5>
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
                <h5 class="modal-title" id="uploadImageModalLabel">Add New Treatment Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('Treatments.treatmentImageAdd') }}" method="POST" enctype="multipart/form-data" id="uploadImageForm">
                    @csrf
                    <input type="hidden" id="uploadTreatmentId" name="treatmentId">
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
        addEditor = new Quill('#fullEditortreatments', {
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
$('#addTreatmentModal').on('show.bs.modal', function () {
    if (!addEditor) {
        initializeQuillEditors();
    }
    // Clear the editor content when opening the modal
    addEditor.root.innerHTML = '';
    document.getElementById('description').value = '';
    document.getElementById('treatment_name').value = '';
    document.getElementById('related_eye_diseases').value = '';
    document.getElementById('benefits').value = '';
});

$('#editTreatmentModal').on('show.bs.modal', function () {
    if (!editEditor) {
        initializeQuillEditors();
    }
});

function editTreatment(id, treatment_name, description, related_eye_diseases, benefits) {
    document.getElementById('edit_treatment_id').value = id;
    document.getElementById('edit_treatment_name').value = treatment_name;
    document.getElementById('edit_description').value = description;
    document.getElementById('edit_related_eye_diseases').value = related_eye_diseases;
    document.getElementById('edit_benefits').value = benefits;
    editEditor.root.innerHTML = description;
    $('#editTreatmentModal').modal('show');
}

function confirmDelete(treatmentId) {
    document.getElementById('treatmentId').value = treatmentId;
    $('#deleteTreatmentModal').modal('show');
}

function openUploadImageModal(treatmentId) {
    document.getElementById('uploadTreatmentId').value = treatmentId;
    $('#uploadImageModal').modal('show');
}
</script>
@endpush

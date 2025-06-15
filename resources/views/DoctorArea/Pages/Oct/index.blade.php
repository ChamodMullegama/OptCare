@extends('DoctorArea.Layout.main')
@section('title', 'OCT Analysis')
@section('Doctorcontainer')

<div class="app-hero-header d-flex align-items-center">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <i class="ri-home-8-line lh-1 pe-3 me-3 border-end"></i>
            <a href="{{ route('doctor.dashboard') }}">Home</a>
        </li>
        <li class="breadcrumb-item text-primary" aria-current="page">
            OCT Analysis
        </li>
    </ol>
</div>

<div class="app-body">
    <div class="row gx-3">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="custom-tabs-container">
<h5 class="mb-1 profile-name text-nowrap text-truncate d-none">
    {{ session('doctor.name', 'Doctor') }}
</h5>
<h5 class="mb-1 profile-name text-nowrap text-truncate d-none">
    {{ session('doctor.doctorId', 'Doctor') }}
</h5>

                        <ul class="nav nav-tabs" id="customTab2" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="tab-oneA" data-bs-toggle="tab" href="#oneA" role="tab"
                                    aria-controls="oneA" aria-selected="true"><i class="ri-image-line"></i> Upload & Analyze</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="tab-twoA" data-bs-toggle="tab" href="#twoA" role="tab"
                                    aria-controls="twoA" aria-selected="false"><i class="ri-file-chart-line"></i> Analysis Results</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="tab-threeA" data-bs-toggle="tab" href="#threeA" role="tab"
                                    aria-controls="threeA" aria-selected="false"><i class="ri-history-line"></i> Analysis History</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="tab-fourA" data-bs-toggle="tab" href="#fourA" role="tab"
                                    aria-controls="fourA" aria-selected="false"><i class="ri-settings-3-line"></i> Settings</a>
                            </li>
                        </ul>

                        <form id="octAnalysisForm" action="{{ route('oct.analyze') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="tab-content h-350">
                                <div class="tab-pane fade show active" id="oneA" role="tabpanel">
                                    <div class="row gx-3">
                                        <!-- Hidden Patient ID Field -->
                                        <input type="hidden" id="patient_id" name="patient_id" value="{{ $patient->patient_id ?? '' }}">
                                        <div class="col-xxl-6 col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="patient_name">Patient Name <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="ri-account-circle-line"></i>
                                                    </span>
                                                    <input type="text" class="form-control" id="patient_name" name="patient_name"
                                                           placeholder="Enter Patient Name" value="{{ $patient->patient_name ?? '' }}"
                                                           {{ $patient ? 'readonly' : 'required' }}>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-6 col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="patient_email">Patient Email</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="ri-mail-line"></i>
                                                    </span>
                                                    <input type="email" class="form-control" id="patient_email" name="patient_email"
                                                           placeholder="Enter Patient Email" value="{{ $patient->patient_email ?? '' }}"
                                                           {{ $patient ? 'readonly' : '' }}>
                                                </div>
                                                @error('patient_email')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="patient_phone">Patient Phone</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="ri-phone-line"></i>
                                                    </span>
                                                    <input type="tel" class="form-control" id="patient_phone" name="patient_phone"
                                                           placeholder="Enter Patient Phone" value="{{ $patient->patient_phone ?? '' }}"
                                                           {{ $patient ? 'readonly' : '' }}>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="patient_age">Age</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="ri-user-line"></i>
                                                    </span>
                                                    <select class="form-select" id="patient_age" name="patient_age">
                                                        <option value="">Select Age</option>
                                                        @for ($i = 1; $i <= 100; $i++)
                                                            <option value="{{ $i }}" {{ ($patient && $patient->patient_age == $i) ? 'selected' : '' }}>{{ $i }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="eye_side">Eye Side <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="ri-eye-line"></i>
                                                    </span>
                                                    <select class="form-select" id="eye_side" name="eye_side" required>
                                                        <option value="">Select Eye</option>
                                                        <option value="left">Left Eye (OS)</option>
                                                        <option value="right">Right Eye (OD)</option>
                                                        <option value="both">Both Eyes (OU)</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="mb-3" id="left_eye_container">
                                                <label class="form-label" for="oct_image_left">Left Eye OCT Image <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="ri-image-add-line"></i>
                                                    </span>
                                                    <input type="file" class="form-control" id="oct_image_left" name="image_left" accept="image/jpeg,image/png,image/jpg" required>
                                                </div>
                                                <div class="form-text text-muted">
                                                    <i class="ri-information-line"></i>
                                                    Upload a clear OCT scan for the left eye in JPEG, PNG, or JPG format. Maximum file size: 10MB
                                                </div>
                                            </div>
                                            <div class="mb-3" id="right_eye_container" style="display: none;">
                                                <label class="form-label" for="oct_image_right">Right Eye OCT Image <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="ri-image-add-line"></i>
                                                    </span>
                                                    <input type="file" class="form-control" id="oct_image_right" name="image_right" accept="image/jpeg,image/png,image/jpg">
                                                </div>
                                                <div class="form-text text-muted">
                                                    <i class="ri-information-line"></i>
                                                    Upload a clear OCT scan for the right eye in JPEG, PNG, or JPG format. Maximum file size: 10MB
                                                </div>
                                            </div>
                                            <div class="mb-3" id="imagePreviewLeftContainer" style="display: none;">
                                                <label class="form-label">Left Eye Image Preview</label>
                                                <div class="border rounded p-3 text-center">
                                                    <img id="imagePreviewLeft" src="" alt="Left Eye OCT Preview" class="img-fluid rounded" style="max-height: 300px; max-width: 100%;">
                                                </div>
                                            </div>
                                            <div class="mb-3" id="imagePreviewRightContainer" style="display: none;">
                                                <label class="form-label">Right Eye Image Preview</label>
                                                <div class="border rounded p-3 text-center">
                                                    <img id="imagePreviewRight" src="" alt="Right Eye OCT Preview" class="img-fluid rounded" style="max-height: 300px; max-width: 100%;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="clinical_notes">Clinical Notes</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="ri-file-text-line"></i>
                                                    </span>
                                                    <textarea class="form-control" id="clinical_notes" name="clinical_notes" rows="3" placeholder="Enter any relevant clinical observations or patient symptoms"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


 <div class="tab-pane fade" id="twoA" role="tabpanel">
                                    <div class="row gx-3">
                                        @if(session('predictions'))
                                        <div class="col-12">
                                            <h5 class="mb-3"><i class="fas fa-file-medical me-2"></i>Analysis Results</h5>
                                            <div class="row gx-3">
                                                @foreach(session('predictions') as $eye => $data)
                                                <div class="{{ count(session('predictions')) == 2 ? 'col-md-6' : 'col-12' }} mb-3">
                                                    <div class="card border-0 shadow-sm h-100">
                                                        <div class="card-header bg-light text-black d-flex justify-content-between align-items-center">
                                                            <h6 class="mb-0"><i class="fas fa-eye me-2"></i>{{ ucfirst($eye) }} Eye Analysis</h6>
                                                            <span class="badge bg-{{ $data['prediction'] == 'NORMAL' ? 'success' : 'danger' }} fs-6">
                                                                {{ $data['prediction'] }}
                                                            </span>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="text-center mb-3">
                                                                <img src="{{ asset('storage/' . $data['image']) }}"
                                                                     class="img-fluid rounded border"
                                                                     alt="{{ ucfirst($eye) }} Eye OCT Scan"
                                                                     style="max-height: 200px; max-width: 100%;">
                                                            </div>
                                                            {{-- @if(session('success'))
                                                                <div class="alert alert-success d-flex align-items-center mb-3">
                                                                    <i class="fas fa-check-circle me-2"></i>
                                                                    {{ session('success') }}
                                                                </div>
                                                            @endif
                                                            @if(session('warning'))
                                                                <div class="alert alert-warning d-flex align-items-center mb-3">
                                                                    <i class="fas fa-exclamation-circle me-2"></i>
                                                                    {{ session('warning') }}
                                                                </div>
                                                            @endif --}}
                                                            <div class="recommendation-container bg-light p-3 rounded mb-3 shadow-sm">
                                                                {{-- <h6 class="text-primary mb-2"><i class="fas fa-stethoscope me-2"></i>Clinical Recommendation</h6> --}}
                                                                <div class="recommendation-content">{!! $data['recommendation'] !!}</div>
                                                            </div>
                                                            <div class="d-flex gap-2 flex-wrap">

                                                                <button class="btn btn-outline-warning btn-sm" onclick="downloadReport()">
                                                                    <i class="fas fa-download me-1"></i> Download
                                                                </button>
                                                                <button class="btn btn-outline-info btn-sm" onclick="shareReport()">
                                                                    <i class="fas fa-share-alt me-1"></i> Share
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        @else
                                         <div class="col-12">
                                            <div class="text-center py-5">
                                                <i class="ri-file-chart-line display-1 text-muted"></i>
                                                <h5 class="text-muted mt-3">No Analysis Results Available</h5>
                                                <p class="text-muted">Upload and analyze an OCT image to see results here.</p>
                                                <button class="btn btn-primary" onclick="switchToTab('oneA')">
                                                    <i class="ri-upload-line me-1"></i> Upload Image
                                                </button>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>



                                {{-- <div class="tab-pane fade" id="twoA" role="tabpanel">
                                    <div class="row gx-3">
                                        @if(session('predictions'))
                                        <div class="col-12">
                                            <h5 class="mb-3">Analysis Results</h5>
                                            <div class="row gx-3">
                                                @foreach(session('predictions') as $eye => $data)
                                                <div class="col-md-6 mb-3">
                                                    <div class="card border-0 shadow-sm">
                                                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                                            <h6 class="mb-0"><i class="ri-image-line me-2"></i>{{ ucfirst($eye) }} Eye Analysis</h6>
                                                            <span class="badge bg-{{ $data['prediction'] == 'NORMAL' ? 'success' : 'danger' }} fs-6">
                                                                {{ $data['prediction'] }}
                                                            </span>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="text-center mb-3">
                                                                <img src="{{ asset('storage/' . $data['image']) }}"
                                                                     class="img-fluid rounded border"
                                                                     alt="{{ ucfirst($eye) }} Eye OCT Scan"
                                                                     style="max-height: 250px; max-width: 100%;">
                                                            </div>
                                                            @if(session('success'))
                                                                <div class="alert alert-success d-flex align-items-center mb-3">
                                                                    <i class="ri-check-circle-line me-2"></i>
                                                                    {{ session('success') }}
                                                                </div>
                                                            @endif
                                                            @if(session('warning'))
                                                                <div class="alert alert-warning d-flex align-items-center mb-3">
                                                                    <i class="ri-alert-circle-line me-2"></i>
                                                                    {{ session('warning') }}
                                                                </div>
                                                            @endif
                                                            <div class="recommendation-container bg-light p-3 rounded mb-3">
                                                                <h6 class="text-primary mb-2"><i class="ri-stethoscope-line me-2"></i>Medical Recommendation</h6>
                                                                {!! $data['recommendation'] !!}
                                                            </div>
                                                            <div class="d-flex gap-2">
                                                                <button class="btn btn-outline-primary btn-sm" onclick="window.print()">
                                                                    <i class="ri-printer-line me-1"></i> Print
                                                                </button>
                                                                <button class="btn btn-outline-secondary btn-sm" onclick="downloadReport()">
                                                                    <i class="ri-download-line me-1"></i> Download
                                                                </button>
                                                                <button class="btn btn-outline-info btn-sm" onclick="shareReport()">
                                                                    <i class="ri-share-line me-1"></i> Share
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        @else
                                        <div class="col-12">
                                            <div class="text-center py-5">
                                                <i class="ri-file-chart-line display-1 text-muted"></i>
                                                <h5 class="text-muted mt-3">No Analysis Results Available</h5>
                                                <p class="text-muted">Upload and analyze an OCT image to see results here.</p>
                                                <button class="btn btn-primary" onclick="switchToTab('oneA')">
                                                    <i class="ri-upload-line me-1"></i> Upload Image
                                                </button>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div> --}}

                                <div class="tab-pane fade" id="threeA" role="tabpanel">
                                    <div class="row gx-3">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                 <table id="basicExample" class="table truncate m-0 align-middle">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th><i class="ri-calendar-line me-1"></i>Date</th>
                                                            <th><i class="ri-user-heart-line me-1"></i>Patient</th>
                                                            <th><i class="ri-eye-line me-1"></i>Eye</th>
                                                            <th><i class="ri-file-chart-line me-1"></i>Result</th>
                                                            <th><i class="ri-settings-line me-1"></i>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($analyses as $analysis)
                                                        <tr>
                                                            <td>{{ $analysis->created_at->format('Y-m-d') }}</td>
                                                            <td>{{ $analysis->patient_name }} ({{ $analysis->patient_id }})</td>
                                                            <td><span class="badge bg-info">{{ ucfirst($analysis->eye_side) }} Eye</span></td>
                                                            <td><span class="badge bg-{{ $analysis->prediction == 'NORMAL' ? 'success' : 'danger' }}">{{ $analysis->prediction }}</span></td>
                                                            <td>
                                                                <button class="btn btn-sm btn-outline-primary me-1" title="View" onclick="viewAnalysis({{ $analysis->id }})">
                                                                    <i class="ri-eye-line"></i>
                                                                </button>
                                                                <button  class="btn btn-outline-warning btn-sm" title="Download" onclick="downloadAnalysis({{ $analysis->id }})">
                                                                    <i class="ri-download-line"></i>
                                                                </button>
                                                                {{-- <button class="btn btn-sm btn-outline-danger" title="Delete"  onclick="confirmDelete('{{ $analysis->id }}')">
                                                                    <i class="ri-delete-bin-line"></i>
                                                                </button> --}}
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="fourA" role="tabpanel">
                                    <div class="row gx-3">
                                        <div class="col-xxl-4 col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="analysis_sensitivity">Analysis Sensitivity</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="ri-settings-3-line"></i>
                                                    </span>
                                                    <select class="form-select" id="analysis_sensitivity" name="analysis_sensitivity">
                                                        <option value="standard" selected>Standard</option>
                                                        <option value="high">High Sensitivity</option>
                                                        <option value="low">Low Sensitivity</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="auto_save">Auto-Save Results</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="ri-save-line"></i>
                                                    </span>
                                                    <select class="form-select" id="auto_save" name="auto_save">
                                                        <option value="enabled" selected>Enabled</option>
                                                        <option value="disabled">Disabled</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="notification_alerts">Notification Alerts</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="ri-notification-line"></i>
                                                    </span>
                                                    <select class="form-select" id="notification_alerts" name="notification_alerts">
                                                        <option value="all" selected>All Alerts</option>
                                                        <option value="critical">Critical Only</option>
                                                        <option value="none">None</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card border-0 bg-light">
                                                <div class="card-body">
                                                    <h6 class="card-title"><i class="ri-information-line me-2"></i>Analysis Information</h6>
                                                    <ul class="list-unstyled mb-0">
                                                        <li class="mb-2"><i class="ri-check-line text-success me-2"></i>Supported formats: JPEG, PNG, JPG</li>
                                                        <li class="mb-2"><i class="ri-check-line text-success me-2"></i>Maximum file size: 10MB</li>
                                                        <li class="mb-2"><i class="ri-check-line text-success me-2"></i>Recommended resolution: 512x512 pixels or higher</li>
                                                        <li class="mb-2"><i class="ri-check-line text-success me-2"></i>AI model accuracy: 95.3%</li>
                                                        <li><i class="ri-check-line text-success me-2"></i>Analysis time: 2-5 seconds</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex gap-2 justify-content-end mt-4">
                                <button type="button" class="btn btn-outline-secondary" onclick="resetForm()">
                                    <i class="ri-refresh-line me-1"></i> Reset
                                </button>
                                <button type="submit" class="btn btn-primary" id="analyzeBtn">
                                    <span class="spinner-border spinner-border-sm d-none me-1" role="status"></span>
                                    <i class="ri-scan-line me-1"></i> Analyze Image
                                </button>
                            </div>
                        </form>
                    </div>

                    @if(session('error'))
                    <div class="alert alert-danger d-flex align-items-center mt-3">
                        <i class="ri-error-warning-line me-2"></i>
                        {{ session('error') }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>






@endsection

@push('css')
<style>
.custom-tabs-container .nav-tabs .nav-link {
    border-radius: 8px 8px 0 0;
    margin-right: 2px;
}
.custom-tabs-container .nav-tabs .nav-link.active {
    background-color: #007bff;
    color: white;
    border-color: #007bff;
}

.table-hover tbody tr:hover {
    background-color: rgba(0, 123, 255, 0.05);
}
.badge {
    font-weight: 500;
}
#imagePreviewLeft, #imagePreviewRight {
    border: 2px dashed #dee2e6;
    transition: all 0.3s ease;
}
.form-control:focus, .form-select:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}
.card {
    margin-bottom: 1rem;
}
.card-body {
    padding: 1.5rem;
}
.card img {
    object-fit: contain;
}
</style>
@endpush

@push('js')
<script>
// Form submission with loading state
document.getElementById('octAnalysisForm').addEventListener('submit', function(e) {
    const btn = document.getElementById('analyzeBtn');
    const spinner = btn.querySelector('.spinner-border');
    const icon = btn.querySelector('.ri-scan-line');

    btn.disabled = true;
    spinner.classList.remove('d-none');
    icon.classList.add('d-none');
    btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1" role="status"></span>Analyzing...';
});

// Image preview functionality
function setupImagePreview(inputId, previewId, containerId) {
    const input = document.getElementById(inputId);
    if (input) {
        input.addEventListener('change', function(e) {
            const file = e.target.files[0];
            const previewContainer = document.getElementById(containerId);
            const previewImg = document.getElementById(previewId);

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    previewContainer.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                previewContainer.style.display = 'none';
            }
        });
    }
}

setupImagePreview('oct_image_left', 'imagePreviewLeft', 'imagePreviewLeftContainer');
setupImagePreview('oct_image_right', 'imagePreviewRight', 'imagePreviewRightContainer');

// Toggle image input fields based on eye side selection
document.getElementById('eye_side').addEventListener('change', function() {
    const leftContainer = document.getElementById('left_eye_container');
    const rightContainer = document.getElementById('right_eye_container');
    const leftInput = document.getElementById('oct_image_left');
    const rightInput = document.getElementById('oct_image_right');
    const leftPreview = document.getElementById('imagePreviewLeftContainer');
    const rightPreview = document.getElementById('imagePreviewRightContainer');

    // Reset all inputs and previews
    leftInput.value = '';
    rightInput.value = '';
    leftPreview.style.display = 'none';
    rightPreview.style.display = 'none';

    if (this.value === 'left') {
        leftContainer.style.display = 'block';
        rightContainer.style.display = 'none';
        leftInput.required = true;
        rightInput.required = false;
    } else if (this.value === 'right') {
        leftContainer.style.display = 'none';
        rightContainer.style.display = 'block';
        leftInput.required = false;
        rightInput.required = true;
    } else if (this.value === 'both') {
        leftContainer.style.display = 'block';
        rightContainer.style.display = 'block';
        leftInput.required = true;
        rightInput.required = true;
    } else {
        leftContainer.style.display = 'none';
        rightContainer.style.display = 'none';
        leftInput.required = false;
        rightInput.required = false;
    }
});

// Switch to specific tab
function switchToTab(tabId) {
    const tabTrigger = document.querySelector(`[href="#${tabId}"]`);
    const tab = new bootstrap.Tab(tabTrigger);
    tab.show();
}

// Reset form
function resetForm() {
    document.getElementById('octAnalysisForm').reset();
    document.getElementById('imagePreviewLeftContainer').style.display = 'none';
    document.getElementById('imagePreviewRightContainer').style.display = 'none';
    document.getElementById('left_eye_container').style.display = 'none';
    document.getElementById('right_eye_container').style.display = 'none';
    document.getElementById('oct_image_left').required = false;
    document.getElementById('oct_image_right').required = false;
    @if(!$patient)
    document.getElementById('patient_id').value = '';
    @endif

    const btn = document.getElementById('analyzeBtn');
    btn.disabled = false;
    btn.innerHTML = '<i class="ri-scan-line me-1"></i> Analyze Image';
}

// Download report functionality
function downloadReport() {
    alert('Download functionality will be implemented based on your requirements.');
}

// Share report functionality
function shareReport() {
    alert('Share functionality will be implemented based on your requirements.');
}

// View analysis details
function viewAnalysis(id) {
    window.location.href = `/oct-analysis/view/${id}`;
}

// Download analysis
function downloadAnalysis(id) {
    window.location.href = `/oct-analysis/download/${id}`;
}

// Delete analysis
    function submitDeleteForm(id) {
            // Set the student ID in the hidden input field of the delete modal
            document.getElementById('id').value = id;

            // Show the delete modal
            $('#deleteOctModal').modal('show');
        }

// Auto-switch to results tab after successful analysis
@if(session('predictions'))
document.addEventListener('DOMContentLoaded', function() {
    switchToTab('twoA');
});
@endif

// Form validation
document.getElementById('octAnalysisForm').addEventListener('submit', function(e) {
    const eyeSide = document.getElementById('eye_side').value;
    const leftImage = document.getElementById('oct_image_left').files[0];
    const rightImage = document.getElementById('oct_image_right').files[0];
    const patientName = document.getElementById('patient_name').value;
    const patientEmail = document.getElementById('patient_email').value;
    const patientId = document.getElementById('patient_id').value;

    @if(!$patient)
    if (!patientName) {
        e.preventDefault();
        alert('Please enter the patient name.');
        return false;
    }

    if (!patientId) {
        e.preventDefault();
        alert('Please wait for the patient ID to be generated.');
        return false;
    }
    @endif

    if (patientEmail && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(patientEmail)) {
        e.preventDefault();
        alert('Please enter a valid email address.');
        return false;
    }

    if (!eyeSide) {
        e.preventDefault();
        alert('Please select which eye is being analyzed.');
        return false;
    }

    if (eyeSide === 'left' && !leftImage) {
        e.preventDefault();
        alert('Please select an OCT image for the left eye.');
        return false;
    }

    if (eyeSide === 'right' && !rightImage) {
        e.preventDefault();
        alert('Please select an OCT image for the right eye.');
        return false;
    }

    if (eyeSide === 'both' && (!leftImage || !rightImage)) {
        e.preventDefault();
        alert('Please select OCT images for both left and right eyes.');
        return false;
    }

    const imagesToValidate = eyeSide === 'both' ? [leftImage, rightImage] : eyeSide === 'left' ? [leftImage] : [rightImage];
    const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];

    for (const image of imagesToValidate) {
        if (image) {
            if (image.size > 10 * 1024 * 1024) {
                e.preventDefault();
                alert('Image size must be less than 10MB.');
                return false;
            }
            if (!allowedTypes.includes(image.type)) {
                e.preventDefault();
                alert('Please upload a valid image file (JPEG, PNG, or JPG).');
                return false;
            }
        }
    }
});


// Auto-generate patient ID when patient name is entered
@if(!$patient)
document.getElementById('patient_name').addEventListener('blur', function() {
    const patientIdInput = document.getElementById('patient_id');
    const patientName = this.value.trim();

    if (patientName && !patientIdInput.value) {
        const timestamp = Date.now().toString().slice(-6);
        const initials = patientName.split(' ').map(name => name.charAt(0)).join('').toUpperCase();
        patientIdInput.value = `P${initials}${timestamp}`;
    }
});
@endif
</script>
@endpush


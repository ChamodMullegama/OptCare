@extends('PublicArea.Layout.main')

@section('Publiccontainer')

<!-- Page Title -->
<section class="page-title">
    <div class="bg-layer" style="background-image: url({{ asset('PublicArea/images/background/page-title.jpg') }});"></div>
    <div class="auto-container">
        <div class="content-box">
            <h1>OCT Scan Analysis</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>OCT Scan Analysis</li>
            </ul>
        </div>
    </div>
</section>

<section class="service-style-three centred">
    <div class="pattern-layer">
        <div class="pattern-1" style="background-image: url({{ asset('assets/images/shape/shape-34.png') }});"></div>
        <div class="pattern-2" style="background-image: url({{ asset('assets/images/shape/shape-35.png') }});"></div>
        <div class="pattern-3" style="background-image: url({{ asset('assets/images/shape/shape-36.png') }});"></div>
    </div>
    <div class="auto-container">
        <div class="sec-title-two mb_100">
            <h5 class="d_block fs_18 mb_20">OCT Scan</h5>
            <h2 class="d_block fs_40 fw_bold">Upload OCT Scan for Analysis</h2>
        </div>

        <!-- OCT Scan Upload Form -->
        <div class="oct-upload-form mb_50">
            <!-- Display Success/Error Messages -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('oct.analyzeOctPublic') }}" method="POST" enctype="multipart/form-data" id="octUploadForm">
                @csrf

                <!-- Drag and Drop Upload Area -->
                <div class="upload-area mb_30" id="uploadArea">
                    <div class="upload-content">
                        <div class="upload-icon mb_20">
                            <i class="fas fa-cloud-upload-alt fs_48 text-primary"></i>
                        </div>
                        <h4 class="fs_20 fw_bold mb_10">Drag & Drop your OCT Scan here</h4>
                        <p class="fs_14 mb_15 text-muted">or click to browse files</p>
                        <div class="file-info">
                            <small class="text-muted">Supported formats: JPEG, PNG, JPG | Max size: 10MB</small>
                        </div>
                        <input type="file" name="oct_image" id="oct_image" class="file-input" accept="image/jpeg,image/png,image/jpg" required hidden>
                        <button type="button" class="btn btn-outline-primary mt_15" id="browseBtn">
                            <i class="fas fa-folder-open me-2"></i>Browse Files
                        </button>
                    </div>

                    <!-- File Preview -->
                    <div class="file-preview" id="filePreview" style="display: none;">
                        <div class="preview-content">
                            <img id="previewImage" src="" alt="Preview" class="preview-img">
                            <div class="file-details">
                                <h5 id="fileName" class="fs_16 fw_bold mb_5"></h5>
                                <p id="fileSize" class="fs_12 text-muted mb_10"></p>
                                <button type="button" class="btn btn-sm btn-outline-danger" id="removeFile">
                                    <i class="fas fa-trash me-1"></i>Remove
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Upload Progress -->
                <div class="upload-progress mb_20" id="uploadProgress" style="display: none;">
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%"></div>
                    </div>
                    <small class="text-muted mt-2 d-block">Analyzing your OCT scan...</small>
                </div>

                <div class="form-group text-center">
                    <button type="submit" class="theme-btn btn-one" id="analyzeBtn" disabled>
                        Upload & Analyze
                    </button>
                </div>
            </form>

            <!-- Display Prediction Results -->
            @if (session('prediction') || session('recommendation') || session('image_path'))
                <!-- Hide upload form when results are available -->
                <style>
                    .oct-upload-form form,
                    .oct-upload-form > h3 {
                        display: none !important;
                    }
                </style>

                <div class="prediction-results mt_30">
                    <div class="results-header mb_30 text-center">
                        <div class="result-icon mb_15">
                            <i class="fas fa-chart-line fs_36 text-success"></i>
                        </div>
                        <h3 class="fs_28 fw_bold text-primary">Analysis Complete</h3>
                        <p class="fs_14 text-muted">Here are the results of your OCT scan analysis</p>
                    </div>

                    <div class="results-container">
                        <!-- Uploaded Image Display -->
                        @if (session('image_path'))
                            <div class="result-image-container mb_30">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-header bg-light">
                                        <h5 class="card-title mb-0">
                                            <i class="fas fa-image me-2 text-primary"></i>
                                            Uploaded OCT Scan
                                        </h5>
                                    </div>
                                    <div class="card-body text-center p_30">
                                        <img src="{{ url('storage/' . session('image_path')) }}"
                                             alt="OCT Scan"
                                             class="img-fluid rounded shadow-sm analysis-image"
                                             style="max-height: 400px; cursor: pointer;"
                                             data-bs-toggle="modal"
                                             data-bs-target="#imageModal">
                                        <p class="fs_12 text-muted mt_10">Click image to view in full size</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Analysis Results Grid -->
                        <div class="row">
                            <!-- Prediction Results -->
                            <div class="col-lg-6 mb_30">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-header bg-primary text-white">
                                        <h5 class="card-title mb-0 text-white">
                                            <i class="fas fa-brain me-2"></i>
                                            AI Prediction
                                        </h5>
                                    </div>
                                    <div class="card-body p_30">
                                        <div class="prediction-badge mb_20">
                                            @php
                                                $prediction = session('prediction', 'N/A');
                                                $badgeClass = 'bg-light';
                                                $icon = 'fas fa-question-circle';

                                                if (stripos($prediction, 'normal') !== false) {
                                                    $badgeClass = 'bg-success';
                                                    $icon = 'fas fa-check-circle';
                                                } elseif (stripos($prediction, 'abnormal') !== false || stripos($prediction, 'disease') !== false) {
                                                    $badgeClass = 'bg-warning';
                                                    $icon = 'fas fa-exclamation-triangle';
                                                }
                                            @endphp
                                            <span class="badge {{ $badgeClass }} fs_14 p_10">
                                                <i class="{{ $icon }} me-2"></i>
                                                {{ $prediction }}
                                            </span>
                                        </div>
                                        <div class="prediction-details">
                                            <h6 class="fs_16 fw_bold mb_10">Analysis Summary</h6>
                                            <p class="fs_14 text-muted mb_15">
                                                Our AI model has analyzed your OCT scan and provided the above classification based on learned patterns from medical imaging data.
                                            </p>
                                            <div class="confidence-info">
                                                <small class="text-muted">
                                                    <i class="fas fa-info-circle me-1"></i>
                                                    This is an AI-generated analysis and should not replace professional medical consultation.
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Recommendations -->
                            <div class="col-lg-6 mb_30">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-header bg-info text-white">
                                        <h5 class="card-title mb-0 text-white">
                                            <i class="fas fa-clipboard-list me-2"></i>
                                            Ai Recommendations
                                        </h5>
                                    </div>
                                    <div class="card-body p_30">
                                    
                                        <div class="recommendation-content">
                @if (session('recommendation'))
                    <div class="recommendation-text mb_15">
                        {!! session('recommendation') !!}
                    </div>
                @else
                    <p class="text-muted">No specific recommendations available at this time. Please consult an ophthalmologist for further guidance.</p>
                @endif
            </div>

                                        <!-- Action Buttons -->
                                        <div class="action-buttons mt_20">
                                            <button class="btn btn-sm btn-outline-primary me-2" onclick="window.print()">
                                                <i class="fas fa-print me-1"></i>Print Results
                                            </button>
                                         <button type="submit" form="downloadReportForm" class="btn btn-sm btn-outline-primary me-2">
    <i class="fas fa-download me-1"></i>Download Report
</button>
<form id="downloadReportForm" action="{{ route('oct.downloadAnalysisPublic') }}" method="POST" style="display: none;">
    @csrf
      <input type="hidden" name="customer_email" value="{{ session('customer_email') }}">
    <input type="hidden" name="image_path" value="{{ session('image_path') }}">
    <input type="hidden" name="prediction" value="{{ session('prediction') }}">
    <input type="hidden" name="recommendation" value="{{ session('recommendation') }}">
</form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- New Analysis Button -->
                        <div class="new-analysis-section mt_30 text-center">
                            <hr class="my-4">
                           <h5 class="fs_18 fw_bold mb_15">Need another analysis or doctor help?</h5>

                            <a href="{{ route('oct.uploadOctPublic') }}" class="btn btn-outline-info">
                                <i class="fas fa-plus me-2"></i> Upload New OCT Scan
                            </a>
                            <!-- Replace the existing "Need Advice From Dr" button -->
{{-- @php
    // Get the latest analysis ID for the current user
    $latestAnalysis = \App\Models\PatientOctAnalysis::where('user_id', session('customer_id'))
        ->latest()
        ->first();
    $analysisId = $latestAnalysis ? $latestAnalysis->id : null;
@endphp --}}
@php

    // Get the latest analysis ID for the current user
    $latestAnalysis = \App\Models\PatientOctAnalysis::where('user_id', session('customer_id'))
        ->latest()
        ->first();
    $analysisId = $latestAnalysis ? $latestAnalysis->id : null;
@endphp

<a href="{{ route('oct.requestDoctorAdvice', ['id' => $analysisId]) }}" class="btn btn-outline-info" {{ !$analysisId ? 'disabled' : '' }}>
  <i class="fas fa-user-md me-2"></i>Need Advice From Doctor
</a>

                        </div>
                         <br><br>
                        <!-- Emergency Contact Section -->

                            <div class="d-flex align-items-start">
                                <i class="fas fa-exclamation-triangle fs_20 me-3 mt-1"></i>
                                <div>
                                    <h6 class="alert-heading fs_16 fw_bold">Important Medical Disclaimer</h6>
                                    <p class="mb-0 fs_14">
                                        This AI analysis is for informational purposes only and should not be used as a substitute for professional medical advice, diagnosis, or treatment. Always consult with qualified healthcare professionals for proper medical evaluation and treatment decisions.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Image Modal for Full View -->
                <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="imageModalLabel">OCT Scan - Full View</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <img src="{{ url('storage/' . session('image_path')) }}" alt="OCT Scan Full View" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>




<section><br><br></section>
@endsection

@push('css')
<style>
/* Upload Area Styles */
.upload-area {
    border: 2px dashed #007bff;
    border-radius: 10px;
    padding: 40px 20px;
    text-align: center;
    background: #f8f9fa;
    transition: all 0.3s ease;
    cursor: pointer;
    position: relative;
}

.upload-area:hover {
    border-color: #0056b3;
    background: #e3f2fd;
}

.upload-area.dragover {
    border-color: #28a745;
    background: #d4edda;
    transform: scale(1.02);
}

.upload-content {
    transition: all 0.3s ease;
}

.upload-area.dragover .upload-content {
    transform: translateY(-5px);
}

/* File Preview Styles */
.file-preview {
    border: 2px solid #28a745;
    border-radius: 10px;
    padding: 20px;
    background: #d4edda;
}

.preview-content {
    display: flex;
    align-items: center;
    gap: 20px;
}

.preview-img {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 8px;
    border: 2px solid #fff;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.file-details h5 {
    color: #155724;
    margin: 0;
}

/* Progress Bar */
.upload-progress .progress {
    height: 8px;
    border-radius: 10px;
    overflow: hidden;
}

/* Results Styling */
.prediction-results {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 5px 25px rgba(0,0,0,0.1);
}

.results-header {
    border-bottom: 1px solid #dee2e6;
    padding-bottom: 20px;
}

.result-icon {
    width: 70px;
    height: 70px;
    background: linear-gradient(135deg, #28a745, #20c997);
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: white;
}

.analysis-image {
    transition: transform 0.3s ease;
    border: 3px solid #fff;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.analysis-image:hover {
    transform: scale(1.05);
}

.prediction-badge .badge {
    font-size: 16px;
    padding: 12px 20px;
    border-radius: 25px;
    font-weight: 600;
    letter-spacing: 0.5px;
}

.card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
}

.recommendation-text {
    line-height: 1.6;
    font-size: 14px;
}

.recommendation-text ul {
    padding-left: 20px;
}

.recommendation-text li {
    margin-bottom: 8px;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .preview-content {
        flex-direction: column;
        text-align: center;
    }

    .prediction-results {
        padding: 20px;
    }

    .sec-title-two h2 {
        font-size: 28px;
    }
}

/* Animation for results appearance */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.prediction-results {
    animation: fadeInUp 0.6s ease-out;
}
</style>

@endpush

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const uploadArea = document.getElementById('uploadArea');
    const fileInput = document.getElementById('oct_image');
    const browseBtn = document.getElementById('browseBtn');
    const filePreview = document.getElementById('filePreview');
    const uploadContent = uploadArea.querySelector('.upload-content');
    const analyzeBtn = document.getElementById('analyzeBtn');
    const form = document.getElementById('octUploadForm');
    const uploadProgress = document.getElementById('uploadProgress');
    const removeFileBtn = document.getElementById('removeFile');

    // Drag and drop functionality
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, preventDefaults, false);
        document.body.addEventListener(eventName, preventDefaults, false);
    });

    ['dragenter', 'dragover'].forEach(eventName => {
        uploadArea.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, unhighlight, false);
    });

    uploadArea.addEventListener('drop', handleDrop, false);
    uploadArea.addEventListener('click', () => fileInput.click());
    browseBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        fileInput.click();
    });
    fileInput.addEventListener('change', handleFileSelect);
    removeFileBtn.addEventListener('click', removeFile);

    // Form submission with progress
    form.addEventListener('submit', function(e) {
        if (fileInput.files.length > 0) {
            showProgress();
        }
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    function highlight(e) {
        uploadArea.classList.add('dragover');
    }

    function unhighlight(e) {
        uploadArea.classList.remove('dragover');
    }

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        handleFiles(files);
    }

    function handleFileSelect(e) {
        const files = e.target.files;
        handleFiles(files);
    }

    function handleFiles(files) {
        if (files.length > 0) {
            const file = files[0];

            // Validate file type
            if (!file.type.match('image.*')) {
                showAlert('Please select a valid image file (JPEG, PNG, JPG)', 'error');
                return;
            }

            // Validate file size (10MB)
            if (file.size > 10 * 1024 * 1024) {
                showAlert('File size must be less than 10MB', 'error');
                return;
            }

            displayFilePreview(file);
            analyzeBtn.disabled = false;
        }
    }

    function displayFilePreview(file) {
        const reader = new FileReader();

        reader.onload = function(e) {
            document.getElementById('previewImage').src = e.target.result;
            document.getElementById('fileName').textContent = file.name;
            document.getElementById('fileSize').textContent = formatFileSize(file.size);

            uploadContent.style.display = 'none';
            filePreview.style.display = 'block';
            uploadArea.style.border = '2px solid #28a745';
            uploadArea.style.background = '#d4edda';
        };

        reader.readAsDataURL(file);
    }

    function removeFile() {
        fileInput.value = '';
        uploadContent.style.display = 'block';
        filePreview.style.display = 'none';
        uploadArea.style.border = '2px dashed #007bff';
        uploadArea.style.background = '#f8f9fa';
        analyzeBtn.disabled = true;
    }

    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    function showProgress() {
        uploadProgress.style.display = 'block';
        analyzeBtn.disabled = true;
        analyzeBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Analyzing...';

        // Simulate progress
        let progress = 0;
        const progressBar = uploadProgress.querySelector('.progress-bar');
        const interval = setInterval(() => {
            progress += Math.random() * 15;
            if (progress > 90) progress = 90;
            progressBar.style.width = progress + '%';

            if (progress >= 90) {
                clearInterval(interval);
            }
        }, 200);
    }

    function showAlert(message, type) {
        const alertClass = type === 'error' ? 'alert-danger' : 'alert-success';
        const icon = type === 'error' ? 'fas fa-exclamation-circle' : 'fas fa-check-circle';

        const alertDiv = document.createElement('div');
        alertDiv.className = `alert ${alertClass} alert-dismissible fade show`;
        alertDiv.innerHTML = `
            <i class="${icon} me-2"></i>
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        `;

        const form = document.querySelector('.oct-upload-form');
        form.insertBefore(alertDiv, form.firstChild);

        setTimeout(() => {
            alertDiv.remove();
        }, 5000);
    }
});

// Contact Doctor Modal and Functions
function contactDoctor() {
    // Create and show contact doctor modal
    const modalHtml = `
        <div class="modal fade" id="contactDoctorModal" tabindex="-1" aria-labelledby="contactDoctorModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="contactDoctorModalLabel">
                            <i class="fas fa-user-md me-2"></i>Contact a Doctor
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="card h-100 border-primary">
                                    <div class="card-body text-center">
                                        <i class="fas fa-video fs_36 text-primary mb-3"></i>
                                        <h6 class="fw_bold">Online Consultation</h6>
                                        <p class="fs_14 text-muted mb-3">Get expert advice from certified ophthalmologists through video call</p>
                                        <button class="btn btn-primary btn-sm" onclick="bookOnlineConsultation()">
                                            <i class="fas fa-calendar-plus me-1"></i>Book Now
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="card h-100 border-success">
                                    <div class="card-body text-center">
                                        <i class="fas fa-hospital fs_36 text-success mb-3"></i>
                                        <h6 class="fw_bold">Visit Hospital</h6>
                                        <p class="fs_14 text-muted mb-3">Schedule an in-person appointment at our partner hospitals</p>
                                        <button class="btn btn-success btn-sm" onclick="findNearbyHospital()">
                                            <i class="fas fa-map-marker-alt me-1"></i>Find Hospital
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="contact-options mt-4">
                            <h6 class="fw_bold mb-3">Quick Contact Options</h6>
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <div class="d-flex align-items-center p-3 bg-light rounded">
                                        <i class="fas fa-phone text-info fs_20 me-3"></i>
                                        <div>
                                            <small class="text-muted">Hotline</small>
                                            <div class="fw_bold">+94 11 234 5678</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <div class="d-flex align-items-center p-3 bg-light rounded">
                                        <i class="fas fa-envelope text-warning fs_20 me-3"></i>
                                        <div>
                                            <small class="text-muted">Email</small>
                                            <div class="fw_bold">doctors@eyecare.lk</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-info mt-4">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Your analysis results will be automatically shared with the consulting doctor to provide better care.</strong>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="sendResultsToDoctor()">
                            <i class="fas fa-share me-1"></i>Share Results & Contact
                        </button>
                    </div>
                </div>
            </div>
        </div>
    `;

    // Remove existing modal if any
    const existingModal = document.getElementById('contactDoctorModal');
    if (existingModal) {
        existingModal.remove();
    }

    // Add modal to DOM
    document.body.insertAdjacentHTML('beforeend', modalHtml);

    // Show modal
    const modal = new bootstrap.Modal(document.getElementById('contactDoctorModal'));
    modal.show();
}

function bookOnlineConsultation() {
    // You can integrate with your booking system here
    alert('Redirecting to online consultation booking system...');
    // window.location.href = '/book-consultation';
}

function findNearbyHospital() {
    // You can integrate with maps or hospital directory
    alert('Opening hospital directory...');
    // window.open('https://maps.google.com/search/eye+hospitals+near+me', '_blank');
}

function sendResultsToDoctor() {
    // Simulate sending results to doctor
    const loadingBtn = event.target;
    const originalText = loadingBtn.innerHTML;
    loadingBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Sending...';
    loadingBtn.disabled = true;

    setTimeout(() => {
        loadingBtn.innerHTML = '<i class="fas fa-check me-1"></i>Sent Successfully';
        loadingBtn.className = 'btn btn-success';

        setTimeout(() => {
            bootstrap.Modal.getInstance(document.getElementById('contactDoctorModal')).hide();
            showAlert('Your analysis results have been sent to our medical team. A doctor will contact you soon.', 'success');
        }, 1500);
    }, 2000);
}

function callEmergency() {
    if (confirm('This will attempt to call emergency services (1990). Do you want to proceed?')) {
        window.location.href = 'tel:1990';
    }
}
function downloadResults() {
    const results = {
        prediction: '{{ session("prediction") }}',
        recommendation: `{{ strip_tags(session("recommendation")) }}`,
        timestamp: new Date().toISOString(),
        disclaimer: 'This AI analysis is for informational purposes only and should not be used as a substitute for professional medical advice.'
    };

    const dataStr = "data:text/json;charset=utf-8," + encodeURIComponent(JSON.stringify(results, null, 2));
    const downloadAnchorNode = document.createElement('a');
    downloadAnchorNode.setAttribute("href", dataStr);
    downloadAnchorNode.setAttribute("download", `oct_analysis_${Date.now()}.json`);
    document.body.appendChild(downloadAnchorNode);
    downloadAnchorNode.click();
    downloadAnchorNode.remove();
}
document.getElementById('downloadReportForm')?.addEventListener('submit', function(e) {
    // Optional: Show a loading state
    const submitBtn = document.querySelector('#downloadReportForm button[type="submit"]');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Downloading...';
});

</script>

@endpush

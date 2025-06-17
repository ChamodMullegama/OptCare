@extends('DoctorArea.Layout.main')
@section('title', 'OCT Analysis Details')
@section('Doctorcontainer')

{{-- <div class="app-hero-header d-flex align-items-center">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <i class="ri-home-8-line lh-1 pe-3 me-3 border-end"></i>
            <a href="{{ route('oct.upload') }}">OCT Analysis</a>
        </li>
        <li class="breadcrumb-item text-primary" aria-current="page">

        </li>
    </ol>
</div> --}}

<div class="app-hero-header d-flex align-items-center">
    <!-- Breadcrumb starts -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <i class="ri-home-8-line lh-1 pe-3 me-3 border-end"></i>
            <a href="{{ route('doctor.dashboard') }}">Home</a>
        </li>
        <li class="breadcrumb-item text-primary" aria-current="page">
                 Analysis Details

        </li>
    </ol>
    <!-- Breadcrumb ends -->
</div>

<div class="app-body">
    <div class="row gx-3">
        <div class="col-xl-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="mb-3"><i class="fas fa-file-medical me-2"></i>Analysis Details</h5>
                    <div class="row gx-3">
                        <div class="col-12 mb-3">
                            <div class="card-header bg-light">
                                <h6 class="mb-0"><i class="fas fa-eye me-2"></i>{{ ucfirst($analysis->eye_side) }} Eye OCT Scan</h6>
                            </div>
                            <div class="card-body text-center">
                                <img src="{{ asset('storage/' . $analysis->image_path) }}"
                                     class="img-fluid rounded border"
                                     alt="{{ ucfirst($analysis->eye_side) }} Eye OCT Scan"
                                     style="max-height: 400px; max-width: 100%;">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                <h6 class="mb-0"><i class="fas fa-file-chart-line me-2"></i>{{ ucfirst($analysis->eye_side) }} Eye Analysis Details</h6>
                                <span class="badge bg-{{ $analysis->prediction == 'NORMAL' ? 'success' : 'danger' }} fs-6">
                                    {{ $analysis->prediction }}
                                </span>
                            </div>
                            <div class="card-body">
                                <div class="row gx-3">
                                    <div class="col-md-6">
                                        <p><strong>Patient ID:</strong> {{ $analysis->patient_id }}</p>
                                        <p><strong>Patient Name:</strong> {{ $analysis->patient_name }}</p>
                                        <p><strong>Patient Email:</strong> {{ $analysis->patient_email ?? 'N/A' }}</p>
                                        <p><strong>Patient Phone:</strong> {{ $analysis->patient_phone ?? 'N/A' }}</p>
                                        <p><strong>Patient Age:</strong> {{ $analysis->patient_age ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Eye Side:</strong> {{ ucfirst($analysis->eye_side) }} Eye</p>
                                        <p><strong>Clinical Notes:</strong> {{ $analysis->clinical_notes ?? 'N/A' }}</p>
                                        <p><strong>Doctor:</strong> {{ $analysis->doctor_name }} ({{ $analysis->doctor_id }})</p>
                                        <p><strong>Date:</strong> {{ $analysis->created_at->format('Y-m-d H:i:s') }}</p>
                                    </div>
                                </div>
                                <div class="recommendation-container bg-light p-3 rounded mt-3 shadow-sm">
                                    <h6 class="text-primary mb-2"><i class="fas fa-stethoscope me-2"></i>Clinical Recommendation</h6>
                                    <div class="recommendation-content">{!! $analysis->recommendation !!}</div>
                                </div>
                                <div class="d-flex gap-2 mt-3">
                                    <a href="{{ url()->previous() }}" class="btn btn-outline-dark btn-sm">
    <i class="fas fa-arrow-left me-1"></i> Back
</a>

                                    <a href="{{ route('oct.download', $analysis->id) }}"  class="btn btn-outline-warning btn-sm">
                                        <i class="fas fa-download me-1"></i> Download PDF
                                    </a>
                                    <button class="btn btn-outline-danger btn-sm" onclick="confirmDelete('{{ $analysis->id }}')">
                                        <i class="fas fa-trash me-1"></i> Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteOctModal" tabindex="-1" aria-labelledby="deleteOctModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteOctModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div class="mb-2">
                    <img src="{{ asset('AdminArea/images/bin.gif') }}" alt="Delete Confirmation" width="80">
                </div>
                <h5>Are you sure you want to delete this OCT analysis?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" onclick="submitDeleteForm()">Delete</button>
            </div>
            <form id="deleteOctForm" method="POST">
                @csrf
                @method('DELETE')
                <input type="hidden" id="id" name="id">
            </form>
        </div>
    </div>
</div>

@endsection

@push('css')
<style>
.custom-tabs-container .nav-tabs .nav-link {
    border-radius: 8px 8px 0 0;
    margin-right: 2px;
    transition: all 0.3s ease;
}
.custom-tabs-container .nav-tabs .nav-link.active {
    background-color: #007bff;
    color: white;
    border-color: #007bff;
}
.recommendation-container {
    background: #f9fafb;
    border-left: 4px solid #007bff;
    border-radius: 6px;
    transition: all 0.3s ease;
}
.recommendation-container:hover {
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}
.recommendation-content h3 {
    font-size: 1rem;
    color: #1e40af;
}
.recommendation-content h4 {
    font-size: 0.9rem;
    color: #1e40af;
    margin-top: 1rem;
}
.recommendation-content ul {
    font-size: 0.85rem;
    color: #4b5563;
    padding-left: 1.5rem;
}
.table-hover tbody tr:hover {
    background-color: rgba(0, 123, 255, 0.05);
}
.badge {
    font-weight: 500;
    padding: 0.4em 0.8em;
}
.form-control:focus, .form-select:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}
.card {
    margin-bottom: 1rem;
    border-radius: 8px;
}
.card-body {
    padding: 1.5rem;
}
.card img {
    object-fit: contain;
    border-radius: 6px;
}
</style>
@endpush

@push('js')
<script>
function confirmDelete(id) {
    document.getElementById('id').value = id;
    const modal = new bootstrap.Modal(document.getElementById('deleteOctModal'));
    modal.show();
}

function submitDeleteForm() {
    const id = document.getElementById('id').value;
    const form = document.getElementById('deleteOctForm');
    form.action = `/oct-analysis/delete/${id}`;
    form.submit();
}
</script>
@endpush

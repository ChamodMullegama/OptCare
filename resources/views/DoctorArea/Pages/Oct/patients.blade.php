@extends('DoctorArea.Layout.main')
@section('title', 'Patients')
@section('Doctorcontainer')

<div class="app-hero-header d-flex align-items-center">
    <!-- Breadcrumb starts -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <i class="ri-home-8-line lh-1 pe-3 me-3 border-end"></i>
            <a href="index.html">Home</a>
        </li>
        <li class="breadcrumb-item text-primary" aria-current="page">
            Patients
        </li>
    </ol>
    <!-- Breadcrumb ends -->
</div>

<div class="app-body">
    <div class="row gx-3">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title">Patient List</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basicExample" class="table truncate m-0 align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Patient ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($patients as $patient)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $patient->patient_id }}</td>
                                    <td>{{ $patient->patient_name }}</td>
                                    <td>{{ $patient->patient_email ?? 'N/A' }}</td>
                                    <td>
                                        <div class="d-inline-flex gap-1">
                                            <a href="{{ route('oct.upload', ['patient_id' => $patient->patient_id]) }}"
                                               class="btn btn-outline-primary btn-sm" title="New Analysis">
                                                <i class="ri-add-line"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Pagination -->
                    {{ $patients->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')

@endpush

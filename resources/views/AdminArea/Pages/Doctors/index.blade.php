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
            Doctors Management
        </li>
    </ol>
    <!-- Breadcrumb ends -->
</div>

<div class="app-body">
    <div class="row gx-3">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title">Doctors List</h5>
                    <a href="{{ route('doctors.addPage') }}" class="btn btn-primary ms-auto">
                        Add New Doctor
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basicExample" class="table truncate m-0 align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>specialists</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($doctors as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->doctorId }}</td>
                                    <td>
 @if ($item->profile_image)
                                            <img src="{{ asset('storage/' . $item->profile_image) }}" class="img-shadow img-2x rounded-5 me-1" alt="Doctor Image">
                                        @else
                                            No Image
                                        @endif
                                        {{ $item->first_name }} {{ $item->last_name }}
                                    </td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->mobile_number }}</td>
                                    <td>{{ $item->designation }}</td>

                                    <td>
                                        <div class="d-inline-flex gap-1">
                                            <button class="btn btn-outline-danger btn-sm"
                                                onclick="confirmDelete('{{ $item->id }}')">
                                                <i class="ri-delete-bin-line"></i>
                                            </button>
                                            <a href="{{ route('doctors.editPage', $item->id) }}" class="btn btn-outline-success btn-sm">
                                                <i class="ri-edit-box-line"></i>
                                            </a>
                                            <a href="{{ route('doctors.profile', $item->id) }}" class="btn btn-outline-info btn-sm">
            <i class="ri-eye-line"></i>
        </a>
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

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteDoctorModal" tabindex="-1" aria-labelledby="deleteDoctorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="deleteDoctorForm" action="{{ route('doctors.delete') }}" method="POST">
                @csrf
                <input type="hidden" id="doctorId" name="id">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteDoctorModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <div class="mb-2">
                        <img src="{{ asset('AdminArea/images/bin.gif') }}" alt="Delete Confirmation" width="80">
                    </div>
                    <h5>Are you sure you want to delete this doctor?</h5>
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
function confirmDelete(doctorId) {
    document.getElementById('doctorId').value = doctorId;
    $('#deleteDoctorModal').modal('show');
}
</script>
@endpush

@extends('AdminArea.Layout.main')
@section('Admincontainer')

<div class="app-hero-header d-flex align-items-center">
    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <i class="ri-home-8-line lh-1 pe-3 me-3 border-end"></i>
            <a href="{{ route('admin.dashboard') }}">Home</a>
        </li>
        <li class="breadcrumb-item text-primary" aria-current="page">
            Patient Management
        </li>
    </ol>
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
                        <table id="basicExample" class="table table-bordered align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Patient ID</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Gender</th>
                                    <th>Verified</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $customer)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $customer->id }}</td>
                                    <td>{{ $customer->first_name }} {{ $customer->last_name }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->phone }}</td>
                                    <td>{{ ucfirst($customer->gender) }}</td>
                                    <td>
                                        @if($customer->verified_account)
                                            <span class="badge bg-success">Yes</span>
                                        @else
                                            <span class="badge bg-secondary">No</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-outline-info btn-sm"
                                                onclick="viewCustomer(
                                                    '{{ $customer->first_name }}',
                                                    '{{ $customer->last_name }}',
                                                    '{{ $customer->email }}',
                                                    '{{ $customer->phone }}',
                                                    '{{ $customer->gender }}',
                                                    '{{ $customer->birth_date }}',
                                                    '{{ $customer->age }}',
                                                    '{{ $customer->verified_account ? 'Yes' : 'No' }}'
                                                )">
                                            <i class="ri-eye-line"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> <!-- .table-responsive -->
                </div> <!-- .card-body -->
            </div> <!-- .card -->
        </div>
    </div>
</div>

<!-- Customer Details Modal -->
<div class="modal fade" id="customerDetailsModal" tabindex="-1" aria-labelledby="customerDetailsLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Patient Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">First Name</label>
                        <input type="text" class="form-control" id="modal_first_name" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="modal_last_name" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" id="modal_email" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control" id="modal_phone" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gender</label>
                        <input type="text" class="form-control" id="modal_gender" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Birth Date</label>
                        <input type="text" class="form-control" id="modal_birth_date" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Age</label>
                        <input type="text" class="form-control" id="modal_age" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Verified Account</label>
                        <input type="text" class="form-control" id="modal_verified" readonly>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script>
    function calculateAge(birthDate) {
        const birth = new Date(birthDate);
        const today = new Date();
        let age = today.getFullYear() - birth.getFullYear();
        const m = today.getMonth() - birth.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birth.getDate())) {
            age--;
        }
        return age;
    }

  function viewCustomer(first, last, email, phone, gender, birth, _unusedAge, verified) {
    document.getElementById('modal_first_name').value = first;
    document.getElementById('modal_last_name').value = last;
    document.getElementById('modal_email').value = email;
    document.getElementById('modal_phone').value = phone;
    document.getElementById('modal_gender').value = gender;
    document.getElementById('modal_birth_date').value = birth;

    const calculatedAge = birth ? calculateAge(birth) : 'N/A';
    document.getElementById('modal_age').value = calculatedAge;

    document.getElementById('modal_verified').value = verified;

    $('#customerDetailsModal').modal('show');
}
</script>
@endpush



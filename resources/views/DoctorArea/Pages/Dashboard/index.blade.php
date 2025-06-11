@extends('DoctorArea.Layout.main')

@section('Admincontainer')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Doctor Dashboard</h3>
                </div>
                <div class="card-body">
                    <h4>Welcome, {{ Auth::guard('doctor')->user()->first_name }} {{ Auth::guard('doctor')->user()->last_name }}</h4>
                    <p>This is your dashboard where you can manage your appointments and patient information.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

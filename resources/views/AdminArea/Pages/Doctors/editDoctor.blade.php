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
            Edit Doctor
        </li>
    </ol>
    <!-- Breadcrumb ends -->
</div>

<div class="app-body">
    <div class="row gx-3">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <!-- Custom tabs starts -->
                    <div class="custom-tabs-container">
                        <!-- Nav tabs starts -->
                        <ul class="nav nav-tabs" id="customTab2" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="tab-oneA" data-bs-toggle="tab" href="#oneA" role="tab"
                                    aria-controls="oneA" aria-selected="true"><i class="ri-briefcase-4-line"></i> Personal Details</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="tab-twoA" data-bs-toggle="tab" href="#twoA" role="tab"
                                    aria-controls="twoA" aria-selected="false"><i class="ri-account-pin-circle-line"></i> Profile and Bio</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="tab-threeA" data-bs-toggle="tab" href="#threeA" role="tab"
                                    aria-controls="threeA" aria-selected="false"><i class="ri-calendar-check-line"></i> Availability</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="tab-fourA" data-bs-toggle="tab" href="#fourA" role="tab"
                                    aria-controls="fourA" aria-selected="false"><i class="ri-lock-password-line"></i> Account Details</a>
                            </li>
                        </ul>
                        <!-- Nav tabs ends -->

                        <!-- Tab content starts -->
                        <form id="editDoctorForm" action="{{ route('doctors.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $doctor->id }}">
                            <div class="tab-content h-350">
                                <div class="tab-pane fade show active" id="oneA" role="tabpanel">
                                    <!-- Row starts -->
                                    <div class="row gx-3">
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="first_name">First Name <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="ri-account-circle-line"></i>
                                                    </span>
                                                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name" value="{{ $doctor->first_name }}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="last_name">Last Name <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="ri-account-circle-line"></i>
                                                    </span>
                                                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name" value="{{ $doctor->last_name }}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="age">Age <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                      <i class="ri-user-line"></i>

                                                    </span>
                                                    <select class="form-select" id="age" name="age" required>
                                                        <option value="">Select Age</option>
                                                        @for ($i = 25; $i <= 80; $i++)
                                                            <option value="{{ $i }}" {{ $doctor->age == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="gender">Gender <span class="text-danger">*</span></label>
                                                <div class="m-0">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="gender" id="gender_male" value="male" {{ $doctor->gender == 'male' ? 'checked' : '' }} required>
                                                        <label class="form-check-label" for="gender_male">Male</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="gender" id="gender_female" value="female" {{ $doctor->gender == 'female' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="gender_female">Female</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="doctorId">Create ID <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="ri-secure-payment-line"></i>
                                                    </span>
                                                    <input type="text" class="form-control" id="doctorId" name="doctorId" value="{{ $doctor->doctorId }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="email">Email ID <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="ri-mail-open-line"></i>
                                                    </span>
                                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email ID" value="{{ $doctor->email }}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="mobile_number">Mobile Number <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="ri-phone-line"></i>
                                                    </span>
                                                    <input type="text" class="form-control" id="mobile_number" name="mobile_number" placeholder="Enter Mobile Number" value="{{ $doctor->mobile_number }}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="marital_status">Marital Status</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="ri-vip-crown-2-line"></i>
                                                    </span>
                                                    <select class="form-select" id="marital_status" name="marital_status">
                                                        <option value="">Select</option>
                                                        <option value="married" {{ $doctor->marital_status == 'married' ? 'selected' : '' }}>Married</option>
                                                        <option value="unmarried" {{ $doctor->marital_status == 'unmarried' ? 'selected' : '' }}>Unmarried</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="qualification">Qualification</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="ri-copper-diamond-line"></i>
                                                    </span>
                                                    <select class="form-select" id="qualification" name="qualification">
                                                        <option value="">Select</option>
                                                        <option value="MBBS, MD" {{ $doctor->qualification == 'MBBS, MD' ? 'selected' : '' }}>MBBS, MD</option>
                                                        <option value="MBBS, MS" {{ $doctor->qualification == 'MBBS, MS' ? 'selected' : '' }}>MBBS, MS</option>
                                                        <option value="MBBS" {{ $doctor->qualification == 'MBBS' ? 'selected' : '' }}>MBBS</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="designation">specialists</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="ri-nft-line"></i>
                                                    </span>
                                                    <select class="form-select" id="designation" name="designation">
                                                        <option value="">Select</option>
                                                        <option value="General Ophthalmologist" {{ $doctor->designation == 'General Ophthalmologist' ? 'selected' : '' }}>General Ophthalmologist</option>
                                                        <option value="Pediatric Ophthalmologist" {{ $doctor->designation == 'Pediatric Ophthalmologist' ? 'selected' : '' }}>Pediatric Ophthalmologist</option>
                                                        <option value="Retina Specialist" {{ $doctor->designation == 'Retina Specialist' ? 'selected' : '' }}>Retina Specialist</option>
                                                        <option value="Cornea Specialist" {{ $doctor->designation == 'Cornea Specialist' ? 'selected' : '' }}>Cornea Specialist</option>
                                                        <option value="Glaucoma Specialist" {{ $doctor->designation == 'Glaucoma Specialist' ? 'selected' : '' }}>Glaucoma Specialist</option>
                                                        <option value="Neuro-Ophthalmologist" {{ $doctor->designation == 'Neuro-Ophthalmologist' ? 'selected' : '' }}>Neuro-Ophthalmologist</option>
                                                        <option value="Oculoplastic Surgeon" {{ $doctor->designation == 'Oculoplastic Surgeon' ? 'selected' : '' }}>Oculoplastic Surgeon</option>
                                                        <option value="Uveitis Specialist" {{ $doctor->designation == 'Uveitis Specialist' ? 'selected' : '' }}>Uveitis Specialist</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="blood_group">Experience <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="ri-drop-line"></i>
                                                    </span>
                                                     <input type="number" class="form-control" id="blood_group" name="blood_group" required placeholder="Enter Experience" value="{{ $doctor->blood_group }}">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="address">Address</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="ri-projector-line"></i>
                                                    </span>
                                                    <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address" value="{{ $doctor->address }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="country">Country</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="ri-flag-line"></i>
                                                    </span>
                                                    <select class="form-select" id="country" name="country">

    <option value="">Select</option>
    <option value="Sri Lanka" {{ $doctor->country == 'Sri Lanka' ? 'selected' : '' }}>Sri Lanka</option>
    <option value="India" {{ $doctor->country == 'India' ? 'selected' : '' }}>India</option>
    <option value="China" {{ $doctor->country == 'China' ? 'selected' : '' }}>China</option>
    <option value="Japan" {{ $doctor->country == 'Japan' ? 'selected' : '' }}>Japan</option>
    <option value="South Korea" {{ $doctor->country == 'South Korea' ? 'selected' : '' }}>South Korea</option>
    <option value="Thailand" {{ $doctor->country == 'Thailand' ? 'selected' : '' }}>Thailand</option>
    <option value="Malaysia" {{ $doctor->country == 'Malaysia' ? 'selected' : '' }}>Malaysia</option>
    <option value="Singapore" {{ $doctor->country == 'Singapore' ? 'selected' : '' }}>Singapore</option>
    <option value="USA" {{ $doctor->country == 'USA' ? 'selected' : '' }}>USA</option>
    <option value="Canada" {{ $doctor->country == 'Canada' ? 'selected' : '' }}>Canada</option>
    <option value="Brazil" {{ $doctor->country == 'Brazil' ? 'selected' : '' }}>Brazil</option>


                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="state">State</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="ri-instance-line"></i>
                                                    </span>
                                                       <input type="text" class="form-control" id="state" name="state" placeholder="Enter state" value="{{ $doctor->state}}">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="city">City</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="ri-scan-line"></i>
                                                    </span>
                                                    <input type="text" class="form-control" id="city" name="city" placeholder="Enter City" value="{{ $doctor->city }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="postal_code">Postal Code</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="ri-qr-scan-line"></i>
                                                    </span>
                                                    <input type="text" class="form-control" id="postal_code" name="postal_code" placeholder="Enter Postal Code" value="{{ $doctor->postal_code }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Row ends -->
                                </div>
                                <div class="tab-pane fade" id="twoA" role="tabpanel">
                                    <!-- Row starts -->
                                    <div class="row gx-3">
                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="profile_image">Upload Profile Image</label>
                                                <input type="file" class="form-control" id="profile_image" name="profile_image" accept="image/*">
                                                @if ($doctor->profile_image)
                                                    <div class="mt-2">
                                                        <img src="{{ asset('storage/' . $doctor->profile_image) }}" class="img-shadow img-2x rounded-5 me-1" alt="Doctor Image">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <label class="form-label">Write Bio</label>
                                            <div id="fullEditorbioedit" style="min-height: 75px;"></div>
                                            <textarea class="form-control d-none" id="bio" name="bio" rows="10">{{ $doctor->bio }}</textarea>
                                        </div>
                                    </div>
                                    <!-- Row ends -->
                                </div>
                              <!-- resources/views/AdminArea/Pages/Doctors/edit.blade.php (partial update for #threeA tab) -->
<div class="tab-pane fade" id="threeA" role="tabpanel">
    <!-- Row starts -->
    <div class="row gx-3">
        @php
            $availability = $doctor->availability ?? [];
        @endphp
        @foreach (['sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat'] as $day)
            <div class="col-xxl-3 col-lg-4 col-sm-6">
                <div class="mb-3">
                    <label class="form-label" for="{{ $day }}_from">{{ ucfirst($day) }}</label>
                    <div class="input-group">
                        <select class="form-select" id="{{ $day }}_from" name="availability[{{ $day }}][from]">
                            <option value="">From</option>
                            @foreach (['7AM', '8AM', '9AM', '10AM', '11AM', '12PM'] as $time)
                                <option value="{{ $time }}" {{ isset($availability[$day]['from']) && $availability[$day]['from'] == $time ? 'selected' : '' }}>{{ $time }}</option>
                            @endforeach
                        </select>
                        <select class="form-select" id="{{ $day }}_to" name="availability[{{ $day }}][to]">
                            <option value="">To</option>
                            @foreach (['1PM', '2PM', '3PM', '4PM', '5PM', '6PM'] as $time)
                                <option value="{{ $time }}" {{ isset($availability[$day]['to']) && $availability[$day]['to'] == $time ? 'selected' : '' }}>{{ $time }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!-- Row ends -->
</div>
                                <div class="tab-pane fade" id="fourA" role="tabpanel">
                                    <!-- Row starts -->
                                    <div class="row gx-3">
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="username">User Name</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="ri-account-pin-circle-line"></i>
                                                    </span>
                                                    <input type="text" id="username" name="username" placeholder="Enter username" class="form-control" value="{{ $doctor->username }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="password">Password</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="ri-lock-password-line"></i>
                                                    </span>
                                                    <input type="password" id="password" name="password" class="form-control" placeholder="Leave blank to keep unchanged">
                                                    <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password')">
                                                        <i class="ri-eye-line"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="password_confirmation">Confirm Password</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="ri-lock-password-line"></i>
                                                    </span>
                                                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm new password" class="form-control">
                                                    <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password_confirmation')">
                                                        <i class="ri-eye-off-line"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Row ends -->
                                </div>
                            </div>
                            <!-- Tab content ends -->

                            <!-- Card actions starts -->
                            <div class="d-flex gap-2 justify-content-end mt-4">
                                <a href="{{ route('doctors.all') }}" class="btn btn-outline-secondary">
                                    Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    Update Doctor Profile
                                </button>
                            </div>
                            <!-- Card actions ends -->
                        </form>
                    </div>
                    <!-- Custom tabs ends -->
                </div>
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
// Initialize Quill editor
let editor = null;

function initializeQuillEditor() {
    if (!editor) {
        editor = new Quill('#fullEditorbioedit', {
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
            placeholder: 'Write your bio here...'
        });

        // Sync Quill editor content with textarea
        editor.on('text-change', function() {
            document.getElementById('bio').value = editor.root.innerHTML;
        });
    }
}

// Initialize editor when the page loads
document.addEventListener('DOMContentLoaded', function() {
    initializeQuillEditor();
    editor.root.innerHTML = document.getElementById('bio').value;
});

// Reset Quill content when tab is shown
$('#twoA').on('shown.bs.tab', function () {
    if (!editor) {
        initializeQuillEditor();
    }
});

// Toggle password visibility
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const icon = field.nextElementSibling.querySelector('i');
    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.remove('ri-eye-line');
        icon.classList.add('ri-eye-off-line');
    } else {
        field.type = 'password';
        icon.classList.remove('ri-eye-off-line');
        icon.classList.add('ri-eye-line');
    }
}
</script>
@endpush

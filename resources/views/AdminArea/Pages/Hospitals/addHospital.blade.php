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
            Add Hospital
        </li>
    </ol>
    <!-- Breadcrumb ends -->
</div>

<div class="app-body">
    <div class="row gx-3">
        <div class="col-xl-12">
         <div class="card" style="height: 600px;">

                <div class="card-body">
                    <!-- Custom tabs starts -->
                    <div class="custom-tabs-container">
                        <!-- Nav tabs starts -->
                        <ul class="nav nav-tabs" id="customTab2" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="tab-oneA" data-bs-toggle="tab" href="#oneA" role="tab" aria-controls="oneA" aria-selected="true">
                                    <i class="ri-briefcase-4-line"></i> Hospital Data
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="tab-twoA" data-bs-toggle="tab" href="#twoA" role="tab" aria-controls="twoA" aria-selected="false">
                                    <i class="ri-account-pin-circle-line"></i> Image and Bio
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="tab-threeA" data-bs-toggle="tab" href="#threeA" role="tab" aria-controls="threeA" aria-selected="false">
                                    <i class="ri-calendar-check-line"></i> Clinic Data and Time
                                </a>
                            </li>
                        </ul>
                        <!-- Nav tabs ends -->

                        <!-- Tab content starts -->
                        <form id="addHospitalForm" action="{{ route('eye.hospitals.add') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="tab-content h-350">
                                <div class="tab-pane fade show active" id="oneA" role="tabpanel">
                                    <!-- Row starts -->
                                    <div class="row gx-3">
                                        <div class="col-xxl-6 col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="hospital_name">Hospital Name <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="ri-hospital-line"></i></span>
                                                    <input type="text" class="form-control" id="hospital_name" name="hospital_name" placeholder="Enter Hospital Name" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-6 col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="address">Address <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="ri-map-pin-line"></i></span>
                                                    <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-6 col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="location">Location <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="ri-map-line"></i></span>
                                                    <input type="text" class="form-control" id="location" name="location" placeholder="Enter Location" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-6 col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="contact_number">Contact Number <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="ri-phone-line"></i></span>
                                                    <input type="text" class="form-control" id="contact_number" name="contact_number" placeholder="Enter Contact Number" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-6 col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="whatsapp">WhatsApp</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="ri-whatsapp-line"></i></span>
                                                    <input type="url" class="form-control" id="whatsapp" name="social_media_links[whatsapp]" placeholder="Enter WhatsApp Link">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-6 col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="instagram">Instagram</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="ri-instagram-line"></i></span>
                                                    <input type="url" class="form-control" id="instagram" name="social_media_links[instagram]" placeholder="Enter Instagram Link">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-6 col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="linkedin">LinkedIn</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="ri-linkedin-box-line"></i></span>
                                                    <input type="url" class="form-control" id="linkedin" name="social_media_links[linkedin]" placeholder="Enter LinkedIn Link">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-6 col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="facebook">Facebook</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="ri-facebook-circle-line"></i></span>
                                                    <input type="url" class="form-control" id="facebook" name="social_media_links[facebook]" placeholder="Enter Facebook Link">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-6 col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="x">X</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="ri-twitter-x-line"></i></span>
                                                    <input type="url" class="form-control" id="x" name="social_media_links[x]" placeholder="Enter X Link">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-6 col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="website_link">Website Link</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="ri-global-line"></i></span>
                                                    <input type="url" class="form-control" id="website_link" name="website_link" placeholder="Enter Website Link">
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
                                                <label class="form-label" for="image">Upload Hospital Image</label>
                                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                            </div>
                                        </div>
                                     <div class="col-sm-12">
    <label class="form-label">Write Bio</label>
    <div id="fullEditorbio" style="min-height:30px; margin-bottom: 20px;"></div>
    <textarea class="form-control d-none" id="bio" name="bio" rows="5"></textarea>
</div>

<div class="col-sm-12">
    <label class="form-label">Write Description</label>
    <div id="fullEditorDesc" style="min-height:30px; margin-bottom: 20px;"></div>
    <textarea class="form-control d-none" id="description" name="description" rows="5"></textarea>
</div>

                                    </div>
                                    <!-- Row ends -->
                                </div>
                                <div class="tab-pane fade" id="threeA" role="tabpanel">
                                    <!-- Row starts -->
                                    <div class="row gx-3">
                                        @foreach (['sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat'] as $day)
                                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="{{ $day }}_from">{{ ucfirst($day) }}</label>
                                                    <div class="input-group">
                                                        <select class="form-select" id="{{ $day }}_from" name="clinic_days[{{ $day }}][from]">
                                                            <option value="">From</option>
                                                            @foreach (['7AM', '8AM', '9AM', '10AM', '11AM', '12PM'] as $time)
                                                                <option value="{{ $time }}">{{ $time }}</option>
                                                            @endforeach
                                                        </select>
                                                        <select class="form-select" id="{{ $day }}_to" name="clinic_days[{{ $day }}][to]">
                                                            <option value="">To</option>
                                                            @foreach (['1PM', '2PM', '3PM', '4PM', '5PM', '6PM'] as $time)
                                                                <option value="{{ $time }}">{{ $time }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <!-- Row ends -->
                                </div>
                            </div>
                            <!-- Tab content ends -->
<br><br>
                            <!-- Card actions starts -->
                            <div class="d-flex gap-2 justify-content-end mt-4">
                                <a href="{{ route('eye.hospitals.all') }}" class="btn btn-outline-secondary">
                                    Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    Add Hospital
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
let bioEditor = null;
let descEditor = null;

function initializeQuillEditors() {
    if (!bioEditor) {
        bioEditor = new Quill('#fullEditorbio', {
            theme: 'snow',
            modules: { toolbar: [['bold', 'italic', 'underline', 'link'], ['clean']] },

        });
        bioEditor.on('text-change', () => document.getElementById('bio').value = bioEditor.root.innerHTML);
    }
    if (!descEditor) {
        descEditor = new Quill('#fullEditorDesc', {
            theme: 'snow',
            modules: { toolbar: [['bold', 'italic', 'underline', 'link'], ['clean']] },

        });
        descEditor.on('text-change', () => document.getElementById('description').value = descEditor.root.innerHTML);
    }
}

document.addEventListener('DOMContentLoaded', initializeQuillEditors);
</script>
@endpush

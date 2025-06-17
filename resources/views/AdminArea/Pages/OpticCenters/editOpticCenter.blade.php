@extends('AdminArea.Layout.main')

@section('Admincontainer')
<div class="app-hero-header d-flex align-items-center">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <i class="ri-home-8-line lh-1 pe-3 me-3 border-end"></i>
            <a href="index.html">Home</a>
        </li>
        <li class="breadcrumb-item text-primary" aria-current="page">
            Edit Optic Center
        </li>
    </ol>
</div>

<div class="app-body">
    <div class="row gx-3">
        <div class="col-xl-12">
            <div class="card" style="height: 600px;">
                <div class="card-body">
                    <div class="custom-tabs-container">
                        <ul class="nav nav-tabs" id="customTab2" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="tab-oneA" data-bs-toggle="tab" href="#oneA" role="tab" aria-controls="oneA" aria-selected="true">
                                    <i class="ri-briefcase-4-line"></i> Optic Center Data
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="tab-twoA" data-bs-toggle="tab" href="#twoA" role="tab" aria-controls="twoA" aria-selected="false">
                                    <i class="ri-account-pin-circle-line"></i> Image and Bio
                                </a>
                            </li>
                        </ul>
                        <form id="editOpticCenterForm" action="{{ route('optic.centers.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="id" value="{{ $opticCenter->id }}">
                            <div class="tab-content h-350">
                                <div class="tab-pane fade show active" id="oneA" role="tabpanel">
                                    <div class="row gx-3">
                                        <div class="col-xxl-6 col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="hospital_name">Optic Center Name <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="ri-hospital-line"></i></span>
                                                    <input type="text" class="form-control" id="hospital_name" name="hospital_name" value="{{ old('hospital_name', $opticCenter->hospital_name) }}" placeholder="Enter Optic Center Name" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-6 col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="address">Address <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="ri-map-pin-line"></i></span>
                                                    <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $opticCenter->address) }}" placeholder="Enter Address" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-6 col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="location">Location <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="ri-map-line"></i></span>
                                                    <input type="text" class="form-control" id="location" name="location" value="{{ old('location', $opticCenter->location) }}" placeholder="Search Location" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-6 col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="latitude">Latitude <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="latitude" name="latitude" value="{{ old('latitude', $opticCenter->latitude) }}" placeholder="Latitude" readonly required>
                                            </div>
                                        </div>
                                        <div class="col-xxl-6 col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="longitude">Longitude <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="longitude" name="longitude" value="{{ old('longitude', $opticCenter->longitude) }}" placeholder="Longitude" readonly required>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label">Map</label>
                                                <div id="map" style="height: 400px; width: 100%;"></div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-6 col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="contact_number">Contact Number <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="ri-phone-line"></i></span>
                                                    <input type="text" class="form-control" id="contact_number" name="contact_number" value="{{ old('contact_number', $opticCenter->contact_number) }}" placeholder="Enter Contact Number" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-6 col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="ri-mail-line"></i></span>
                                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $opticCenter->email) }}" placeholder="Enter Email" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-6 col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="whatsapp">WhatsApp</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="ri-whatsapp-line"></i></span>
                                                    <input type="url" class="form-control" id="whatsapp" name="social_media_links[whatsapp]" value="{{ old('social_media_links.whatsapp', $opticCenter->social_media_links['whatsapp'] ?? '') }}" placeholder="Enter WhatsApp Link">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-6 col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="instagram">Instagram</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="ri-instagram-line"></i></span>
                                                    <input type="url" class="form-control" id="instagram" name="social_media_links[instagram]" value="{{ old('social_media_links.instagram', $opticCenter->social_media_links['instagram'] ?? '') }}" placeholder="Enter Instagram Link">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-6 col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="linkedin">LinkedIn</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="ri-linkedin-box-line"></i></span>
                                                    <input type="url" class="form-control" id="linkedin" name="social_media_links[linkedin]" value="{{ old('social_media_links.linkedin', $opticCenter->social_media_links['linkedin'] ?? '') }}" placeholder="Enter LinkedIn Link">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-6 col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="facebook">Facebook</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="ri-facebook-circle-line"></i></span>
                                                    <input type="url" class="form-control" id="facebook" name="social_media_links[facebook]" value="{{ old('social_media_links.facebook', $opticCenter->social_media_links['facebook'] ?? '') }}" placeholder="Enter Facebook Link">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-6 col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="x">X</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="ri-twitter-x-line"></i></span>
                                                    <input type="url" class="form-control" id="x" name="social_media_links[x]" value="{{ old('social_media_links.x', $opticCenter->social_media_links['x'] ?? '') }}" placeholder="Enter X Link">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-6 col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="website_link">Website Link</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="ri-global-line"></i></span>
                                                    <input type="url" class="form-control" id="website_link" name="website_link" value="{{ old('website_link', $opticCenter->website_link) }}" placeholder="Enter Website Link">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-6 col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="open_days">Open Days</label>
                                                <input type="text" class="form-control" id="open_days" name="open_days" value="{{ old('open_days', $opticCenter->open_days) }}" placeholder="e.g., Weekdays, Weekends">
                                            </div>
                                        </div>
                                        <div class="col-xxl-6 col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="open_time">Open Time</label>
                                                <input type="time" class="form-control" id="open_time" name="open_time" value="{{ old('open_time', $opticCenter->open_time) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="twoA" role="tabpanel">
                                    <div class="row gx-3">
                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="image">Upload Optic Center Image</label>
                                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <label class="form-label">Write Bio</label>
                                            <div id="fullEditorbio" style="min-height: 30px; margin-bottom: 20px;">{!! old('bio', $opticCenter->bio) !!}</div>
                                            <textarea class="form-control d-none" id="bio" name="bio" rows="5">{!! old('bio', $opticCenter->bio) !!}</textarea>
                                        </div>
                                        <div class="col-sm-12">
                                            <label class="form-label">Write Description</label>
                                            <div id="fullEditorDesc" style="min-height: 30px; margin-bottom: 20px;">{!! old('description', $opticCenter->description) !!}</div>
                                            <textarea class="form-control d-none" id="description" name="description" rows="5">{!! old('description', $opticCenter->description) !!}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br><br>
                            <div class="d-flex gap-2 justify-content-end mt-4">
                                <a href="{{ route('optic.centers.all') }}" class="btn btn-outline-secondary">
                                    Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    Update Optic Center
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<style>
    #map {
        height: 400px;
        width: 100%;
        border: 1px solid #ddd;
        border-radius: 10px;
        overflow: hidden;
    }
</style>
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
        bioEditor.root.innerHTML = document.getElementById('bio').value;
        bioEditor.on('text-change', () => document.getElementById('bio').value = bioEditor.root.innerHTML);
    }
    if (!descEditor) {
        descEditor = new Quill('#fullEditorDesc', {
            theme: 'snow',
            modules: { toolbar: [['bold', 'italic', 'underline', 'link'], ['clean']] },
        });
        descEditor.root.innerHTML = document.getElementById('description').value;
        descEditor.on('text-change', () => document.getElementById('description').value = descEditor.root.innerHTML);
    }
}

function initMap() {
    var defaultLocation = { lat: {{ $opticCenter->latitude ?: 20.5937 }}, lng: {{ $opticCenter->longitude ?: 78.9629 }} };
    var map = new google.maps.Map(document.getElementById("map"), {
        zoom: 12,
        center: defaultLocation
    });

    var marker = new google.maps.Marker({
        position: defaultLocation,
        map: map,
        draggable: true
    });

    google.maps.event.addListener(marker, 'dragend', function(event) {
        document.getElementById("latitude").value = event.latLng.lat();
        document.getElementById("longitude").value = event.latLng.lng();
        document.getElementById("location").value = `${event.latLng.lat()}, ${event.latLng.lng()}`;
    });

    var input = document.getElementById('location');
    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.bindTo('bounds', map);

    autocomplete.addListener('place_changed', function() {
        var place = autocomplete.getPlace();
        if (!place.geometry) return;

        if (place.geometry.location) {
            marker.setPosition(place.geometry.location);
            map.setCenter(place.geometry.location);
            document.getElementById("latitude").value = place.geometry.location.lat();
            document.getElementById("longitude").value = place.geometry.location.lng();
            document.getElementById("location").value = place.formatted_address;
        }
    });

    if (defaultLocation.lat && defaultLocation.lng) {
        marker.setPosition(defaultLocation);
        map.setCenter(defaultLocation);
    }
}

document.addEventListener('DOMContentLoaded', () => {
    initializeQuillEditors();
    initMap();
});
</script>
@endpush

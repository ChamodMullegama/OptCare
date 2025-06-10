@extends('AdminArea.Layout.main')

@section('Admincontainer')
<div class="app-hero-header d-flex align-items-center">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <i class="ri-home-8-line lh-1 pe-3 me-3 border-end"></i>
            <a href="index.html">Home</a>
        </li>
        <li class="breadcrumb-item text-primary" aria-current="page">
            View Optic Center
        </li>
    </ol>
</div>

<div class="app-body">
    <div class="row gx-3">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Optic Center Details</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <h6>Basic Information</h6>
                            <p><strong>Optic Center ID:</strong> {{ $opticCenter->hospitalId }}</p>
                            <p><strong>Name:</strong> {{ $opticCenter->hospital_name }}</p>
                            <p><strong>Location:</strong> {{ $opticCenter->location }}</p>
                            <p><strong>Contact Number:</strong> {{ $opticCenter->contact_number }}</p>
                            <p><strong>Email:</strong> {{ $opticCenter->email }}</p>
                            <p><strong>Address:</strong> {{ $opticCenter->address }}</p>
                            <p><strong>Website:</strong> <a href="{{ $opticCenter->website_link }}" target="_blank">{{ $opticCenter->website_link }}</a></p>
                        </div>
                        <div class="col-md-4">
                            <h6>Social Media Links</h6>
                            @if ($opticCenter->social_media_links)
                                <p><strong>WhatsApp:</strong> <a href="{{ $opticCenter->social_media_links['whatsapp'] }}" target="_blank">{{ $opticCenter->social_media_links['whatsapp'] }}</a></p>
                                <p><strong>Instagram:</strong> <a href="{{ $opticCenter->social_media_links['instagram'] }}" target="_blank">{{ $opticCenter->social_media_links['instagram'] }}</a></p>
                                <p><strong>LinkedIn:</strong> <a href="{{ $opticCenter->social_media_links['linkedin'] }}" target="_blank">{{ $opticCenter->social_media_links['linkedin'] }}</a></p>
                                <p><strong>Facebook:</strong> <a href="{{ $opticCenter->social_media_links['facebook'] }}" target="_blank">{{ $opticCenter->social_media_links['facebook'] }}</a></p>
                                <p><strong>X:</strong> <a href="{{ $opticCenter->social_media_links['x'] }}" target="_blank">{{ $opticCenter->social_media_links['x'] }}</a></p>
                            @else
                                <p>No social media links available.</p>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <h6>Image</h6>
                            @if ($opticCenter->image)
                                <div style="
                                    width: 250px;
                                    height: 250px;
                                    border: 1px solid #ddd;
                                    padding: 10px;
                                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                                    border-radius: 10px;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    overflow: hidden;
                                    background-color: #f9f9f9;
                                ">
                                    <img src="{{ asset('storage/' . $opticCenter->image) }}"
                                        alt="Optic Center Image"
                                        style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">
                                </div>
                            @else
                                <p>No image available.</p>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <h6>Map Location</h6>
                            <div id="map" style="height: 400px; width: 100%;"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h6>Bio</h6>
                            <p>{!! Str::limit($opticCenter->bio, 5000) !!}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h6>Description</h6>
                            <p>{!! Str::limit($opticCenter->description, 5000) !!}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h6>Clinic Days and Time</h6>
                            @if ($opticCenter->clinic_days)
                                @foreach ($opticCenter->clinic_days as $day => $times)
                                    <p><strong>{{ ucfirst($day) }}:</strong> {{ $times['from'] ?? 'Closed' }} - {{ $times['to'] ?? 'Closed' }}</p>
                                @endforeach
                            @else
                                <p>No clinic days available.</p>
                            @endif
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-end mt-4">
                        <a href="{{ route('optic.centers.all') }}" class="btn btn-outline-secondary">
                            Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
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
<script>
function initMap() {
    const latitude = {{ $opticCenter->latitude ?: 20.5937 }};
    const longitude = {{ $opticCenter->longitude ?: 78.9629 }};
    const opticCenterLocation = { lat: latitude, lng: longitude };

    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 12,
        center: opticCenterLocation,
    });

    const marker = new google.maps.Marker({
        position: opticCenterLocation,
        map: map,
        title: "{{ $opticCenter->hospital_name }}",
    });
}

document.addEventListener('DOMContentLoaded', initMap);
</script>
@endpush

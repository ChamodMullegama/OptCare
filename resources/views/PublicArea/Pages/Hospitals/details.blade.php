@extends('PublicArea.Layout.main')
@section('Publiccontainer')

<!-- Page Title -->
<section class="page-title">
    <div class="bg-layer" style="background-image: url({{ asset('PublicArea/images/background/page-title.jpg') }});"></div>
    <div class="auto-container">
        <div class="content-box">
            <h1>{{ $hospital->hospital_name }}</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('public.eye-hospitals.all') }}">Eye Hospitals</a></li>
                <li>{{ $hospital->hospital_name }}</li>
            </ul>
        </div>
    </div>
</section>
<!-- End Page Title -->

<section class="sidebar-page-container p_relative">
    <div class="auto-container">
        <div class="row clearfix">
            <!-- Main Content Area -->
            <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                <div class="blog-details-content">
                    <div class="news-block-one">
                        <div class="inner-box">
                            @if($hospital->image)
                                <figure class="image-box">
                                    <img src="{{ asset('storage/' . $hospital->image) }}"
                                         alt="{{ $hospital->hospital_name }}"
                                         style="width: 100%; height: 500px; object-fit: cover;">
                                </figure>
                            @endif

                            <div class="lower-content">
                                <div class="inner">
                                    <h3>{{ $hospital->hospital_name }}</h3>
                                    <ul class="post-info clearfix">

                                        <li><i class="fas fa-phone"></i> <a href="tel:{{ $hospital->contact_number }}">{{ $hospital->contact_number }}</a></li>
                                        @if($hospital->website_link)
                                            <li><i class="fas fa-globe"></i> <a href="{{ $hospital->website_link }}" target="_blank">Website</a></li>
                                        @endif
                                    </ul>
                                    <div class="blog-content">
                                        {!! $hospital->description !!}
                                    </div>
                                    <h4>Bio</h4>
                                    <p>{!! $hospital->bio !!}</p>
                                    <h4>Clinic Days and Hours</h4>
                                    @if($hospital->clinic_days)
                                        @foreach($hospital->clinic_days as $day => $times)
                                            <p><strong>{{ ucfirst($day) }}:</strong> {{ $times['from'] ?? 'Closed' }} - {{ $times['to'] ?? 'Closed' }}</p>
                                        @endforeach
                                    @else
                                        <p>No clinic days available.</p>
                                    @endif
                                    <h4>Location Map</h4>
                                    <div id="map" style="height: 400px; width: 100%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Area -->
            <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                <div class="blog-sidebar ml_40">
                    <!-- Recent Hospitals Widget -->
                    <div class="sidebar-widget post-widget">
                        <div class="widget-title">
                            <h3>Other Hospitals</h3>
                        </div>
                        <div class="post-inner">
                            @foreach($recentHospitals as $recent)
                                <div class="post">
                                    @if($recent->image)
                                        <figure class="post-thumb">
                                            <a href="{{ route('public.eye-hospitals.details', ['hospitalId' => $recent->hospitalId]) }}">
                                                <img src="{{ asset('storage/' . $recent->image) }}"
                                                     alt="{{ $recent->hospital_name }}">
                                            </a>
                                        </figure>
                                    @endif
                                    <h4>
                                        <a href="{{ route('public.eye-hospitals.details', ['hospitalId' => $recent->hospitalId]) }}">{{ $recent->hospital_name }}</a>
                                    </h4>
                                    <span class="post-date"><i class="fas fa-map-marker-alt"></i> {{ $recent->location }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Social Media Widget -->
                    @if($hospital->social_media_links)
                        <div class="sidebar-widget tags-widget">
                            <div class="widget-title">
                                <h3>Social Media</h3>
                            </div>
                            <div class="widget-content">
                                <ul class="tags-list clearfix">
                                    @if($hospital->social_media_links['whatsapp'])
                                        <li><a href="{{ $hospital->social_media_links['whatsapp'] }}" target="_blank">WhatsApp</a></li>
                                    @endif
                                    @if($hospital->social_media_links['instagram'])
                                        <li><a href="{{ $hospital->social_media_links['instagram'] }}" target="_blank">Instagram</a></li>
                                    @endif
                                    @if($hospital->social_media_links['linkedin'])
                                        <li><a href="{{ $hospital->social_media_links['linkedin'] }}" target="_blank">LinkedIn</a></li>
                                    @endif
                                    @if($hospital->social_media_links['facebook'])
                                        <li><a href="{{ $hospital->social_media_links['facebook'] }}" target="_blank">Facebook</a></li>
                                    @endif
                                    @if($hospital->social_media_links['x'])
                                        <li><a href="{{ $hospital->social_media_links['x'] }}" target="_blank">X</a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>

    </div>
</section>

@endsection

@push('css')
<style>
    .image-box {
        height: 500px;
        overflow: hidden;
    }
    .image-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .blog-content img {
        max-width: 100%;
        height: auto;
    }
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
        // Use hospital's latitude and longitude, fallback to India if not available
        const latitude = {{ $hospital->latitude ?: 20.5937 }};
        const longitude = {{ $hospital->longitude ?: 78.9629 }};
        const hospitalLocation = { lat: latitude, lng: longitude };

        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 12,
            center: hospitalLocation,
        });

        const marker = new google.maps.Marker({
            position: hospitalLocation,
            map: map,
            title: "{{ $hospital->hospital_name }}",
        });
    }

    document.addEventListener('DOMContentLoaded', initMap);
</script>
@endpush

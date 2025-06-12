@extends('PublicArea.Layout.main')

@section('Publiccontainer')

<!-- Page Title -->
<section class="page-title">
    <div class="bg-layer" style="background-image: url({{ asset('PublicArea/images/background/page-title.jpg') }});"></div>
    <div class="auto-container">
        <div class="content-box">
            <h1>{{ $opticCenter->hospital_name }}</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('public.optic-centers.all') }}">Optic Centers</a></li>
                <li>{{ $opticCenter->hospital_name }}</li>
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
                            @if($opticCenter->image)
                                <figure class="image-box">
                                    <img src="{{ asset('storage/' . $opticCenter->image) }}"
                                         alt="{{ $opticCenter->hospital_name }}"
                                         style="width: 100%; height: 500px; object-fit: cover;">
                                </figure>
                            @endif

                            <div class="lower-content">
                                <div class="inner">
                                    <h3>{{ $opticCenter->hospital_name }}</h3>
                                    <ul class="post-info clearfix">
                                        <li><i class="fas fa-phone"></i>
                                            <a href="tel:{{ $opticCenter->contact_number }}">{{ $opticCenter->contact_number }}</a>
                                        </li>
                                        @if($opticCenter->website_link)
                                            <li><i class="fas fa-globe"></i>
                                                <a href="{{ $opticCenter->website_link }}" target="_blank">Website</a>
                                            </li>
                                        @endif
                                    </ul>

                                    <div class="blog-content">
                                        {!! $opticCenter->description !!}
                                    </div>
                                    <p>{!! $opticCenter->bio !!}</p>
                                    <div id="map"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Area -->
            <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                <div class="blog-sidebar ml_40">

                    <!-- Recent Optic Centers -->
                    <div class="sidebar-widget post-widget">
                        <div class="widget-title">
                            <h3>Outer Optic Centers </h3>
                        </div>
                        <div class="post-inner">
                            @foreach($recentOpticCenters as $recent)
                                <div class="post">
                                    @if($recent->image)
                                        <figure class="post-thumb">
                                            <a href="{{ route('public.optic-centers.details', ['centerId' => $recent->centerId]) }}">
                                                <img src="{{ asset('storage/' . $recent->image) }}"
                                                     alt="{{ $recent->hospital_name }}">
                                            </a>
                                        </figure>
                                    @endif
                                    <h4>
                                        <a href="{{ route('public.optic-centers.details', ['centerId' => $recent->centerId]) }}">{{ $recent->hospital_name }}</a>
                                    </h4>
                                    <span class="post-date"><i class="fas fa-map-marker-alt"></i> {{ $recent->location }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Social Media Links -->
                    @if(is_array($opticCenter->social_media_links))
                        <div class="sidebar-widget tags-widget">
                            <div class="widget-title">
                                <h3>Social Media</h3>
                            </div>
                            <div class="widget-content">
                                <ul class="tags-list clearfix">
                                    @foreach(['whatsapp', 'instagram', 'linkedin', 'facebook', 'x'] as $platform)
                                        @if(!empty($opticCenter->social_media_links[$platform]))
                                            <li><a href="{{ $opticCenter->social_media_links[$platform] }}" target="_blank">{{ ucfirst($platform) }}</a></li>
                                        @endif
                                    @endforeach
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
        const latitude = {{ $opticCenter->latitude ?? 20.5937 }};
        const longitude = {{ $opticCenter->longitude ?? 78.9629 }};
        const centerLocation = { lat: latitude, lng: longitude };

        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 12,
            center: centerLocation,
        });

        new google.maps.Marker({
            position: centerLocation,
            map: map,
            title: "{{ $opticCenter->hospital_name }}",
        });
    }

    document.addEventListener('DOMContentLoaded', initMap);
</script>
@endpush

@extends('PublicArea.Layout.main')
@section('Publiccontainer')

<!-- Page Title -->
<section class="page-title">
    <div class="bg-layer" style="background-image: url({{ asset('PublicArea/images/background/page-title.jpg') }});"></div>
    <div class="auto-container">
        <div class="content-box">
            <h1>{{ $EyeScan->name }}</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('publicEyeInvestigations.all') }}">Eye Investigations</a></li>
                <li>{{ $EyeScan->name }}</li>
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
                @if($EyeScan->images->first())
                    <figure class="image-box">
                        <img src="{{ asset('storage/' . $EyeScan->images->first()->image) }}"
                             alt="{{ $EyeScan->name }}"
                             style="width: 100%; height: 500px; object-fit: cover;">
                    </figure>
                @endif

                <div class="lower-content">
                    <div class="inner">
                        <h3>{{ $EyeScan->name }}</h3>
                        <div class="blog-content">
                            <p><strong>Description:</strong> {!! $EyeScan->description !!}</p>
                            <p><strong>Purpose:</strong> {!! $EyeScan->purpose !!}</p>
                            <p><strong>Usage:</strong> {!! $EyeScan->usage !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

            <!-- Sidebar Area -->
            <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                <div class="blog-sidebar ml_40">
                    <!-- Recent Eye Investigations Widget -->
                    <div class="sidebar-widget post-widget">
                        <div class="widget-title">
                            <h3>Other Eye Investigations</h3>
                        </div>
                        <div class="post-inner">
                            @foreach($recentEyeScans as $recent)
                            <div class="post">
                                @php
                                    $recentPrimaryImage = $recent->images->first();
                                @endphp
                                @if($recentPrimaryImage)
                                <figure class="post-thumb">
                                    <a href="{{ route('publicEyeInvestigations.details', $recent->eyeScanId) }}">
                                        <img src="{{ asset('storage/' . $recentPrimaryImage->image) }}"
                                             alt="{{ $recent->name }}">
                                    </a>
                                </figure>
                                @endif
                                <h4>
                                    <a href="{{ route('publicEyeInvestigations.details', $recent->eyeScanId) }}">{{ $recent->name }}</a>
                                </h4>
                                <p>{{ Str::limit(strip_tags($recent->description), 80) }}</p>
                            </div>
                            @endforeach


                        </div>
                    </div>

                    <!-- Contact Widget -->
                    <div>
                        <div class="sidebar-widget contact-widget">
                            <div class="widget-title">
                                <h3>Need Help?</h3>
                            </div>
                            <div class="widget-content">
                                <p>Contact us for more information about this investigation. <a href="{{ route('Home.contactUs') }}">Contact Us</a></p>
                            </div>
                        </div>
                    </div>
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
    .blog-content .blog-img {
        max-width: 100%;
        height: auto;
    }
</style>
@endpush

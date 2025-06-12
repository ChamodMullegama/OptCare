@extends('PublicArea.Layout.main')
@section('Publiccontainer')

<!-- Page Title -->
<section class="page-title">
    <div class="bg-layer" style="background-image: url({{ asset('PublicArea/images/background/page-title.jpg') }});"></div>
    <div class="auto-container">
        <div class="content-box">
            <h1>{{ $eyeIssue->name }}</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('PublicAreaEyeIssues.all') }}">Eye Disease</a></li>
                <li>{{ $eyeIssue->name }}</li>
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
                            @if($eyeIssue->images->count() > 0)
                            <!-- Image Slider -->
                            <div class="blog-image-slider owl-carousel owl-theme">
                                @foreach($eyeIssue->images as $image)
                                <figure class="image-box">
                                    <img src="{{ asset('storage/' . $image->image) }}" alt="{{ $eyeIssue->name }}">
                                </figure>
                                @endforeach
                            </div>
                            @endif

                            <div class="lower-content">
                                <div class="inner">
                                    <h3>{{ $eyeIssue->name }}</h3>
                                    <ul class="post-info clearfix">
                                        <li><i class="fas fa-eye"></i> Eye Condition</li>
                                        <li><i class="fas fa-info-circle"></i> Detailed Information</li>
                                    </ul>
                                    <div class="blog-content">
                                        <h4>Description</h4>
                                        {!! $eyeIssue->description !!}

                                        <h4>Symptoms</h4>
                                        {!! $eyeIssue->symptoms !!}

                                        <h4>Causes</h4>
                                        {!! $eyeIssue->causes !!}

                                        <h4>Treatments</h4>
                                        {!! $eyeIssue->treatments !!}
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
                    <!-- Recent Issues Widget -->
                    <div class="sidebar-widget post-widget">
                        <div class="widget-title">
                            <h3>Other Conditions</h3>
                        </div>
                        <div class="post-inner">
                            @foreach($recentIssues as $issue)
                            <div class="post">
                                @php
                                    $recentImage = $issue->images->where('isPrimary', 1)->first() ?? $issue->images->first();
                                @endphp
                                @if($recentImage)
                                <figure class="post-thumb">
                                    <a href="{{ route('PublicAreaEyeIssues.details', $issue->eyeIssueId) }}">
                                        <img src="{{ asset('storage/' . $recentImage->image) }}" alt="{{ $issue->name }}">
                                    </a>
                                </figure>
                                @endif
                                <h4>
                                    <a href="{{ route('PublicAreaEyeIssues.details', $issue->eyeIssueId) }}">{{ $issue->name }}</a>
                                </h4>
                                <p>{{ Str::limit(strip_tags($issue->description), 80) }}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Tags Widget -->
                    <div class="sidebar-widget contact-widget">
                        <div class="widget-title">
                            <h3>Need Help?</h3>
                        </div>
                        <div class="widget-content">
                            <p>If you're experiencing any symptoms, contact our specialists.<a href="{{ route('PublicAreDoctors.all') }}">Contact Us</a></p>

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
    .blog-image-slider .owl-stage {
        display: flex;
        align-items: center;
    }
    .blog-image-slider .image-box {
        height: 500px;
        overflow: hidden;
    }
    .blog-image-slider img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .blog-content img {
        max-width: 100%;
        height: auto;
    }
    .blog-content h4 {
        font-size: 22px;
        margin: 25px 0 15px;
        color: #222;
    }
</style>
@endpush

@push('js')
<script>
    $(document).ready(function(){
        // Initialize image slider
        $('.blog-image-slider').owlCarousel({
            items: 1,
            loop: true,
            margin: 10,
            nav: true,
            dots: true,
            autoplay: true,
            autoplayTimeout: 5000,
            smartSpeed: 1000,
            navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>']
        });
    });
</script>
@endpush

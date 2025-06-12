@extends('PublicArea.Layout.main')
@section('Publiccontainer')

<!-- Page Title -->
<section class="page-title">
    <div class="bg-layer" style="background-image: url({{ asset('PublicArea/images/background/page-title.jpg') }});"></div>
    <div class="auto-container">
        <div class="content-box">
            <h1>{{ $treatment->name }}</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('public.non-surgical-treatments.all') }}">Non-Surgical Treatments</a></li>
                <li>{{ $treatment->name }}</li>
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
                            @if($treatment->image_path)
                                <figure class="image-box">
                                    <img src="{{ asset('storage/' . $treatment->image_path) }}"
                                         alt="{{ $treatment->name }}"
                                         style="width: 100%; height: 500px; object-fit: cover;">
                                </figure>
                            @endif

                            <div class="lower-content">
                                <div class="inner">
                                    <h3>{{ $treatment->name }}</h3>
                                    <div class="blog-content">
                                        {!! $treatment->description !!}
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
                    <!-- Recent Treatments Widget -->
                    <div class="sidebar-widget post-widget">
                        <div class="widget-title">
                            <h3>Other Treatments</h3>
                        </div>
                        <div class="post-inner">
                            @foreach($recentTreatments as $recent)
                            <div class="post">
                                @if($recent->image_path)
                                <figure class="post-thumb">
                                    <a href="{{ route('public.non-surgical-treatments.show', $recent->id) }}">
                                        <img src="{{ asset('storage/' . $recent->image_path) }}"
                                             alt="{{ $recent->name }}">
                                    </a>
                                </figure>
                                @endif
                                <h4>
                                    <a href="{{ route('public.non-surgical-treatments.show', $recent->id) }}">{{ $recent->name }}</a>
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
                                <p>Contact us for more information about this treatment.<a href="{{ route('PublicAreDoctors.all') }}">Contact Us</a></p>

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
    .custom-image-box img {
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

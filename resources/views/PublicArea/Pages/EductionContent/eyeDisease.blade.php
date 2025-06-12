@extends('PublicArea.Layout.main')

@section('Publiccontainer')

<!-- Page Title -->
<section class="page-title">
    <div class="bg-layer" style="background-image: url({{ asset('PublicArea/images/background/page-title.jpg') }});"></div>
    <div class="auto-container">
        <div class="content-box">
            <h1>Eye Conditions</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Eye Conditions</li>
            </ul>
        </div>
    </div>
</section>
<!-- End Page Title -->

<!-- service-style-two -->
<section class="service-style-two p_relative">
    <div class="auto-container">
        <div class="row clearfix">
            @foreach($eyeIssues as $issue)
                @php
                    $primaryImage = $issue->images->where('isPrimary', 1)->first() ?? $issue->images->first();
                    $firstTag = '';
                    if (isset($issue->tags)) {
                        $tagsArray = explode(',', $issue->tags);
                        $firstTag = trim($tagsArray[0]);
                    }
                @endphp

                <div class="col-lg-4 col-md-6 col-sm-12 service-block">
                    <div class="service-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            @if($primaryImage)
                                <figure class="image-box">
                                    <img src="{{ asset('storage/' . $primaryImage->image) }}"
                                         alt="{{ $issue->name }}"
                                         style="width: 360px; height: 220px; object-fit: cover; display: block;">
                                    <a href="{{ route('PublicAreaEyeIssues.details', $issue->eyeIssueId) }}"><i class="fas fa-link"></i></a>
                                </figure>
                            @endif

                            <div class="lower-content">
                                @if($firstTag)
                                    <div class="icon-box"><i class="fas fa-tag"></i></div>
                                @endif

                                <h3>
                                    <a href="{{ route('PublicAreaEyeIssues.details', $issue->eyeIssueId) }}">{{ $issue->name }}</a>
                                </h3>

                                <p class="p_relative d_block">{{ Str::limit(strip_tags($issue->description), 100) }}</p>

                                <div class="link p_relative d_block">
                                    <a href="{{ route('PublicAreaEyeIssues.details', $issue->eyeIssueId) }}">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- service-style-two end -->

@endsection

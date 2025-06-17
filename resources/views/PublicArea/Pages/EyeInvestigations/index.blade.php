@extends('PublicArea.Layout.main')
@section('Publiccontainer')

<!-- Page Title -->
<section class="page-title">
    <div class="bg-layer" style="background-image: url({{ asset('PublicArea/images/background/page-title.jpg') }});"></div>
    <div class="auto-container">
        <div class="content-box">
            <h1>Eye Investigations</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Eye Investigations</li>
            </ul>
        </div>
    </div>
</section>
<!-- End Page Title -->

<!-- service-style-two -->
<section class="news-section blog-grid p_relative">
    <div class="auto-container">
        <!-- Search Box -->
        <div class="row mb-4">
            <div class="col-md-8 mx-auto">
                <form action="{{ route('publicEyeInvestigations.search') }}" method="GET">
                    <div class="form-group" style="display: flex; gap: 10px;">
                        <input type="text" name="search" placeholder="Search eye investigations..." value="{{ request('search') ?? '' }}"
                               style="padding: 10px 20px; font-size: 14px; border-radius: 40px; border: 1px solid #ccc; flex: 1;">
                        <button type="submit" class="theme-btn btn-one"
                                style="padding: 10px 30px; font-size: 14px; background-color: #03c0b4; border-color: #03c0b4; color: #fff; transition: all 0.3s ease; border-radius: 40px;"
                                onmouseover="this.style.backgroundColor='black'; this.style.borderColor='black';"
                                onmouseout="this.style.backgroundColor='#1abc9c'; this.style.borderColor='#1abc9c';">
                            <i class="fas fa-search"></i> Search
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row clearfix">
            @forelse($EyeScans as $eyeScan)
                <div class="col-lg-4 col-md-6 col-sm-12 service-block">
                    <div class="service-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box" style="background-color: #f0f0f0;">
                            @php
                                $primaryImage = $eyeScan->images->where('isPrimary', true)->first();
                            @endphp
                            @if($primaryImage)
                                <figure class="image-box">
                                    <img src="{{ asset('storage/' . $primaryImage->image) }}"
                                         alt="{{ $eyeScan->name }}"
                                         style="width: 360px; height: 220px; object-fit: cover; display: block;">
                                    <a href="{{ route('publicEyeInvestigations.details', $eyeScan->eyeScanId) }}"><i class="fas fa-link"></i></a>
                                </figure>
                            @endif

                            <div class="lower-content">
                                <h3>
                                    <a href="{{ route('publicEyeInvestigations.details', $eyeScan->eyeScanId) }}">{{ $eyeScan->name }}</a>
                                </h3>

                                <p class="p_relative d_block">{{ Str::limit(strip_tags($eyeScan->description), 100) }}</p>

                                <div class="link p_relative d_block">
                                    <a href="{{ route('publicEyeInvestigations.details', $eyeScan->eyeScanId) }}">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <h4>No eye investigations found</h4>
                    <a href="{{ route('public.eye-investigations.all') }}" class="theme-btn btn-one"
                       style="padding: 10px 30px; font-size: 14px; background-color: #03c0b4; border-color: #03c0b4; color: #fff; transition: all 0.3s ease; border-radius: 40px;"
                       onmouseover="this.style.backgroundColor='black'; this.style.borderColor='black';"
                       onmouseout="this.style.backgroundColor='#1abc9c'; this.style.borderColor='#1abc9c';">View All Eye Investigations</a>
                </div>
            @endforelse
        </div>
    </div>
</section>
<!-- service-style-two end -->

@endsection

@extends('PublicArea.Layout.main')

@section('Publiccontainer')

<!-- Page Title -->
<section class="page-title">
    <div class="bg-layer" style="background-image: url({{ asset('PublicArea/images/background/page-title.jpg') }});"></div>
    <div class="auto-container">
        <div class="content-box">
            <h1>Optic Centers</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Optic Centers</li>
            </ul>
        </div>
    </div>
</section>
<!-- End Page Title -->

<!-- news-section -->
<section class="news-section blog-grid p_relative">
    <div class="auto-container">
        <!-- Search Box -->
        <div class="row mb-4">
            <div class="col-md-8 mx-auto">
                <form action="{{ route('public.optic-centers.search') }}" method="GET">
                    <div class="form-group" style="display: flex; gap: 10px;">
                        <input type="text" name="search" placeholder="Search optic centers..." value="{{ request('search') ?? '' }}"
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

        <!-- Optic Centers List -->
        <div class="row clearfix">
            @forelse($opticCenters as $opticCenter)
                <div class="col-lg-4 col-md-6 col-sm-12 news-block">
                    <div class="news-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            @if($opticCenter->image)
                                <figure class="image-box">
                                    <img src="{{ asset('storage/' . $opticCenter->image) }}"
                                         alt="{{ $opticCenter->hospital_name }}"
                                         style="width: 410px; height: 300px; object-fit: cover; display: block;">
                                    <a href="{{ route('public.optic-centers.details', ['hospitalId' => $opticCenter->hospitalId]) }}">
                                        <i class="fas fa-link"></i>
                                    </a>
                                </figure>
                            @endif
                            <div class="lower-content">
                                <div class="inner">
                                    <h3>
                                        <a href="{{ route('public.optic-centers.details', ['hospitalId' => $opticCenter->hospitalId]) }}">
                                            {{ $opticCenter->hospital_name }}
                                        </a>
                                    </h3>
                                    <ul class="post-info clearfix">

                                        <li><i class="fas fa-phone"></i> {{ $opticCenter->contact_number }}</li>
                                    </ul>
                                    <p>{{ Str::limit(strip_tags($opticCenter->description), 100) }}</p>
                                    <div class="link">
                                        <a href="{{ route('public.optic-centers.details', ['hospitalId' => $opticCenter->hospitalId]) }}">
                                            Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <h4>No optic centers found</h4>
                    <a href="{{ route('public.optic-centers.all') }}" class="theme-btn btn-one"
                       style="padding: 10px 30px; font-size: 14px; background-color: #03c0b4; border-color: #03c0b4; color: #fff; transition: all 0.3s ease; border-radius: 40px;"
                       onmouseover="this.style.backgroundColor='black'; this.style.borderColor='black';"
                       onmouseout="this.style.backgroundColor='#1abc9c'; this.style.borderColor='#1abc9c';">
                        View All Optic Centers
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</section>
<!-- news-section end -->

@endsection

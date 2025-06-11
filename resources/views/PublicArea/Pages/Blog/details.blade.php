@extends('PublicArea.Layout.main')
@section('Publiccontainer')

<section class="page-title">
    <div class="bg-layer" style="background-image: url({{ asset('PublicArea/images/background/page-title.jpg') }});"></div>
    <div class="auto-container">
        <div class="content-box">
            <h1>{{ $blog->title }}</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('PublicAreaBlog.all') }}">Blog</a></li>
                <li>{{ $blog->title }}</li>
            </ul>
        </div>
    </div>
</section>

<section class="sidebar-page-container p_relative">
    <div class="auto-container">
        <div class="row clearfix">
            <!-- Main Content Area -->
            <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                <div class="blog-details-content">
                    <div class="news-block-one">
                        <div class="inner-box">
                            @if($blog->images->count() > 0)
                            <!-- Image Slider -->
                            <div class="blog-image-slider owl-carousel owl-theme">
                                @foreach($blog->images as $image)
                                <figure class="image-box">
                                    <img src="{{ asset('storage/' . $image->image) }}" alt="{{ $blog->title }}">
                                </figure>
                                @endforeach
                            </div>
                            @endif

                            <div class="lower-content">
                                <div class="inner">
                                    @if($blog->tags)
                                        <div class="category"><a href="#">{{ $blog->tags }}</a></div>
                                    @endif
                                    <h3>{{ $blog->title }}</h3>
                                    <ul class="post-info clearfix">
                                        <li><i class="fas fa-calendar-alt"></i>{{ \Carbon\Carbon::parse($blog->date)->format('d M, Y') }}</li>
                                        <li><i class="fas fa-star"></i><a href="#">{{ $blog->special_thing }}</a></li>
                                    </ul>
                                    <div class="blog-content">
                                        {!! $blog->content !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Comment Form (Keep your existing form) -->
                    <div class="comments-form-area">
                        <!-- Your existing comment form code -->
                    </div>
                </div>
            </div>

            <!-- Sidebar Area -->
            <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                <div class="blog-sidebar ml_40">
                    <!-- Recent Posts Widget -->
                    <div class="sidebar-widget post-widget">
                        <div class="widget-title">
                            <h3>Recent Posts</h3>
                        </div>
                        <div class="post-inner">
                            @foreach($recentBlogs as $recent)
                            <div class="post">
                                @php
                                    $recentImage = $recent->images->where('isPrimary', 1)->first() ?? $recent->images->first();
                                @endphp
                                @if($recentImage)
                                <figure class="post-thumb">
                                    <a href="{{ route('PublicAreaBlog.details', $recent->blogId) }}">
                                        <img src="{{ asset('storage/' . $recentImage->image) }}" alt="{{ $recent->title }}">
                                    </a>
                                </figure>
                                @endif
                                <h4>
                                    <a href="{{ route('PublicAreaBlog.details', $recent->blogId) }}">{{ $recent->title }}</a>
                                </h4>
                                <span class="post-date"><i class="fas fa-calendar-alt"></i>{{ \Carbon\Carbon::parse($recent->date)->format('d M, Y') }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>

              <div class="sidebar-widget tags-widget">
                        <div class="widget-title">
                            <h3>Tags</h3>
                        </div>
                        <div class="widget-content">
                            <ul class="tags-list clearfix">
                                @if($blog->tags)
                                    @foreach(explode(',', $blog->tags) as $tag)
                                        <li><a href="#">{{ trim($tag) }}</a></li>
                                    @endforeach
                                @endif
                            </ul>
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

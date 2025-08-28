@extends('PublicArea.Layout.main')
@section('Publiccontainer')

<!-- Page Title -->
<section class="page-title">
  <div class="bg-layer" style="background-image: url({{ asset('PublicArea/images/background/page-title.jpg') }});"></div>
    <div class="auto-container">
        <div class="content-box">
            <h1>Blogs</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Blog Grid</li>
            </ul>
        </div>
    </div>
</section>
<!-- End Page Title -->

<!-- news-section -->
<section class="news-section blog-grid p_relative">
    <div class="auto-container">
        <div class="row clearfix">
            @foreach($blogs as $blog)
                @php
                    $primaryImage = $blog->images->where('isPrimary', 1)->first();
                    if (!$primaryImage) {
                        $primaryImage = $blog->images->first();
                    }
                    // Get first tag
                    $firstTag = '';
                    if ($blog->tags) {
                        $tagsArray = explode(',', $blog->tags);
                        $firstTag = trim($tagsArray[0]);
                    }
                @endphp
                <div class="col-lg-4 col-md-6 col-sm-12 news-block">
                    <div class="news-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            @if($primaryImage)
                               <figure class="image-box">
                                    <img src="{{ asset('storage/' . $primaryImage->image) }}"
                                         alt="{{ $blog->title }}"
                                         style="width: 410px; height: 300px; object-fit: cover; display: block;">
                                    <a href="{{ route('PublicAreaBlog.details', ['id' => $blog->blogId]) }}"><i class="fas fa-link"></i></a>
                                </figure>
                            @endif
                            <div class="lower-content">
                                <div class="inner">
                                    @if($firstTag)
                                        <div class="category"><a href="#">{{ $firstTag }}</a></div>
                                    @endif
                                    <h3><a href="{{ route('PublicAreaBlog.details', ['id' => $blog->blogId]) }}">{{ $blog->title }}</a></h3>
                                    <ul class="post-info clearfix">
                                        <li><i class="fas fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($blog->date)->format('d M, Y') }}</li>
                                        <li><i class="fas fa-star"></i> <a href="#">{{ $blog->special_thing }}</a></li>
                                    </ul>
                                    <p>{{ Str::limit(strip_tags($blog->content), 100) }}</p>
                                    <div class="link"><a href="{{ route('PublicAreaBlog.details', ['id' => $blog->blogId]) }}">Read more</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- news-section end -->

@endsection

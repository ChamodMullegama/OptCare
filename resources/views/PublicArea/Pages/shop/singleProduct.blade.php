@extends('PublicArea.Layout.main')
@section('Publiccontainer')

<!-- Page Title -->
<section class="page-title">
    <div class="bg-layer" style="background-image: url({{ asset('PublicArea/images/background/page-title.jpg') }});"></div>
    <div class="auto-container">


            <div class="content-box">
            <h1>{{ $product->name }}</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('public.products.index') }}">Product List</a></li>
                <li>{{ $product->name }}</li>
            </ul>
        </div>
    </div>
</section>
<!-- End Page Title -->

<!-- shop-details -->
<section class="shop-details p_relative pt_120 pb_70">
    <div class="auto-container">
        <div class="product-details-content p_relative d_block mb_110">
            <div class="row align-items-center clearfix">
                <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                    <div class="image-box p_relative d_block mr_20">
                        @php
                            $primaryImage = $product->images->where('isPrimary', 1)->first() ?? $product->images->first();
                            $discountedPrice = $product->price * (1 - ($product->discount / 100));
                        @endphp

                        <!-- Main Image Slider -->
                        <div class="product-image-slider mb-4">
                            <div class="main-image-slider">
                                @foreach($product->images as $image)
                                <div class="slide">
                                    <figure class="image" style="height: 500px;">
                                        <img src="{{ asset('storage/' . $image->image) }}" alt="{{ $product->name }}" style="width: 100%; height: 100%; object-fit: contain;">
                                    </figure>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Thumbnail Slider -->
                        @if($product->images->count() > 1)
                        <div class="thumbnail-slider">
                            @foreach($product->images as $image)
                            <div class="slide">
                                <img src="{{ asset('storage/' . $image->image) }}" alt="{{ $product->name }}" style="width: 80px; height: 80px; object-fit: cover; cursor: pointer;">
                            </div>
                            @endforeach
                        </div>
                        @endif

                        <div class="preview-link p_absolute t_20 r_20">
                            <a href="{{ $primaryImage ? asset('storage/' . $primaryImage->image) : '#' }}" class="lightbox-image p_relative d_iblock fs_20 centred z_1 w_50 h_50 color_black lh_55" data-fancybox="gallery">
                                <i class="fas fa-search"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                    <!-- Content remains the same as before -->
                    <div class="product-details p_relative d_block ml_20">
                        <h2 class="d_block fs_30 lh_35 fw_sbold mb_11">{{ $product->name }}</h2>
                        <div class="customer-rating clearfix p_relative d_block mb_5">
                            <ul class="rating clearfix">
                                @for ($i = 0; $i < 5; $i++)
                                    <li class="p_relative d_iblock pull-left mr_3 fs_15"><i class="fas fa-star"></i></li>
                                @endfor
                            </ul>
                        </div>
                        <span class="price p_relative d_block fs_20 lh_30 fw_medium mb_25">
                            @if($product->discount > 0)
                                <del>${{ number_format($product->price, 2) }}</del> ${{ number_format($discountedPrice, 2) }}
                            @else
                                ${{ number_format($product->price, 2) }}
                            @endif
                        </span>
                        <div class="text p_relative d_block mb_30">
                            <p class="mb_25">{!! Str::limit($product->description, 5000) !!}</p>
                        </div>
                        <div class="addto-cart-box p_relative d_block mb_35">
                            <ul class="clearfix">
                                <li class="item-quantity p_relative d_block float_left mr_10">
                                    <input class="quantity-spinner" type="number" value="1" name="quantity" min="1">
                                </li>
                                <li class="p_relative d_block float_left mr_10">
                                    <button type="button" class="theme-btn btn-two">Add To Cart</button>
                                </li>
                                <li class="p_relative d_block float_left mr_10">
                                    <a href="#" class="d_iblock p_relative fs_20 lh_50 w_50 h_50 centred b_radius_50">
                                        <i class="fas fa-heart"></i>
                                    </a>
                                </li>
                                <li class="p_relative d_block float_left mr_10">
                                    <a href="#" class="d_iblock p_relative fs_20 lh_50 w_50 h_50 centred b_radius_50">
                                        <i class="fas fa-share-alt"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="other-option">
                            <ul class="list">
                                <li class="p_relative d_block fs_16 font_family_poppins mb_5"><span class="fw_medium color_black">Product ID:</span> {{ $product->productId }}</li>
                                <li class="p_relative d_block fs_16 font_family_poppins mb_5"><span class="fw_medium color_black">Category:</span> {{ $product->category->name ?? 'N/A' }}</li>
                                <li class="p_relative d_block fs_16 font_family_poppins"><span class="fw_medium color_black">Brand:</span> {{ $product->brand_name }}</li>
                                <li class="p_relative d_block fs_16 font_family_poppins"><span class="fw_medium color_black">Color:</span> {{ $product->product_color }}</li>
                                <li class="p_relative d_block fs_16 font_family_poppins"><span class="fw_medium color_black">Availability:</span> {{ $product->quantity > 0 ? 'In Stock' : 'Out of Stock' }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rest of the content remains the same -->
        <div class="product-discription p_relative d_block mb_100">
               <div class="product-discription p_relative d_block mb_100">
                    <div class="tabs-box">
                        <div class="tab-btn-box p_relative d_block">
                            <ul class="tab-btns tab-buttons clearfix">
                                <li class="tab-btn active-btn p_relative d_iblock fs_18 lh_20 float_left fw_medium z_1 mr_35 tran_5" data-tab="#tab-1">Description</li>
                                <li class="tab-btn p_relative d_iblock fs_18 lh_20 float_left fw_medium z_1 tran_5" data-tab="#tab-2">Reviews (1)</li>
                            </ul>
                        </div>
                        <div class="tabs-content">
                            <div class="tab active-tab" id="tab-1">
                                <div class="content-box">

                                    <p class="mb_25">{!! Str::limit($product->description, 5000) !!}</p>
                                </div>
                            </div>
                            <div class="tab" id="tab-2">
                                <div class="customer-inner">
                                    <div class="customer-review p_relative d_block pb_65 mb_65">
                                        <h4 class="p_relative d_block fs_20 lh_30 fw_medium fw_sbold mb_40">Classic Rechargeable Table Lamp Black</h4>
                                        <div class="comment-box p_relative d_block pl_110">
                                            <figure class="comment-thumb p_absolute l_0 t_0 w_80 h_80 b_radius_55"><img src="assets/images/shop/comment-1.jpg" alt=""></figure>
                                            <h5 class="d_block fs_18 lh_20 fw_sbold">Keanu Reeves<span class="d_iblock fs_16 font_family_poppins"> - May 1, 2021</span></h5>
                                            <ul class="rating clearfix mb_15">
                                                <li class="p_relative d_iblock pull-left mr_3 fs_13"><i class="fas fa-star"></i></li>
                                                <li class="p_relative d_iblock pull-left mr_3 fs_13"><i class="fas fa-star"></i></li>
                                                <li class="p_relative d_iblock pull-left mr_3 fs_13"><i class="fas fa-star"></i></li>
                                                <li class="p_relative d_iblock pull-left mr_3 fs_13"><i class="fas fa-star"></i></li>
                                                <li class="p_relative d_iblock pull-left mr_5 fs_13"><i class="far fa-star"></i></li>
                                            </ul>
                                            <div class="text">
                                                <p>Excepteur sint occaecat cupidatat non proident sunt in culpa  qui officia deserunt mollit anim  est laborum. Sed perspiciatis unde omnis natus error sit voluptatem accusa dolore mque laudant totam rem aperiam eaque ipsa quae ab illo inventore veritatis et quasi arch tecto beatae vitae dicta.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="customer-comments p_relative">
                                        <h4 class="p_relative d_block fs_20 lh_30 fw_medium fw_sbold mb_25">Be First to Add a Review</h4>
                                        <div class="rating-box clearfix mb_12">
                                            <h6 class="p_relative d_iblock fs_16 fw_medium mr_15 float_left">Your Rating</h6>
                                            <ul class="rating p_relative d_block clearfix float_left">
                                                <li class="p_relative d_iblock fs_12 lh_26 float_left mr_3"><i class="far fa-star"></i></li>
                                                <li class="p_relative d_iblock fs_12 lh_26 float_left mr_3"><i class="far fa-star"></i></li>
                                                <li class="p_relative d_iblock fs_12 lh_26 float_left mr_3"><i class="far fa-star"></i></li>
                                                <li class="p_relative d_iblock fs_12 lh_26 float_left mr_3"><i class="far fa-star"></i></li>
                                                <li class="p_relative d_iblock fs_12 lh_26 float_left"><i class="far fa-star"></i></li>
                                            </ul>
                                        </div>
                                        <form action="shop-details.html" method="post" class="comment-form default-form">
                                            <div class="row clearfix">
                                                <div class="col-lg-12 col-md-12 col-sm-12 form-group mb_15">
                                                    <label class="p_relative d_block fs_16 mb_3 font_family_poppins">Your Review</label>
                                                    <textarea name="message"></textarea>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 form-group mb_15">
                                                    <label class="p_relative d_block fs_16 mb_3 font_family_poppins">Your Name</label>
                                                    <input type="text" name="name" required="">
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 form-group mb_15">
                                                    <label class="p_relative d_block fs_16 mb_3 font_family_poppins">Your Email</label>
                                                    <input type="email" name="email" required="">
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn m_0">
                                                    <button type="submit" class="theme-btn btn-one">Submit Your Review</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        </div>

        @if($relatedProducts->count() > 0)
        <div class="related-product">
                 <div class="related-product">
                    <div class="title-text mb_20">
                        <h2 class="d_block fs_30 lh_40 fw_sbold">Related Products</h2>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-3 col-md-6 col-sm-12 shop-block">
                            <div class="shop-block-one">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <span class="hot">Hot</span>
                                        <figure class="image"><img src="assets/images/shop/shop-1.png" alt=""></figure>
                                        <ul class="option-list clearfix">
                                            <li><a href="shop.html"><i class="icon-47"></i></a></li>
                                            <li><a href="index-5.html"><i class="icon-48"></i></a></li>
                                            <li><a href="index-5.html"><i class="icon-49"></i></a></li>
                                            <li><a href="assets/images/shop/shop-1.png" class="lightbox-image" data-fancybox="gallery"><i class="icon-50"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="lower-content">
                                        <h5><a href="shop-details.html">CM-4336 RG Luxury<br /> Stethoscope</a></h5>
                                        <ul class="rating clearfix">
                                            <li><i class="icon-51"></i></li>
                                            <li><i class="icon-51"></i></li>
                                            <li><i class="icon-51"></i></li>
                                            <li><i class="icon-51"></i></li>
                                            <li><i class="icon-51"></i></li>
                                        </ul>
                                        <span class="price">$70.30</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
        </div>
        @endif
    </div>
</section>
<!-- shop-details end -->

@push('css')
<style>
    /* Image slider styles */
    .product-image-slider {
        margin-bottom: 15px;
    }

    .main-image-slider .slide {
        height: 500px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f9f9f9;
    }

    .main-image-slider .slide img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    .thumbnail-slider {
        margin-top: 15px;
    }

    .thumbnail-slider .slide {
        padding: 0 5px;
    }

    .thumbnail-slider .slide img {
        border: 1px solid #ddd;
        transition: all 0.3s ease;
    }

    .thumbnail-slider .slide img:hover {
        border-color: #03c0b4;
    }

    .slick-prev:before,
    .slick-next:before {
        color: #03c0b4;
    }

    .slick-dots li button:before {
        font-size: 12px;
    }

    .slick-dots li.slick-active button:before {
        color: #03c0b4;
    }
</style>
@endpush

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">

<script>
    $(document).ready(function(){
        // Initialize main image slider
        $('.main-image-slider').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            fade: true,
            asNavFor: '.thumbnail-slider',
            adaptiveHeight: true
        });

        // Initialize thumbnail slider if there are multiple images
        @if($product->images->count() > 1)
        $('.thumbnail-slider').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            asNavFor: '.main-image-slider',
            dots: false,
            centerMode: false,
            focusOnSelect: true,
            arrows: false,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2
                    }
                }
            ]
        });
        @endif

        // Lightbox for all images
        $('[data-fancybox="gallery"]').fancybox({
            buttons: [
                "zoom",
                "share",
                "slideShow",
                "fullScreen",
                "download",
                "thumbs",
                "close"
            ]
        });
    });
</script>
@endpush

@endsection

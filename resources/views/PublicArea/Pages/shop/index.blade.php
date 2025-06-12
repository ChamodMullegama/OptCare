@extends('PublicArea.Layout.main')
@section('Publiccontainer')

<!-- Page Title -->
<section class="page-title">
    <div class="bg-layer" style="background-image: url({{ asset('PublicArea/images/background/page-title.jpg') }});"></div>
    <div class="auto-container">
        <div class="content-box">
            <h1>Product List</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Product List</li>
            </ul>
        </div>
    </div>
</section>
<!-- End Page Title -->

<!-- shop-page-section -->
<section class="shop-page-section p_relative">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-3 col-md-12 col-sm-12 sidebar-side">
                <div class="shop-sidebar mr_20">
                    <!-- Search Widget -->
                    <div class="search-widget sidebar-widget">
                        <div class="widget-title">
                            <h4>Search</h4>
                        </div>
                        <form action="{{ route('public.products.index') }}" method="GET">
                            <div class="form-group">
                                <input type="search" name="search" placeholder="Search products..." value="{{ $search ?? '' }}">
                                <button type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <!-- Category Widget -->
                    <div class="category-widget sidebar-widget">
                        <div class="widget-title">
                            <h4>Categories</h4>
                        </div>
                        <div class="widget-content">
                            <ul class="category-list clearfix">
                                @foreach($categories as $category)
                                    <li><a href="{{ route('public.products.index', ['category_id' => $category->id]) }}">{{ $category->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- Price Filter Widget -->
                    <div class="price-filter sidebar-widget">
                        <div class="widget-title">
                            <h4>By Price</h4>
                        </div>
                        <form action="{{ route('public.products.index') }}" method="GET">
                            <div class="range-slider clearfix p_relative">
                                <div class="price-range-slider"></div>
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <button type="submit" class="filter-btn">Filter</button>
                                    </div>
                                    <div class="pull-right">
                                        <p>Price:</p>
                                        <div class="title p_relative d_iblock"></div>
                                        <div class="input p_relative d_iblock">
                                            <input type="text" class="property-amount" name="price_range" readonly>
                                            <input type="hidden" name="price_min" class="price-min">
                                            <input type="hidden" name="price_max" class="price-max">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Tags Widget (Static for now, can be dynamic later) -->
                    <div class="tags-widget sidebar-widget">
                        <div class="widget-title">
                            <h4>Tags</h4>
                        </div>
                        <div class="widget-content">
                            <ul class="tags-list clearfix">
                                <li><a href="#">Eyecare</a></li>
                                <li><a href="#">Glass</a></li>
                                <li><a href="#">Lens</a></li>
                                <li><a href="#">Surgery</a></li>
                                <li><a href="#">Medicine</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-12 col-sm-12 content-side">
                <div class="our-shop">
                    <div class="item-shorting p_relative d_block clearfix mb_35">
                        <div class="left-column pull-left clearfix">
                            <div class="btn-box float_left p_relative clearfix mr_30">
                                <button class="grid-view on p_relative d_iblock fs_20 b_radius_5 mr_2 centred"> <i class="fas fa-th-large"></i> </button>
                                <button class="list-view p_relative d_iblock fs_20 b_radius_5 centred"><i class="fas fa-list"></i></button>
                            </div>
                            <div class="text float_left">
                                <p class="fs_16 font_family_poppins">
                                    Showing <span class="color_black">1–{{ $products->count() }}</span> of <span class="color_black">{{ $totalProducts }}</span> Results
                                </p>
                            </div>
                        </div>
                        <div class="right-column pull-right clearfix">
                            <div class="short-box clearfix">
                                <div class="select-box">
                                    <form action="{{ route('public.products.index') }}" method="GET">
                                        <select name="sort" class="wide" onchange="this.form.submit()">
                                            <option value="popularity" {{ request('sort') == 'popularity' ? 'selected' : '' }}>Popularity</option>
                                            <option value="new" {{ request('sort') == 'new' ? 'selected' : '' }}>New Collection</option>
                                            <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                                            <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                                        </select>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="wrapper grid">
                        <div class="shop-grid-content">
                            <div class="row clearfix">
                                @foreach($products as $product)
                                    @php
                                        $primaryImage = $product->images->where('isPrimary', 1)->first() ?? $product->images->first();
                                        $discountedPrice = $product->price * (1 - ($product->discount / 100));
                                    @endphp
                                    <div class="col-lg-4 col-md-6 col-sm-12 shop-block">
                                        <div class="shop-block-one">
                                            <div class="inner-box">
                                                <div class="image-box">
                                                    @if($product->discount > 0)
                                                        <span class="sale">Sale</span>
                                                    @elseif($product->quantity > 0)
                                                        <span class="hot">Hot</span>
                                                    @endif
                                                    <figure class="image">
                                                        <img src="{{ $primaryImage ? asset('storage/' . $primaryImage->image) : asset('PublicArea/images/shop-placeholder.png') }}"
                                                             alt="{{ $product->name }}">
                                                    </figure>
                                                    <ul class="option-list clearfix">
                                                        <li><a href="#"><i class="fas fa-shopping-cart"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-heart"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-exchange-alt"></i></a></li>
                                                        <li><a href="{{ $primaryImage ? asset('storage/' . $primaryImage->image) : '#' }}" class="lightbox-image" data-fancybox="gallery"><i class="fas fa-search-plus"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="lower-content">
                                                    <h5><a href="{{ route('public.products.show', $product->productId) }}">{{ $product->name }}</a></h5>
                                                    <ul class="rating clearfix">
                                                        @for ($i = 0; $i < 5; $i++)
                                                            <li><i class="fas fa-star"></i></li>
                                                        @endfor
                                                    </ul>
                                                    <span class="price">
                                                        @if($product->discount > 0)
                                                            <del>${{ number_format($product->price, 2) }}</del> ${{ number_format($discountedPrice, 2) }}
                                                        @else
                                                            ${{ number_format($product->price, 2) }}
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="pagination-wrapper centred mt_20">
                        {{-- {{ $products->appends(request()->query())->links('vendor.pagination.bootstrap-4') }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- shop-page-section -->

@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('PublicArea/css/jquery-ui.min.css') }}">
<style>
    .price-range-slider {
        margin-bottom: 20px;
    }
    .filter-btn {
        padding: 5px 15px;
        background-color: #03c0b4;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    .filter-btn:hover {
        background-color: #1abc9c;
    }
    .shop-block-one .image-box img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
</style>
@endpush

@push('js')
<script src="{{ asset('PublicArea/js/jquery.min.js') }}"></script>
<script src="{{ asset('PublicArea/js/jquery-ui.min.js') }}"></script>
<script>
    $(document).ready(function() {
        // Price Range Slider
        $(".price-range-slider").slider({
            range: true,
            min: 0,
            max: 1000,
            values: [{{ request('price_min', 0) }}, {{ request('price_max', 1000) }}],
            slide: function(event, ui) {
                $(".property-amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
                $(".price-min").val(ui.values[0]);
                $(".price-max").val(ui.values[1]);
            }
        });
        $(".property-amount").val("$" + $(".price-range-slider").slider("values", 0) +
            " - $" + $(".price-range-slider").slider("values", 1));

        // Grid/List View Toggle
        $('.grid-view').click(function() {
            $('.shop-grid-content').show();
            $('.shop-list-content').hide();
            $(this).addClass('on');
            $('.list-view').removeClass('on');
        });
        $('.list-view').click(function() {
            $('.shop-grid-content').hide();
            $('.shop-list-content').show();
            $(this).addClass('on');
            $('.grid-view').removeClass('on');
        });
    });
</script>
@endpush

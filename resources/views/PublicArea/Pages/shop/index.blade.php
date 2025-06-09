@extends('PublicArea.Layout.main')
@section('Publiccontainer')


        <!-- Page Title -->
        <section class="page-title">
            <div class="bg-layer" style="background-image: url({{ asset('PublicArea/images/background/page-title.jpg') }});"></div>
            <div class="auto-container">
                <div class="content-box">
                    <h1>Product List</h1>
                    <ul class="bread-crumb clearfix">
                        <li><a href="index.html">Home</a></li>
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
                            <div class="search-widget sidebar-widget">
                                <div class="widget-title">
                                    <h4>Search</h4>
                                </div>
                                <form action="shop.html" method="post">
                                    <div class="form-group">
                                        <input type="search" name="search-field" placeholder="Search" required="">
                                        <button type="submit"><i class="fas fa-search"></i></button>
                                    </div>
                                </form>
                            </div>
                            <div class="category-widget sidebar-widget">
                                <div class="widget-title">
                                    <h4>Categories</h4>
                                </div>
                                <div class="widget-content">
                                    <ul class="category-list clearfix">
                                        <li><a href="shop-details.html">Surgical Equipments (9)</a></li>
                                        <li><a href="shop-details.html">Vision Glass (1)</a></li>
                                        <li><a href="shop-details.html">Contact Lens (5)</a></li>
                                        <li><a href="shop-details.html">Medicine (3)</a></li>
                                        <li><a href="shop-details.html">Scissors (7)</a></li>
                                        <li><a href="shop-details.html">Medical Tool (2)</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="price-filter sidebar-widget">
                                <div class="widget-title">
                                    <h4>by Price</h4>
                                </div>
                                <div class="range-slider clearfix p_relative">
                                    <div class="price-range-slider"></div>
                                    <div class="clearfix">
                                        <div class="pull-left">
                                            <button class="filter-btn">Filter</button>
                                        </div>
                                        <div class="pull-right">
                                            <p>Price:</p>
                                            <div class="title p_relative d_iblock"></div>
                                            <div class="input p_relative d_iblock"><input type="text" class="property-amount" name="field-name" readonly=""></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tags-widget sidebar-widget">
                                <div class="widget-title">
                                    <h4>Tags</h4>
                                </div>
                                <div class="widget-content">
                                    <ul class="tags-list clearfix">
                                        <li><a href="shop-details.html">Eyecare</a></li>
                                        <li><a href="shop-details.html">Glass</a></li>
                                        <li><a href="shop-details.html">Lens</a></li>
                                        <li><a href="shop-details.html">Surgery</a></li>
                                        <li><a href="shop-details.html">Medicine</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-12 cols-sm-12 content-side">
                        <div class="our-shop">
                            <div class="item-shorting p_relative d_block clearfix mb_35">
                                <div class="left-column pull-left clearfix">
                                    <div class="btn-box float_left p_relative clearfix mr_30">
                                        <button class="grid-view on p_relative d_iblock fs_20 b_radius_5 mr_2 centred"> <i class="fas fa-th-large"></i> </button>
                                        <button class="list-view p_relative d_iblock fs_20 b_radius_5 centred"><i class="fas fa-list"></i> </button>
                                    </div>
                                    <div class="text float_left"><p class="fs_16 font_family_poppins">Showing <span class="color_black">1–12</span> of <span class="color_black">50</span> Results</p></div>
                                </div>
                                <div class="right-column pull-right clearfix">
                                    <div class="short-box clearfix">
                                        <div class="select-box">
                                            <select class="wide">
                                               <option data-display="Popularity">Popularity</option>
                                               <option value="1">New Collection</option>
                                               <option value="2">Top Sell</option>
                                               <option value="4">Top Ratted</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="wrapper grid">
                                <div class="shop-grid-content">
                                    <div class="row clearfix">
                                       <div class="col-lg-4 col-md-6 col-sm-12 shop-block">
    <div class="shop-block-one">
        <div class="inner-box">
            <div class="image-box">
                <span class="hot">Hot</span>
                <figure class="image"><img src="{{ asset('PublicArea/images/shop/shop-1.png') }}" alt=""></figure>
                <ul class="option-list clearfix">
                    <li><a href="shop.html"><i class="fas fa-shopping-cart"></i></a></li>
                    <li><a href="index-5.html"><i class="fas fa-heart"></i></a></li>
                    <li><a href="index-5.html"><i class="fas fa-exchange-alt"></i></a></li>
                    <li><a href="{{ asset('PublicArea/images/shop/shop-1.png') }}" class="lightbox-image" data-fancybox="gallery"><i class="fas fa-search-plus"></i></a></li>
                </ul>
            </div>
            <div class="lower-content">
                <h5><a href="shop-details.html">CM-4336 RG Luxury<br /> Stethoscope</a></h5>
                <ul class="rating clearfix">
                    <li><i class="fas fa-star"></i></li>
                    <li><i class="fas fa-star"></i></li>
                    <li><i class="fas fa-star"></i></li>
                    <li><i class="fas fa-star"></i></li>
                    <li><i class="fas fa-star"></i></li>
                </ul>
                <span class="price">$70.30</span>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-4 col-md-6 col-sm-12 shop-block">
    <div class="shop-block-one">
        <div class="inner-box">
            <div class="image-box">
                <figure class="image"><img src="{{ asset('PublicArea/images/shop/shop-2.png') }}" alt=""></figure>
                <ul class="option-list clearfix">
                    <li><a href="shop.html"><i class="fas fa-shopping-cart"></i></a></li>
                    <li><a href="index-5.html"><i class="fas fa-heart"></i></a></li>
                    <li><a href="index-5.html"><i class="fas fa-exchange-alt"></i></a></li>
                    <li><a href="{{ asset('PublicArea/images/shop/shop-2.png') }}" class="lightbox-image" data-fancybox="gallery"><i class="fas fa-search-plus"></i></a></li>
                </ul>
            </div>
            <div class="lower-content">
                <h5><a href="shop-details.html">LED Oral Lamp 8 LED <br />Light Bulbs</a></h5>
                <ul class="rating clearfix">
                    <li><i class="fas fa-star"></i></li>
                    <li><i class="fas fa-star"></i></li>
                    <li><i class="fas fa-star"></i></li>
                    <li><i class="fas fa-star"></i></li>
                    <li><i class="fas fa-star"></i></li>
                </ul>
                <span class="price">$80.30</span>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-4 col-md-6 col-sm-12 shop-block">
    <div class="shop-block-one">
        <div class="inner-box">
            <div class="image-box">
                <figure class="image"><img src="{{ asset('PublicArea/images/shop/shop-3.png') }}" alt=""></figure>
                <ul class="option-list clearfix">
                    <li><a href="shop.html"><i class="fas fa-shopping-cart"></i></a></li>
                    <li><a href="index-5.html"><i class="fas fa-heart"></i></a></li>
                    <li><a href="index-5.html"><i class="fas fa-exchange-alt"></i></a></li>
                    <li><a href="{{ asset('PublicArea/images/shop/shop-3.png') }}" class="lightbox-image" data-fancybox="gallery"><i class="fas fa-search-plus"></i></a></li>
                </ul>
            </div>
            <div class="lower-content">
                <h5><a href="shop-details.html">Frequency Adjustable <br />Stethoscope</a></h5>
                <ul class="rating clearfix">
                    <li><i class="fas fa-star"></i></li>
                    <li><i class="fas fa-star"></i></li>
                    <li><i class="fas fa-star"></i></li>
                    <li><i class="fas fa-star"></i></li>
                    <li><i class="fas fa-star"></i></li>
                </ul>
                <span class="price">$60.30</span>
            </div>
        </div>
    </div>
</div>


                                    </div>
                                </div>
                                <div class="shop-list-content">
                                    <div class="row clearfix">
                                        <div class="col-lg-4 col-md-6 col-sm-12 shop-block">
                                            <div class="shop-block-one">
                                                <div class="inner-box">
                                                    <div class="image-box">
                                                        <span class="sale">Sale</span>
                                                        <figure class="image"><img src="assets/images/shop/shop-4.png" alt=""></figure>
                                                        <ul class="option-list clearfix">
                                                            <li><a href="shop.html"><i class="icon-47"></i></a></li>
                                                            <li><a href="index-5.html"><i class="icon-48"></i></a></li>
                                                            <li><a href="index-5.html"><i class="icon-49"></i></a></li>
                                                            <li><a href="assets/images/shop/shop-4.png" class="lightbox-image" data-fancybox="gallery"><i class="icon-50"></i></a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="lower-content">
                                                        <h5><a href="shop-details.html">0.7-4.5X Binocular <br />Microscope</a></h5>
                                                        <ul class="rating clearfix">
                                                            <li><i class="icon-51"></i></li>
                                                            <li><i class="icon-51"></i></li>
                                                            <li><i class="icon-51"></i></li>
                                                            <li><i class="icon-51"></i></li>
                                                            <li><i class="icon-51"></i></li>
                                                        </ul>
                                                        <span class="price">$55.30</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12 shop-block">
                                            <div class="shop-block-one">
                                                <div class="inner-box">
                                                    <div class="image-box">
                                                        <span class="hot">Hot</span>
                                                        <figure class="image"><img src="assets/images/shop/shop-5.png" alt=""></figure>
                                                        <ul class="option-list clearfix">
                                                            <li><a href="shop.html"><i class="icon-47"></i></a></li>
                                                            <li><a href="index-5.html"><i class="icon-48"></i></a></li>
                                                            <li><a href="index-5.html"><i class="icon-49"></i></a></li>
                                                            <li><a href="assets/images/shop/shop-5.png" class="lightbox-image" data-fancybox="gallery"><i class="icon-50"></i></a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="lower-content">
                                                        <h5><a href="shop-details.html">Infrared Thermome- <br />ters Temperature</a></h5>
                                                        <ul class="rating clearfix">
                                                            <li><i class="icon-51"></i></li>
                                                            <li><i class="icon-51"></i></li>
                                                            <li><i class="icon-51"></i></li>
                                                            <li><i class="icon-51"></i></li>
                                                            <li><i class="icon-51"></i></li>
                                                        </ul>
                                                        <span class="price">$40.30</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12 shop-block">
                                            <div class="shop-block-one">
                                                <div class="inner-box">
                                                    <div class="image-box">
                                                        <figure class="image"><img src="assets/images/shop/shop-6.png" alt=""></figure>
                                                        <ul class="option-list clearfix">
                                                            <li><a href="shop.html"><i class="icon-47"></i></a></li>
                                                            <li><a href="index-5.html"><i class="icon-48"></i></a></li>
                                                            <li><a href="index-5.html"><i class="icon-49"></i></a></li>
                                                            <li><a href="assets/images/shop/shop-6.png" class="lightbox-image" data-fancybox="gallery"><i class="icon-50"></i></a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="lower-content">
                                                        <h5><a href="shop-details.html">Tankless Instant Electric <br />Water Heater</a></h5>
                                                        <ul class="rating clearfix">
                                                            <li><i class="icon-51"></i></li>
                                                            <li><i class="icon-51"></i></li>
                                                            <li><i class="icon-51"></i></li>
                                                            <li><i class="icon-51"></i></li>
                                                            <li><i class="icon-51"></i></li>
                                                        </ul>
                                                        <span class="price">$60.30</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12 shop-block">
                                            <div class="shop-block-one">
                                                <div class="inner-box">
                                                    <div class="image-box">
                                                        <figure class="image"><img src="assets/images/shop/shop-7.png" alt=""></figure>
                                                        <ul class="option-list clearfix">
                                                            <li><a href="shop.html"><i class="icon-47"></i></a></li>
                                                            <li><a href="index-5.html"><i class="icon-48"></i></a></li>
                                                            <li><a href="index-5.html"><i class="icon-49"></i></a></li>
                                                            <li><a href="assets/images/shop/shop-7.png" class="lightbox-image" data-fancybox="gallery"><i class="icon-50"></i></a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="lower-content">
                                                        <h5><a href="shop-details.html">Infrared Thermome- <br />ters Temperature</a></h5>
                                                        <ul class="rating clearfix">
                                                            <li><i class="icon-51"></i></li>
                                                            <li><i class="icon-51"></i></li>
                                                            <li><i class="icon-51"></i></li>
                                                            <li><i class="icon-51"></i></li>
                                                            <li><i class="icon-51"></i></li>
                                                        </ul>
                                                        <span class="price">$60.30</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12 shop-block">
                                            <div class="shop-block-one">
                                                <div class="inner-box">
                                                    <div class="image-box">
                                                        <span class="hot">Hot</span>
                                                        <figure class="image"><img src="assets/images/shop/shop-8.png" alt=""></figure>
                                                        <ul class="option-list clearfix">
                                                            <li><a href="shop.html"><i class="icon-47"></i></a></li>
                                                            <li><a href="index-5.html"><i class="icon-48"></i></a></li>
                                                            <li><a href="index-5.html"><i class="icon-49"></i></a></li>
                                                            <li><a href="assets/images/shop/shop-8.png" class="lightbox-image" data-fancybox="gallery"><i class="icon-50"></i></a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="lower-content">
                                                        <h5><a href="shop-details.html">Men's Electric Trimmer <br />in Black Shaver</a></h5>
                                                        <ul class="rating clearfix">
                                                            <li><i class="icon-51"></i></li>
                                                            <li><i class="icon-51"></i></li>
                                                            <li><i class="icon-51"></i></li>
                                                            <li><i class="icon-51"></i></li>
                                                            <li><i class="icon-51"></i></li>
                                                        </ul>
                                                        <span class="price">$80.30</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12 shop-block">
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
                                        <div class="col-lg-4 col-md-6 col-sm-12 shop-block">
                                            <div class="shop-block-one">
                                                <div class="inner-box">
                                                    <div class="image-box">
                                                        <figure class="image"><img src="assets/images/shop/shop-2.png" alt=""></figure>
                                                        <ul class="option-list clearfix">
                                                            <li><a href="shop.html"><i class="icon-47"></i></a></li>
                                                            <li><a href="index-5.html"><i class="icon-48"></i></a></li>
                                                            <li><a href="index-5.html"><i class="icon-49"></i></a></li>
                                                            <li><a href="assets/images/shop/shop-2.png" class="lightbox-image" data-fancybox="gallery"><i class="icon-50"></i></a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="lower-content">
                                                        <h5><a href="shop-details.html">LED Oral Lamp 8 LED <br />Light Bulbs</a></h5>
                                                        <ul class="rating clearfix">
                                                            <li><i class="icon-51"></i></li>
                                                            <li><i class="icon-51"></i></li>
                                                            <li><i class="icon-51"></i></li>
                                                            <li><i class="icon-51"></i></li>
                                                            <li><i class="icon-51"></i></li>
                                                        </ul>
                                                        <span class="price">$80.30</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12 shop-block">
                                            <div class="shop-block-one">
                                                <div class="inner-box">
                                                    <div class="image-box">
                                                        <figure class="image"><img src="assets/images/shop/shop-3.png" alt=""></figure>
                                                        <ul class="option-list clearfix">
                                                            <li><a href="shop.html"><i class="icon-47"></i></a></li>
                                                            <li><a href="index-5.html"><i class="icon-48"></i></a></li>
                                                            <li><a href="index-5.html"><i class="icon-49"></i></a></li>
                                                            <li><a href="assets/images/shop/shop-3.png" class="lightbox-image" data-fancybox="gallery"><i class="icon-50"></i></a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="lower-content">
                                                        <h5><a href="shop-details.html">Frequency Adjustable <br />Stethoscope</a></h5>
                                                        <ul class="rating clearfix">
                                                            <li><i class="icon-51"></i></li>
                                                            <li><i class="icon-51"></i></li>
                                                            <li><i class="icon-51"></i></li>
                                                            <li><i class="icon-51"></i></li>
                                                            <li><i class="icon-51"></i></li>
                                                        </ul>
                                                        <span class="price">$60.30</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12 shop-block">
                                            <div class="shop-block-one">
                                                <div class="inner-box">
                                                    <div class="image-box">
                                                        <figure class="image"><img src="assets/images/shop/shop-9.png" alt=""></figure>
                                                        <ul class="option-list clearfix">
                                                            <li><a href="shop.html"><i class="icon-47"></i></a></li>
                                                            <li><a href="index-5.html"><i class="icon-48"></i></a></li>
                                                            <li><a href="index-5.html"><i class="icon-49"></i></a></li>
                                                            <li><a href="assets/images/shop/shop-9.png" class="lightbox-image" data-fancybox="gallery"><i class="icon-50"></i></a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="lower-content">
                                                        <h5><a href="shop-details.html">Lead Portable EKG <br />Machine</a></h5>
                                                        <ul class="rating clearfix">
                                                            <li><i class="icon-51"></i></li>
                                                            <li><i class="icon-51"></i></li>
                                                            <li><i class="icon-51"></i></li>
                                                            <li><i class="icon-51"></i></li>
                                                            <li><i class="icon-51"></i></li>
                                                        </ul>
                                                        <span class="price">$50.30</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12 shop-block">
                                            <div class="shop-block-one">
                                                <div class="inner-box">
                                                    <div class="image-box">
                                                        <span class="hot">Hot</span>
                                                        <figure class="image"><img src="assets/images/shop/shop-10.png" alt=""></figure>
                                                        <ul class="option-list clearfix">
                                                            <li><a href="shop.html"><i class="icon-47"></i></a></li>
                                                            <li><a href="index-5.html"><i class="icon-48"></i></a></li>
                                                            <li><a href="index-5.html"><i class="icon-49"></i></a></li>
                                                            <li><a href="assets/images/shop/shop-10.png" class="lightbox-image" data-fancybox="gallery"><i class="icon-50"></i></a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="lower-content">
                                                        <h5><a href="shop-details.html">Aluminium Hammer Size <br />2 38mm 950gm</a></h5>
                                                        <ul class="rating clearfix">
                                                            <li><i class="icon-51"></i></li>
                                                            <li><i class="icon-51"></i></li>
                                                            <li><i class="icon-51"></i></li>
                                                            <li><i class="icon-51"></i></li>
                                                            <li><i class="icon-51"></i></li>
                                                        </ul>
                                                        <span class="price">$40.30</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12 shop-block">
                                            <div class="shop-block-one">
                                                <div class="inner-box">
                                                    <div class="image-box">
                                                        <span class="sale">Sale</span>
                                                        <figure class="image"><img src="assets/images/shop/shop-11.png" alt=""></figure>
                                                        <ul class="option-list clearfix">
                                                            <li><a href="shop.html"><i class="icon-47"></i></a></li>
                                                            <li><a href="index-5.html"><i class="icon-48"></i></a></li>
                                                            <li><a href="index-5.html"><i class="icon-49"></i></a></li>
                                                            <li><a href="assets/images/shop/shop-11.png" class="lightbox-image" data-fancybox="gallery"><i class="icon-50"></i></a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="lower-content">
                                                        <h5><a href="shop-details.html">Custom Leather Electrical <br />Tool Carrier</a></h5>
                                                        <ul class="rating clearfix">
                                                            <li><i class="icon-51"></i></li>
                                                            <li><i class="icon-51"></i></li>
                                                            <li><i class="icon-51"></i></li>
                                                            <li><i class="icon-51"></i></li>
                                                            <li><i class="icon-51"></i></li>
                                                        </ul>
                                                        <span class="price">$40.30</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12 shop-block">
                                            <div class="shop-block-one">
                                                <div class="inner-box">
                                                    <div class="image-box">
                                                        <figure class="image"><img src="assets/images/shop/shop-12.png" alt=""></figure>
                                                        <ul class="option-list clearfix">
                                                            <li><a href="shop.html"><i class="icon-47"></i></a></li>
                                                            <li><a href="index-5.html"><i class="icon-48"></i></a></li>
                                                            <li><a href="index-5.html"><i class="icon-49"></i></a></li>
                                                            <li><a href="assets/images/shop/shop-12.png" class="lightbox-image" data-fancybox="gallery"><i class="icon-50"></i></a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="lower-content">
                                                        <h5><a href="shop-details.html">Westek Battery Operated <br />Wall Sconces</a></h5>
                                                        <ul class="rating clearfix">
                                                            <li><i class="icon-51"></i></li>
                                                            <li><i class="icon-51"></i></li>
                                                            <li><i class="icon-51"></i></li>
                                                            <li><i class="icon-51"></i></li>
                                                            <li><i class="icon-51"></i></li>
                                                        </ul>
                                                        <span class="price">$90.30</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pagination-wrapper centred mt_20 centred">
                                <ul class="pagination clearfix">
                                    <li><a href="shop.html" class="current">1</a></li>
                                    <li><a href="shop.html">2</a></li>
                                    <li><a href="shop.html">3</a></li>
                                    <li class="dot">...</li>
                                    <li><a href="shop.html">9</a></li>
                                    <li><a href="shop.html"><i class="fas fa-angle-right"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- shop-page-section -->


        <!-- subscribe-section -->

        <!-- subscribe-section end -->

@endsection

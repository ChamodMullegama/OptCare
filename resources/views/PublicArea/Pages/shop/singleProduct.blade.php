@extends('PublicArea.Layout.main')
@section('Publiccontainer')

     <!-- Page Title -->
        <section class="page-title">
          <div class="bg-layer" style="background-image: url({{ asset('PublicArea/images/background/page-title.jpg') }});"></div>

            <div class="auto-container">
                <div class="content-box">
                    <h1>Single Product</h1>
                    <ul class="bread-crumb clearfix">
                        <li><a href="index.html">Home</a></li>
                        <li>Single Product</li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- End Page Title -->


        <!-- shop-details -->

        <!-- shop-details -->
     <!-- shop-details -->
<section class="shop-details p_relative pt_120 pb_70">
    <div class="auto-container">
        <div class="product-details-content p_relative d_block mb_110">
            <div class="row align-items-center clearfix">
                <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                    <div class="image-box p_relative d_block mr_20">
                        <figure class="image">
                            <img src="{{ asset('PublicArea/images/shop/shop-13.png') }}" alt="CM-4336 RG Luxury Stethoscope">
                        </figure>
                        <div class="preview-link p_absolute t_20 r_20">
                            <a href="{{ asset('PublicArea/images/shop/shop-13.png') }}" class="lightbox-image p_relative d_iblock fs_20 centred z_1 w_50 h_50 color_black lh_55" data-fancybox="gallery">
                                <i class="fas fa-search"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                    <div class="product-details p_relative d_block ml_20">
                        <h2 class="d_block fs_30 lh_35 fw_sbold mb_11">CM-4336 RG Luxury <br />Stethoscope</h2>
                        <div class="customer-rating clearfix p_relative d_block mb_5">
                            <ul class="rating clearfix">
                                <li class="p_relative d_iblock pull-left mr_3 fs_15"><i class="fas fa-star"></i></li>
                                <li class="p_relative d_iblock pull-left mr_3 fs_15"><i class="fas fa-star"></i></li>
                                <li class="p_relative d_iblock pull-left mr_3 fs_15"><i class="fas fa-star"></i></li>
                                <li class="p_relative d_iblock pull-left mr_3 fs_15"><i class="fas fa-star"></i></li>
                                <li class="p_relative d_iblock pull-left mr_5 fs_15"><i class="fas fa-star"></i></li>
                            </ul>
                        </div>
                        <span class="price p_relative d_block fs_20 lh_30 fw_medium mb_25">$70.30</span>
                        <div class="text p_relative d_block mb_30">
                            <p class="mb_25">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
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
                                    <a href="shop-details.html" class="d_iblock p_relative fs_20 lh_50 w_50 h_50 centred b_radius_50">
                                        <i class="fas fa-heart"></i>
                                    </a>
                                </li>
                                <li class="p_relative d_block float_left mr_10">
                                    <a href="shop.html" class="d_iblock p_relative fs_20 lh_50 w_50 h_50 centred b_radius_50">
                                        <i class="fas fa-share-alt"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="other-option">
                            <ul class="list">
                                <li class="p_relative d_block fs_16 font_family_poppins mb_5"><span class="fw_medium color_black">Product ID:</span> AZ-2305</li>
                                <li class="p_relative d_block fs_16 font_family_poppins mb_5"><span class="fw_medium color_black">Category:</span> Accessories</li>
                                <li class="p_relative d_block fs_16 font_family_poppins"><span class="fw_medium color_black">Tags:</span>
                                    <a href="shop-details.html">Binocular</a>,
                                    <a href="shop-details.html">Lens</a>,
                                    <a href="shop-details.html">Laser</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                            <p class="mb_25">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident.</p>
                        </div>
                    </div>
                    <div class="tab" id="tab-2">
                        <div class="customer-inner">
                            <div class="customer-review p_relative d_block pb_65 mb_65">
                                <h4 class="p_relative d_block fs_20 lh_30 fw_medium fw_sbold mb_40">CM-4336 RG Luxury Stethoscope</h4>
                                <div class="comment-box p_relative d_block pl_110">
                                    <figure class="comment-thumb p_absolute l_0 t_0 w_80 h_80 b_radius_55">
                                        <img src="{{ asset('PublicArea/images/shop/comment-1.jpg') }}" alt="Reviewer">
                                    </figure>
                                    <h5 class="d_block fs_18 lh_20 fw_sbold">Keanu Reeves<span class="d_iblock fs_16 font_family_poppins"> - May 1, 2021</span></h5>
                                    <ul class="rating clearfix mb_15">
                                        <li class="p_relative d_iblock pull-left mr_3 fs_13"><i class="fas fa-star"></i></li>
                                        <li class="p_relative d_iblock pull-left mr_3 fs_13"><i class="fas fa-star"></i></li>
                                        <li class="p_relative d_iblock pull-left mr_3 fs_13"><i class="fas fa-star"></i></li>
                                        <li class="p_relative d_iblock pull-left mr_3 fs_13"><i class="fas fa-star"></i></li>
                                        <li class="p_relative d_iblock pull-left mr_5 fs_13"><i class="far fa-star"></i></li>
                                    </ul>
                                    <div class="text">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="customer-comments p_relative">
                                <h4 class="p_relative d_block fs_20 lh_30 fw_medium fw_sbold mb_25">Be the First to Add a Review</h4>
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
                                            <textarea name="message" required></textarea>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group mb_15">
                                            <label class="p_relative d_block fs_16 mb_3 font_family_poppins">Your Name</label>
                                            <input type="text" name="name" required>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group mb_15">
                                            <label class="p_relative d_block fs_16 mb_3 font_family_poppins">Your Email</label>
                                            <input type="email" name="email" required>
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
                                <figure class="image">
                                    <img src="{{ asset('PublicArea/images/shop/shop-1.png') }}" alt="CM-4336 RG Luxury Stethoscope">
                                </figure>
                                <ul class="option-list clearfix">
                                    <li><a href="shop.html"><i class="fas fa-shopping-cart"></i></a></li>
                                    <li><a href="index-5.html"><i class="fas fa-heart"></i></a></li>
                                    <li><a href="index-5.html"><i class="fas fa-exchange-alt"></i></a></li>
                                    <li><a href="{{ asset('PublicArea/images/shop/shop-1.png') }}" class="lightbox-image" data-fancybox="gallery"><i class="fas fa-search"></i></a></li>
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
                <div class="col-lg-3 col-md-6 col-sm-12 shop-block">
                    <div class="shop-block-one">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image">
                                    <img src="{{ asset('PublicArea/images/shop/shop-2.png') }}" alt="LED Oral Lamp 8 LED Light Bulbs">
                                </figure>
                                <ul class="option-list clearfix">
                                    <li><a href="shop.html"><i class="fas fa-shopping-cart"></i></a></li>
                                    <li><a href="index-5.html"><i class="fas fa-heart"></i></a></li>
                                    <li><a href="index-5.html"><i class="fas fa-exchange-alt"></i></a></li>
                                    <li><a href="{{ asset('PublicArea/images/shop/shop-2.png') }}" class="lightbox-image" data-fancybox="gallery"><i class="fas fa-search"></i></a></li>
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
                <div class="col-lg-3 col-md-6 col-sm-12 shop-block">
                    <div class="shop-block-one">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image">
                                    <img src="{{ asset('PublicArea/images/shop/shop-3.png') }}" alt="Frequency Adjustable Stethoscope">
                                </figure>
                                <ul class="option-list clearfix">
                                    <li><a href="shop.html"><i class="fas fa-shopping-cart"></i></a></li>
                                    <li><a href="index-5.html"><i class="fas fa-heart"></i></a></li>
                                    <li><a href="index-5.html"><i class="fas fa-exchange-alt"></i></a></li>
                                    <li><a href="{{ asset('PublicArea/images/shop/shop-3.png') }}" class="lightbox-image" data-fancybox="gallery"><i class="fas fa-search"></i></a></li>
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
                <div class="col-lg-3 col-md-6 col-sm-12 shop-block">
                    <div class="shop-block-one">
                        <div class="inner-box">
                            <div class="image-box">
                                <span class="sale">Sale</span>
                                <figure class="image">
                                    <img src="{{ asset('PublicArea/images/shop/shop-4.png') }}" alt="0.7-4.5X Binocular Microscope">
                                </figure>
                                <ul class="option-list clearfix">
                                    <li><a href="shop.html"><i class="fas fa-shopping-cart"></i></a></li>
                                    <li><a href="index-5.html"><i class="fas fa-heart"></i></a></li>
                                    <li><a href="index-5.html"><i class="fas fa-exchange-alt"></i></a></li>
                                    <li><a href="{{ asset('PublicArea/images/shop/shop-4.png') }}" class="lightbox-image" data-fancybox="gallery"><i class="fas fa-search"></i></a></li>
                                </ul>
                            </div>
                            <div class="lower-content">
                                <h5><a href="shop-details.html">0.7-4.5X Binocular <br />Microscope</a></h5>
                                <ul class="rating clearfix">
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                </ul>
                                <span class="price">$55.30</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- shop-details end -->


        <!-- shop-details end -->
        <!-- shop-details end -->
@endsection

@extends('PublicArea.Layout.main')
@section('Publiccontainer')

   <!-- Page Title -->
        <section class="page-title">
            <div class="bg-layer" style="background-image: url({{ asset('PublicArea/images/background/page-title.jpg') }});"></div>
            <div class="auto-container">
                <div class="content-box">
                    <h1>Checkout</h1>
                    <ul class="bread-crumb clearfix">
                        <li><a href="index.html">Home</a></li>
                        <li>Checkout</li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- End Page Title -->


              <!-- checkout-section -->
        <section class="checkout-section p_relative pt_120 pb_120">
            <div class="container">

                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12 left-column">
                        <div class="inner-box">
                            <div class="billing-info p_relative d_block mb_55">
                                <h4 class="sub-title d_block fs_30 lh_40 mb_30">Billing Details</h4>
                                <form action="#" method="post" class="billing-form p_relative d_block">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label class="p_relative d_block fs_16 color_black mb_2">First Name*</label>
                                            <div class="field-input">
                                                <input type="text" name="first_name">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label class="p_relative d_block fs_16 color_black mb_2">Last Name*</label>
                                            <div class="field-input">
                                                <input type="text" name="last_name">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                            <label class="p_relative d_block fs_16 color_black mb_2">Company Name*</label>
                                            <div class="field-input">
                                                <input type="text" name="company_name">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                            <label class="p_relative d_block fs_16 color_black mb_2">Email Address*</label>
                                            <div class="field-input">
                                                <input type="email" name="email">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label class="p_relative d_block fs_16 color_black mb_2">Phone Number*</label>
                                            <div class="field-input">
                                                <input type="text" name="phone">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label class="p_relative d_block fs_16 color_black mb_2">Country*</label>
                                            <div class="select-column select-box">
                                                <select class="selectmenu" id="ui-id-1">
                                                    <option selected="selected">Select Option</option>
                                                    <option>United State</option>
                                                    <option>Australia</option>
                                                    <option>Canada</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                            <label class="p_relative d_block fs_16 color_black mb_2">Address*</label>
                                            <div class="field-input">
                                                <input type="text" name="address" class="address">
                                                <input type="text" name="address">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                            <label class="p_relative d_block fs_16 color_black mb_2">Town/City*</label>
                                            <div class="field-input">
                                                <input type="text" name="town_city">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label class="p_relative d_block fs_16 color_black mb_2">State*</label>
                                            <div class="select-column select-box">
                                                <select class="selectmenu" id="ui-id-2">
                                                    <option selected="selected">Select Option</option>
                                                    <option>United State</option>
                                                    <option>Australia</option>
                                                    <option>Canada</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <label class="p_relative d_block fs_16 color_black mb_2">Zip Code*</label>
                                            <div class="field-input">
                                                <input type="text" name="zip">
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                            <div class="create-acc p_relative d_block mt_3">
                                                <div class="check-box">
                                                    <input class="check" type="checkbox" id="checkbox">
                                                    <label for="checkbox">Create an Account?</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="additional-info">
                                <div class="note-book p_relative d_block">
                                    <label class="p_relative d_block fs_16 color_black mb_2">Order Notes</label>
                                    <textarea name="note_box" placeholder="Notes about your order, e.g. special notes for your delivery"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 right-column">
                        <div class="inner-box">
                            <div class="order-info p_relative d_block pt_45 pr_50 pb_25 pl_50 mb_60">
                                <h4 class="sub-title d_block fs_24 lh_30 mb_25">Your Order</h4>
                                <div class="order-product">
                                    <ul class="order-list clearfix">
                                        <li class="p_relative d_block clearfix pt_17 pb_16">
                                            <h6 class="fs_18 lh_20 pull-left fw_medium">Tankless Instant Electric <br />Water Heater</h6>
                                            <span class="p_relative d_block pull-right fs_16 fw_medium color_black">$70.30</span>
                                        </li>
                                        <li class="p_relative d_block clearfix pt_17 pb_16">
                                            <h6 class="fs_18 lh_20 pull-left fw_medium">Glass Pendant Light Hanging <br />Lamps Lighting</h6>
                                            <span class="p_relative d_block pull-right fs_16 fw_medium color_black">$25.50</span>
                                        </li>
                                        <li class="p_relative d_block clearfix pt_17 pb_16">
                                            <h6 class="fs_18 lh_20 pull-left fw_medium">Westek Battery Operated <br />Wall Sconces</h6>
                                            <span class="p_relative d_block pull-right fs_16 fw_medium color_black">$90.00</span>
                                        </li>
                                        <li class="sub-total p_relative d_block clearfix pt_17 pb_16">
                                            <h6 class="fs_18 fw_medium lh_20 pull-left">Sub Total</h6>
                                            <span class="p_relative d_block pull-right fs_16 fw_medium color_black light">$150.00</span>
                                        </li>
                                        <li class="order-total p_relative d_block clearfix pt_17 pb_16">
                                            <h6 class="fs_18 fw_bold lh_20 pull-left">Order Total</h6>
                                            <span class="p_relative d_block pull-right fs_16 fw_bold color_black">$150.00</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="payment-info p_relative d_block pt_45 pr_50 pb_50 pl_50">
                                <h4 class="sub-title d_block fs_24 lh_30 mb_40">Payment</h4>
                                <div class="payment-inner p_relative d_block pt_25 pr_30 pb_20 pl_30 mb_30">
                                    <div class="option-block pb_12 mb_13">
                                        <div class="check-box">
                                            <input class="check" type="checkbox" id="checkbox2" checked>
                                            <label for="checkbox2" class="fs_16 fw_medium color_black">Direct Bank Transfer</label>
                                        </div>
                                        <p class="fs_14 font_family_poppins pl_30">Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                                    </div>
                                    <div class="option-block clearfix">
                                        <div class="check-box pull-left mr_25">
                                            <input class="check" type="checkbox" id="checkbox3">
                                            <label for="checkbox3" class="fs_16 fw_medium color_black">Paypal</label>
                                        </div>
                                        <div class="link pull-left">
                                            <a href="checkout.html" class="fs_16 fw_medium color_black">What is Paypal?</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="btn-box">
                                    <a href="checkout.html" class="theme-btn btn-one">Place Your Order</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- checkout-section end -->


@endsection

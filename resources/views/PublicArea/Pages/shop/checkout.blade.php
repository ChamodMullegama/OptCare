@extends('PublicArea.Layout.main')
@section('Publiccontainer')

<!-- Page Title -->
<section class="page-title">
    <div class="bg-layer" style="background-image: url({{ asset('PublicArea/images/background/page-title.jpg') }});"></div>
    <div class="auto-container">
        <div class="content-box">
            <h1>Checkout</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home') }}">Home</a></li>
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
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label class="p_relative d_block fs_16 color_black mb_2">First Name*</label>
                                    <div class="field-input">
                                        <input type="text" name="first_name" value="{{ Session::get('customer_name') }}">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label class="p_relative d_block fs_16 color_black mb_2">Email Address*</label>
                                    <div class="field-input">
                                        <input type="email" name="email" value="{{ Session::get('customer_email') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <label class="p_relative d_block fs_16 color_black mb_2">Phone Number*</label>
                                    <div class="field-input">
                                        <input type="text" name="phone" value="">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <label class="p_relative d_block fs_16 color_black mb_2">Country*</label>
                                    <div class="field-input">
                                        <input type="text" name="phone" value="">
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
                                  <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label class="p_relative d_block fs_16 color_black mb_2">State*</label>
                                    <div class="field-input">
                                        <input type="text" name="town_city">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <label class="p_relative d_block fs_16 color_black mb_2">Zip Code*</label>
                                    <div class="field-input">
                                        <input type="text" name="zip">
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
                                @forelse($cartItems as $cartItem)
                                <li class="p_relative d_block clearfix pt_17 pb_16">
                                    <h6 class="fs_18 lh_20 pull-left fw_medium">{{ $cartItem->product->name }}</h6>
                                    <span class="p_relative d_block pull-right fs_16 fw_medium color_black">Rs.{{ number_format($cartItem->price * (1 - ($cartItem->discount / 100)), 2) }}</span>
                                </li>
                                @empty
                                <li>No items in cart.</li>
                                @endforelse
                                <li class="sub-total p_relative d_block clearfix pt_17 pb_16">
                                    <h6 class="fs_18 fw_medium lh_20 pull-left">Sub Total</h6>
                                    <span class="p_relative d_block pull-right fs_16 fw_medium color_black light">Rs.{{ number_format($subtotal, 2) }}</span>
                                </li>
                                <li class="order-total p_relative d_block clearfix pt_17 pb_16">
                                    <h6 class="fs_18 fw_bold lh_20 pull-left">Order Total</h6>
                                    <span class="p_relative d_block pull-right fs_16 fw_bold color_black">Rs.{{ number_format($total, 2) }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="payment-info p_relative d_block pt_45 pr_50 pb_50 pl_50">
                        <h4 class="sub-title d_block fs_24 lh_30 mb_40">Payment</h4>

                        <div class="btn-box">
                            <a href="#" class="theme-btn btn-one">Place Your Order</a>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- checkout-section end -->

@endsection

@extends('PublicArea.Layout.main')
@section('Publiccontainer')

        <!-- Page Title -->
        <section class="page-title">
      <div class="bg-layer" style="background-image: url({{ asset('PublicArea/images/background/page-title.jpg') }});"></div>
            <div class="auto-container">
                <div class="content-box">
                    <h1>Cart Page</h1>
                    <ul class="bread-crumb clearfix">
                        <li><a href="index.html">Home</a></li>
                        <li>Cart Page</li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- End Page Title -->

        <!-- cart section -->
               <!-- cart section -->
 <section class="cart-section p_relative pt_120 pb_120 bg-color-4">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 table-column">
                <div class="table-outer">
                    <table class="cart-table">
                        <thead class="cart-header">
                            <tr>
                                <th>&nbsp;</th>
                                <th class="prod-column">Product Name</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <th class="price">Price</th>
                                <th class="quantity">Quantity</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="4" class="prod-column">
                                    <div class="column-box">
                                        <div class="remove-btn" style="cursor:pointer;">
                                            <!-- Changed icon to Font Awesome trash -->
                                            <i class="fas fa-trash"></i>
                                        </div>
                                        <div class="prod-thumb">
                                            <img src="assets/images/shop/cart-1.png" alt="">
                                        </div>
                                        <div class="prod-title">
                                            CM-4336 RG Luxury <br />Stethoscope
                                        </div>
                                    </div>
                                </td>
                                <td class="price">$70.30</td>
                                <td class="qty">
                                    <div class="item-quantity">
                                        <input class="quantity-spinner" type="text" value="1" name="quantity">
                                    </div>
                                </td>
                                <td class="sub-total">$70.30</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="othre-content clearfix">
            <div class="update-btn pull-right">
                <button type="button" class="theme-btn btn-one">Update Cart</button>
            </div>
        </div>
        <div class="cart-total">
            <div class="row">
                <div class="col-xl-5 col-lg-12 col-md-12 offset-xl-7 cart-column">
                    <div class="total-cart-box clearfix">
                        <h3 class="fs_20 fw_sbold lh_30 d_block">Cart Totals</h3>
                        <ul class="list clearfix mb_30">
                            <li>Subtotal:<span>$150.50</span></li>
                            <li>Order Total:<span>$150.50</span></li>
                        </ul>
                        <!-- Added a Font Awesome right arrow icon -->
                        <a href="cart.html" class="theme-btn btn-one">
                            Proceed to Checkout <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
        <!-- cart section end -->
        <!-- cart section end -->



@endsection

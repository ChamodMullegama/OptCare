@extends('PublicArea.Layout.main')
@section('Publiccontainer')

<!-- Page Title -->
<section class="page-title">
    <div class="bg-layer" style="background-image: url({{ asset('PublicArea/images/background/page-title.jpg') }});"></div>
    <div class="auto-container">
        <div class="content-box">
            <h1>Cart Page</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Cart Page</li>
            </ul>
        </div>
    </div>
</section>
<!-- End Page Title -->

<!-- cart section -->
<section class="cart-section p_relative pt_120 pb_120 bg-color-4">
    <div class="auto-container">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 table-column">
                <div class="table-outer">
                    <table class="cart-table">
                        <thead class="cart-header">
                            <tr>
                                <th> </th>
                                <th class="prod-column">Product Name</th>
                                <th> </th>
                                <th> </th>
                                <th class="price">Price</th>
                                <th class="quantity">Quantity</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($cartItems as $cartItem)
                            <tr class="cart-item">
                                <td colspan="4" class="prod-column">
                                    <div class="column-box">
                                        <div class="remove-btn">
                                            <form action="{{ route('cart.remove') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="cart_item_id" value="{{ $cartItem->id }}">
                                                <button type="submit" class="d_iblock p_relative fs_20 lh_50 w_50 h_50 centred b_radius_50">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                        <div class="prod-thumb">
                                            <img src="{{ asset('storage/' . ($cartItem->product->images->where('isPrimary', 1)->first()->image ?? ($cartItem->product->images->first()->image ?? 'default.jpg'))) }}" alt="{{ $cartItem->product->name }}">
                                        </div>
                                        <div class="prod-title">
                                            {{ $cartItem->product->name }}
                                        </div>
                                    </div>
                                </td>
                                <td class="price">
                                    @if($cartItem->discount > 0)
                                        <del>Rs.{{ number_format($cartItem->price, 2) }}</del> Rs.{{ number_format($cartItem->price * (1 - ($cartItem->discount / 100)), 2) }}
                                    @else
                                        Rs.{{ number_format($cartItem->price, 2) }}
                                    @endif
                                </td>
                               <td class="qty">

        <form action="{{ route('cart.update') }}" method="POST" class="quantity-form">
            @csrf
            <input type="hidden" name="cart_item_id" value="{{ $cartItem->id }}">
            <input class="quantity-spinner" type="number" value="{{ $cartItem->quantity }}" name="quantity" min="1">
            <button type="submit" class="theme-btn btn-two update-btn">Update</button>
        </form>

</td>
                                <td class="sub-total">Rs.{{ number_format($cartItem->subtotal, 2) }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">Your cart is empty.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="cart-total">
            <div class="row">
                <div class="col-xl-5 col-lg-12 col-md-12 offset-xl-7 cart-column">
                    <div class="total-cart-box clearfix">
                        <h3 class="fs_20 fw_sbold lh_30 d_block">Cart Totals</h3>
                        <ul class="list clearfix mb_30">
                            <li>Subtotal:<span>Rs.{{ number_format($subtotal, 2) }}</span></li>
                            <li>Order Total:<span>Rs.{{ number_format($total, 2) }}</span></li>
                        </ul>
                        <a href="{{ route('checkout') }}" class="theme-btn btn-one">
    Proceed to Checkout <i class="fas fa-arrow-right"></i>
</a>
<br><br>
                        <a href="{{ route('public.products.index') }}" class="theme-btn btn-one">
   <i class="fas fa-arrow-left"></i> Continua Shopping
</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- cart section end -->

@push('css')
<style>
    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 4px;
    }
    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
    .quantity-form {
        display: flex;
        align-items: center;
    }
    .quantity-spinner {
        width: 60px;
        text-align: center;
        margin: 0 10px;
        padding: 5px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }
    .update-btn {
        padding: 5px 10px;
        font-size: 14px;
    }
</style>
@endpush

@endsection

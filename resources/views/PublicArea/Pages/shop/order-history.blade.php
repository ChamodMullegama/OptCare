@extends('PublicArea.Layout.main')
@section('Publiccontainer')

<!-- Page Title -->
<section class="page-title">
    <div class="bg-layer" style="background-image: url({{ asset('PublicArea/images/background/page-title.jpg') }});"></div>
    <div class="auto-container">
        <div class="content-box">
            <h1>Order History</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Order History</li>
            </ul>
        </div>
    </div>
</section>
<!-- End Page Title -->

<!-- order-history-section -->
<section class="order-history-section p_relative pt_120 pb_120 bg-color-4">
    <div class="auto-container">
        @if (session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                {{ session('error') }}
            </div>
        @endif

        @forelse($orders as $order)
            <div class="order-card mb-4">
                <div class="order-header">
                    <div class="row align-items-center">
                        <div class="col-md-3">
                            <div class="order-info">
                                <h4 class="order-id">Order #{{ $order->id }}</h4>
                                <p class="order-date">{{ $order->created_at->format('d M Y, h:i A') }}</p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="order-status">
                                <span class="status-badge status-{{ strtolower($order->status) }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="payment-status">
                                <span class="payment-badge payment-{{ strtolower($order->payment_status) }}">
                            @if($order->payment_status === 'completed')
    <span style="background-color: #d4edda; color: #155724; padding: 6px 12px; font-size: 14px; border-radius: 6px; font-weight: 600;">
        Paid
    </span>
@else
    <span style="background-color: #f8d7da; color: #721c24; padding: 6px 12px; font-size: 14px; border-radius: 6px; font-weight: 600;">
        Unpaid
    </span>
@endif


                                </span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="order-total">
                                <h5>Total: <span class="amount">Rs.{{ number_format($order->total, 2) }}</span></h5>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-outline-primary btn-sm view-details" data-order-id="{{ $order->id }}">
                                <i class="fas fa-eye"></i> View Details
                            </button>
                        </div>
                    </div>
                </div>

                <div class="order-items">
                    @foreach($order->orderItems as $index => $item)
                        <div class="item-row">
                            <div class="row align-items-center">
                                <div class="col-md-1">
                                    <div class="item-number">{{ $index + 1 }}</div>
                                </div>
                                <div class="col-md-2">
                                    <div class="product-image">
                                        <img src="{{ asset('storage/' . ($item->product->images->where('isPrimary', 1)->first()->image ?? ($item->product->images->first()->image ?? 'default.jpg'))) }}"
                                             alt="{{ $item->product->name }}"
                                             class="img-fluid product-thumb">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="product-info">
                                        <h6 class="product-name">{{ $item->product->name }}</h6>
                                        @if($item->product->sku)
                                            <small class="product-sku text-muted">SKU: {{ $item->product->sku }}</small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="item-price">
                                        @if($item->discount > 0)
                                            <div class="price-original">
                                                <del class="text-muted">Rs.{{ number_format($item->price, 2) }}</del>
                                            </div>
                                            <div class="price-discounted">
                                                Rs.{{ number_format($item->price * (1 - ($item->discount / 100)), 2) }}
                                            </div>
                                            <small class="discount-badge">{{ $item->discount }}% OFF</small>
                                        @else
                                            <div class="price-regular">Rs.{{ number_format($item->price, 2) }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="item-quantity">
                                        <span class="qty-badge">{{ $item->quantity }}</span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="item-subtotal">
                                        <strong>Rs.{{ number_format($item->subtotal, 2) }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="order-details-section" id="details-{{ $order->id }}" style="display: none;">
                    <div class="details-content">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="billing-info">
                                    <h5><i class="fas fa-user"></i> Billing Information</h5>
                                    <div class="info-group">
                                        <p><strong>Name:</strong> {{ $order->first_name }}</p>
                                        <p><strong>Email:</strong> {{ $order->email }}</p>
                                        <p><strong>Phone:</strong> {{ $order->phone }}</p>
                                    </div>
                                    <div class="address-group">
                                        <p><strong>Address:</strong></p>
                                        <address>
                                            {{ $order->address }}<br>
                                            {{ $order->town_city }}, {{ $order->state }} {{ $order->zip }}<br>
                                            {{ $order->country }}
                                        </address>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="order-summary">
                                    <h5><i class="fas fa-receipt"></i> Order Summary</h5>
                                    <div class="summary-row">
                                        <span>Items ({{ $order->orderItems->sum('quantity') }}):</span>
                                        <span>Rs.{{ number_format($order->orderItems->sum('subtotal'), 2) }}</span>
                                    </div>
                                    @if($order->shipping_cost > 0)
                                    <div class="summary-row">
                                        <span>Shipping:</span>
                                        <span>Rs.{{ number_format($order->shipping_cost, 2) }}</span>
                                    </div>
                                    @endif
                                    @if($order->tax > 0)
                                    <div class="summary-row">
                                        <span>Tax:</span>
                                        <span>Rs.{{ number_format($order->tax, 2) }}</span>
                                    </div>
                                    @endif
                                    <div class="summary-total">
                                        <span><strong>Total:</strong></span>
                                        <span><strong>Rs.{{ number_format($order->total, 2) }}</strong></span>
                                    </div>

                                    @if($order->payment_confirmation)
                                        <div class="payment-confirmation mt-3">
                                            <p><strong>Payment Confirmation:</strong> {{ $order->payment_confirmation }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        @if($order->note)
                            <div class="order-notes mt-3">
                                <h6><i class="fas fa-sticky-note"></i> Order Notes</h6>
                                <p class="note-content">{{ $order->note }}</p>
                            </div>
                        @endif

                        <div class="order-actions mt-4">
                            <a href="#" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-print"></i> Print Order
                            </a>
                            @if($order->status == 'delivered')
                                <a href="#" class="btn btn-outline-success btn-sm">
                                    <i class="fas fa-star"></i> Rate & Review
                                </a>
                            @endif
                            @if(in_array($order->status, ['pending', 'processing']))
                                <a href="#" class="btn btn-outline-danger btn-sm">
                                    <i class="fas fa-times"></i> Cancel Order
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="empty-orders">
                <div class="text-center py-5">
                    <i class="fas fa-shopping-bag empty-icon"></i>
                    <h3>No Orders Found</h3>
                    <p class="text-muted">You haven't placed any orders yet.</p>
                    <a href="{{ route('public.products.index') }}" class="btn btn-primary">
                        <i class="fas fa-shopping-cart"></i> Start Shopping
                    </a>
                </div>
            </div>
        @endforelse


    </div>
</section>
<!-- order-history-section end -->

@push('css')
<style>
    .alert {
        padding: 15px 20px;
        margin-bottom: 25px;
        border-radius: 8px;
        border: none;
        display: flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .alert-success {
        background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
        color: #155724;
    }
    .alert-danger {
        background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
        color: #721c24;
    }

    .order-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        border: 1px solid #e8ecef;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    .order-card:hover {
        box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        transform: translateY(-2px);
    }

    .order-header {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 20px 25px;
        border-bottom: 2px solid #dee2e6;
    }

    .order-id {
        font-size: 18px;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 5px;
    }
    .order-date {
        color: #6c757d;
        font-size: 14px;
        margin: 0;
    }

    .status-badge, .payment-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-pending { background: #fff3cd; color: #856404; }
    .status-processing { background: #cce5ff; color: #f17732; }
    .status-shipped { background: #d1ecf1; color: #0c5460; }
    .status-delivered { background: #d4edda; color: #155724; }
    .status-cancelled { background: #f8d7da; color: #721c24; }

    .payment-pending { background: #fff3cd; color: #856404; }
    .payment-paid { background: #d4edda; color: #155724; }
    .payment-failed { background: #f8d7da; color: #721c24; }

    .order-total .amount {
        color: #28a745;
        font-weight: 700;
    }

    .order-items {
        padding: 0;
    }

    .item-row {
        padding: 15px 25px;
        border-bottom: 1px solid #f1f3f4;
        transition: background-color 0.2s ease;
    }
    .item-row:hover {
        background-color: #f8f9fa;
    }
    .item-row:last-child {
        border-bottom: none;
    }

    .item-number {
        width: 30px;
        height: 30px;
        background: #f17732;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 14px;
    }

    .product-thumb {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
        border: 2px solid #e9ecef;
    }

    .product-name {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 5px;
        line-height: 1.3;
    }
    .product-sku {
        font-size: 12px;
        color: #6c757d;
    }

    .price-original del {
        font-size: 14px;
    }
    .price-discounted {
        color: #dc3545;
        font-weight: 600;
    }
    .discount-badge {
        background: #dc3545;
        color: white;
        padding: 2px 6px;
        border-radius: 10px;
        font-size: 10px;
        font-weight: 600;
        display: inline-block;
        margin-top: 3px;
    }

    .qty-badge {
        background: #6c757d;
        color: white;
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 600;
    }

    .item-subtotal {
        text-align: right;
        font-size: 16px;
        color: #28a745;
    }

    .order-details-section {
        background: #f8f9fa;
        border-top: 2px solid #dee2e6;
    }

    .details-content {
        padding: 25px;
    }

    .billing-info h5, .order-summary h5 {
        color: #495057;
        font-weight: 600;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .info-group p, .address-group p {
        margin-bottom: 8px;
        line-height: 1.5;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        padding: 8px 0;
        border-bottom: 1px solid #dee2e6;
    }
    .summary-total {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        font-size: 16px;
        background: #e9ecef;
        padding: 12px 15px;
        border-radius: 6px;
        margin-top: 10px;
    }

    .order-notes {
        background: white;
        padding: 15px;
        border-radius: 8px;
        border-left: 4px solid #f17732;
    }
    .note-content {
        font-style: italic;
        color: #6c757d;
    }

    .order-actions {
        text-align: center;
        padding-top: 20px;
        border-top: 1px solid #dee2e6;
    }
    .order-actions .btn {
        margin: 0 5px;
    }

    .empty-orders {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        padding: 60px 30px;
    }
    .empty-icon {
        font-size: 80px;
        color: #dee2e6;
        margin-bottom: 20px;
    }

    .order-summary-footer {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        padding: 30px;
        margin-top: 30px;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 20px;
        margin-top: 15px;
    }
    .stat-item {
        text-align: center;
        padding: 20px;
        background: #f8f9fa;
        border-radius: 8px;
        border: 2px solid #e9ecef;
    }
    .stat-number {
        display: block;
        font-size: 28px;
        font-weight: 700;
        color: #f17732;
        margin-bottom: 5px;
    }
    .stat-label {
        font-size: 14px;
        color: #6c757d;
        text-transform: uppercase;
        font-weight: 600;
    }

    .continue-shopping {
        text-align: center;
        padding: 40px 20px;
    }
    .continue-shopping h5 {
        margin-bottom: 20px;
        color: #495057;
    }

    .btn {
        border-radius: 6px;
        font-weight: 600;
        padding: 8px 16px;
        transition: all 0.3s ease;
    }
    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    @media (max-width: 768px) {
        .order-header .row > div {
            margin-bottom: 15px;
        }
        .order-header .row > div:last-child {
            margin-bottom: 0;
        }
        .item-row .row > div {
            margin-bottom: 10px;
        }
        .details-content {
            padding: 20px 15px;
        }
        .stats-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // View details toggle
        document.querySelectorAll('.view-details').forEach(button => {
            button.addEventListener('click', function() {
                const orderId = this.getAttribute('data-order-id');
                const detailsSection = document.getElementById('details-' + orderId);
                const isVisible = detailsSection.style.display !== 'none';

                // Toggle visibility
                detailsSection.style.display = isVisible ? 'none' : 'block';

                // Update button text and icon
                const icon = this.querySelector('i');
                if (isVisible) {
                    icon.className = 'fas fa-eye';
                    this.innerHTML = '<i class="fas fa-eye"></i> View Details';
                } else {
                    icon.className = 'fas fa-eye-slash';
                    this.innerHTML = '<i class="fas fa-eye-slash"></i> Hide Details';
                }

                // Smooth scroll to details if opening
                if (!isVisible) {
                    setTimeout(() => {
                        detailsSection.scrollIntoView({
                            behavior: 'smooth',
                            block: 'nearest'
                        });
                    }, 100);
                }
            });
        });

        // Add loading animation for buttons
        document.querySelectorAll('.btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                if (!this.classList.contains('view-details')) {
                    const originalText = this.innerHTML;
                    this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
                    this.disabled = true;

                    // Re-enable after 2 seconds (remove this in production)
                    setTimeout(() => {
                        this.innerHTML = originalText;
                        this.disabled = false;
                    }, 2000);
                }
            });
        });

        // Add fade-in animation to order cards
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.order-card').forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
            observer.observe(card);
        });
    });
</script>
@endpush
@endsection

@extends('AdminArea.Layout.main')
@section('Admincontainer')

<div class="app-hero-header d-flex align-items-center">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <i class="ri-home-8-line lh-1 pe-3 me-3 border-end"></i>
            <a href="{{ route('admin.dashboard') }}">Home</a>
        </li>
        <li class="breadcrumb-item text-primary" aria-current="page">
            Order Management
        </li>
    </ol>
</div>

<div class="app-body">
    <div class="row gx-3">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title">Order List</h5>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="ordersTable" class="table truncate m-0 align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>#{{ $order->id }}</td>
                                    <td>{{ $order->first_name }} ({{ $order->email }})</td>
                                    <td>{{ $order->created_at->format('d M Y') }}</td>
                                    <td>Rs.{{ number_format($order->total, 2) }}</td>
                                    <td>
                                        <span class="status-text status-{{ $order->status }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-inline-flex gap-1">
                                            <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                 <select name="status" onchange="this.form.submit()" class="form-select form-select-sm">
                <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}
                    {{ in_array($order->status, ['confirmed', 'shipped', 'cancelled']) ? 'disabled' : '' }}>
                    Pending
                </option>
                <option value="confirmed" {{ $order->status === 'confirmed' ? 'selected' : '' }}
                    {{ in_array($order->status, ['shipped', 'cancelled']) ? 'disabled' : '' }}>
                    Confirmed
                </option>
                <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}
                    {{ $order->status === 'cancelled' ? 'disabled' : '' }}>
                    Shipped
                </option>
                <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}
                    {{ in_array($order->status, ['confirmed', 'shipped']) ? 'disabled' : '' }}>
                    Cancelled
                </option>
            </select>
                                            </form>

                                            <!-- View Details Button -->
                                            <button class="btn btn-outline-primary btn-sm view-details"
                                                    data-order-id="{{ $order->id }}">
                                                <i class="ri-eye-line"></i>
                                            </button>

                                            <!-- Hidden Order Data -->
                                            <div class="order-data" id="order-data-{{ $order->id }}" style="display:none;">
                                                @php
                                                    $orderData = [
                                                        'id' => $order->id,
                                                        'first_name' => $order->first_name,
                                                        'email' => $order->email,
                                                        'created_at' => $order->created_at->format('d M Y'),
                                                        'total' => number_format($order->total, 2),
                                                        'status' => ucfirst($order->status),
                                                        'address' => $order->address,
                                                        'town_city' => $order->town_city,
                                                        'state' => $order->state,
                                                        'zip' => $order->zip,
                                                        'country' => $order->country,
                                                        'phone' => $order->phone,
                                                        'note' => $order->note ?? 'N/A',
                                                        'payment_status' => ucfirst($order->payment_status),
                                                        'payment_confirmation' => $order->payment_confirmation ?? 'N/A',
                                                        'order_items' => $order->orderItems->map(function ($item) {
                                                            $primaryImage = $item->product->images->where('isPrimary', 1)->first();
                                                            $fallbackImage = $item->product->images->first();
                                                            return [
                                                                'product_name' => $item->product->name,
                                                                'price' => number_format($item->price * (1 - ($item->discount / 100)), 2),
                                                                'quantity' => $item->quantity,
                                                                'subtotal' => number_format($item->subtotal, 2),
                                                                'image' => $primaryImage ? $primaryImage->image : ($fallbackImage ? $fallbackImage->image : 'default.jpg')
                                                            ];
                                                        })->toArray()
                                                    ];
                                                @endphp
                                                @json($orderData)
                                            </div>

                                            <button class="btn btn-outline-danger btn-sm" onclick="confirmDelete('{{ $order->id }}')">
                                                <i class="ri-delete-bin-line"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- View Order Modal -->
<div class="modal fade" id="viewOrderModal" tabindex="-1" aria-labelledby="viewOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewOrderModalLabel">Order Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="orderDetails">
                    <h6>Order Information</h6>
                    <p><strong>Order ID:</strong> <span id="orderId"></span></p>
                    <p><strong>Customer:</strong> <span id="customerName"></span> (<span id="customerEmail"></span>)</p>
                    <p><strong>Date:</strong> <span id="orderDate"></span></p>
                    <p><strong>Total:</strong> Rs.<span id="orderTotal"></span></p>
                    <p><strong>Status:</strong> <span id="orderStatus"></span></p>
                    <h6>Billing Information</h6>
                    <p><strong>Address:</strong> <span id="billingAddress"></span></p>
                    <p><strong>Phone:</strong> <span id="billingPhone"></span></p>
                    <p><strong>Notes:</strong> <span id="orderNotes"></span></p>
                    <p><strong>Payment Status:</strong> <span id="paymentStatus"></span></p>
                    <p><strong>Payment Confirmation:</strong> <span id="paymentConfirmation"></span></p>
                    <h6>Order Items</h6>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody id="orderItems">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteOrderModal" tabindex="-1" aria-labelledby="deleteOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="deleteOrderForm" action="{{ route('orders.delete') }}" method="POST">
                @csrf
                <input type="hidden" id="order_id" name="id">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteOrderModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <div class="mb-2">
                        <img src="{{ asset('AdminArea/images/bin.gif') }}" alt="Delete Confirmation" width="80">
                    </div>
                    <h5>Are you sure you want to delete this order?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('css')
<style>
    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 8px;
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
    .status-text {
        font-size: 14px;
        padding: 4px 8px;
        border-radius: 4px;
        font-weight: 500;
        display: inline-block;
    }
    .status-pending {
        background-color: #fef3c7;
        color: #d97706;
    }
    .status-confirmed {
        background-color: #d1fae5;
        color: #059669;
    }
    .status-shipped {
        background-color: #e0f2fe;
        color: #0284c7;
    }
    .status-cancelled {
        background-color: #fee2e2;
        color: #dc2626;
    }
    .btn-sm {
        padding: 6px 12px;
        font-size: 14px;
    }
    .form-select-sm {
        width: 120px;
        padding: 5px;
        font-size: 14px;
    }
    .order-table img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 6px;
    }
     .form-select-sm option:disabled {
        color: #ccc;
        background-color: #f8f9fa;
    }
    .order-table img {
        width: 80px; /* Increased from 50px */
        height: 80px; /* Increased from 50px */
        object-fit: cover;
        border-radius: 6px;
    }
</style>
@endpush

@push('js')
<script>
    // Handle delete confirmation
    function confirmDelete(id) {
        document.getElementById('order_id').value = id;
        $('#deleteOrderModal').modal('show');
    }

    // Handle view details
    document.querySelectorAll('.view-details').forEach(button => {
        button.addEventListener('click', function() {
            const orderId = this.getAttribute('data-order-id');
            const orderData = JSON.parse(document.getElementById(`order-data-${orderId}`).textContent);

            // Populate order details
            document.getElementById('orderId').textContent = `#${orderData.id}`;
            document.getElementById('customerName').textContent = orderData.first_name;
            document.getElementById('customerEmail').textContent = orderData.email;
            document.getElementById('orderDate').textContent = orderData.created_at;
            document.getElementById('orderTotal').textContent = orderData.total;
            document.getElementById('orderStatus').textContent = orderData.status;
            document.getElementById('billingAddress').textContent = `${orderData.address}, ${orderData.town_city}, ${orderData.state}, ${orderData.zip}, ${orderData.country}`;
            document.getElementById('billingPhone').textContent = orderData.phone;
            document.getElementById('orderNotes').textContent = orderData.note;
            document.getElementById('paymentStatus').textContent = orderData.payment_status;
            document.getElementById('paymentConfirmation').textContent = orderData.payment_confirmation;

            // Populate order items
            const orderItems = document.getElementById('orderItems');
            orderItems.innerHTML = '';
            orderData.order_items.forEach(item => {
                const row = document.createElement('tr');
                row.innerHTML = `
                  <td><img src="/storage/${item.image}" class="order-table img" style="width: 80px; height: 80px;"></td>
                    <td>${item.product_name}</td>
                    <td>Rs.${item.price}</td>
                    <td>${item.quantity}</td>
                    <td>Rs.${item.subtotal}</td>
                `;
                orderItems.appendChild(row);
            });

            // Show modal
            $('#viewOrderModal').modal('show');
        });
    });

    // Initialize DataTable
    $(document).ready(function() {
        $('#ordersTable').DataTable({
            "pageLength": 10,
            "order": [[3, "desc"]]
        });
    });
</script>
@endpush

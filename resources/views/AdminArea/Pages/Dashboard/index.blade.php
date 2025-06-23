@extends('AdminArea.Layout.main')
@section('Admincontainer')

<div class="app-container">
    <!-- App hero header starts -->
    <div class="app-hero-header d-flex align-items-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <i class="ri-home-8-line lh-1 pe-3 me-3 border-end"></i>
                <a href="{{ route('admin.dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item text-primary" aria-current="page">Dashboard</li>
        </ol>
        <div class="ms-auto d-lg-flex d-none flex-row">
            <div class="d-flex flex-row gap-1 day-sorting">
                <button class="btn btn-sm btn-primary">Today</button>
                <button class="btn btn-sm">7d</button>
                <button class="btn btn-sm">2w</button>
                <button class="btn btn-sm">1m</button>
                <button class="btn btn-sm">3m</button>
                <button class="btn btn-sm">6m</button>
                <button class="btn btn-sm">1y</button>
            </div>
        </div>
    </div>
    <!-- App Hero header ends -->

    <!-- App body starts -->
    <div class="app-body">
        <!-- Overview Row -->
        <div class="row gx-3">
            <div class="col-xxl-12 col-sm-12">
                <div class="card mb-3 bg-2">
                    <div class="card-body">
                        <div class="py-4 px-3 text-white">
                            <h6>Good Morning,</h6>
                            <h2>{{ session('admin.name', 'Admin') }}</h2>
                            <h5>Your website overview today.</h5>
                            <div class="mt-4 d-flex gap-3">
                                <div class="d-flex align-items-center">
                                    <div class="icon-box lg bg-arctic rounded-3 me-3">
                                        <i class="ri-stethoscope-line fs-4"></i>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <h2 class="m-0 lh-1">{{ $totalDoctors }}</h2>
                                        <p class="m-0">Doctors</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="icon-box lg bg-lime rounded-3 me-3">
                                        <i class="ri-calendar-check-line fs-4"></i>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <h2 class="m-0 lh-1">{{ $totalAppointments }}</h2>
                                        <p class="m-0">Appointments</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="icon-box lg bg-peach rounded-3 me-3">
                                        <i class="ri-user-line fs-4"></i>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <h2 class="m-0 lh-1">{{ $totalCustomers }}</h2>
                                        <p class="m-0">Customers</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="icon-box lg bg-warning rounded-3 me-3">
                                        <i class="ri-shopping-cart-line fs-4"></i>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <h2 class="m-0 lh-1">{{ $totalOrders }}</h2>
                                        <p class="m-0">Orders</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Status Row -->
        <div class="row gx-3">
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="p-2 border border-success rounded-circle me-3">
                                <div class="icon-box md bg-success-subtle rounded-5">
                                    <i class="ri-shopping-cart-line fs-4 text-success"></i>
                                </div>
                            </div>
                            <div class="d-flex flex-column">
                                <h2 class="lh-1">{{ $ordersPending }}</h2>
                                <p class="m-0">Pending Orders</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-end justify-content-between mt-1">
                            <a class="text-success" href="">View All<i class="ri-arrow-right-line ms-1"></i></a>
                            <div class="text-end">
                                <p class="mb-0 text-success">+{{ rand(10, 50) }}%</p>
                                <span class="badge bg-success-subtle text-success small">this month</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="p-2 border border-primary rounded-circle me-3">
                                <div class="icon-box md bg-primary-subtle rounded-5">
                                    <i class="ri-check-double-line fs-4 text-primary"></i>
                                </div>
                            </div>
                            <div class="d-flex flex-column">
                                <h2 class="lh-1">{{ $ordersCompleted }}</h2>
                                <p class="m-0">Completed Orders</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-end justify-content-between mt-1">
                            <a class="text-primary" href="">View All<i class="ri-arrow-right-line ms-1"></i></a>
                            <div class="text-end">
                                <p class="mb-0 text-primary">+{{ rand(5, 40) }}%</p>
                                <span class="badge bg-primary-subtle text-primary small">this month</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="p-2 border border-danger rounded-circle me-3">
                                <div class="icon-box md bg-danger-subtle rounded-5">
                                    <i class="ri-close-circle-line fs-4 text-danger"></i>
                                </div>
                            </div>
                            <div class="d-flex flex-column">
                                <h2 class="lh-1">{{ $ordersCancelled }}</h2>
                                <p class="m-0">Cancelled Orders</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-end justify-content-between mt-1">
                            <a class="text-danger" href="">View All<i class="ri-arrow-right-line ms-1"></i></a>
                            <div class="text-end">
                                <p class="mb-0 text-danger">+{{ rand(5, 30) }}%</p>
                                <span class="badge bg-danger-subtle text-danger small">this month</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="p-2 border border-warning rounded-circle me-3">
                                <div class="icon-box md bg-warning-subtle rounded-5">
                                    <i class="ri-truck-line fs-4 text-warning"></i>
                                </div>
                            </div>
                            <div class="d-flex flex-column">
                                <h2 class="lh-1">{{ $ordersShipped }}</h2>
                                <p class="m-0">Shipped Orders</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-end justify-content-between mt-1">
                            <a class="text-warning" href="">View All<i class="ri-arrow-right-line ms-1"></i></a>
                            <div class="text-end">
                                <p class="mb-0 text-warning">+{{ rand(10, 60) }}%</p>
                                <span class="badge bg-warning-subtle text-warning small">this month</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Appointment Status Row -->
        <div class="row gx-3">
            <div class="col-xl-4 col-sm-6 col-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="p-2 border border-success rounded-circle me-3">
                                <div class="icon-box md bg-success-subtle rounded-5">
                                    <i class="ri-check-double-line fs-4 text-success"></i>
                                </div>
                            </div>
                            <div class="d-flex flex-column">
                                <h2 class="lh-1">{{ $appointmentsConfirmed }}</h2>
                                <p class="m-0">Confirmed Appointments</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-end justify-content-between mt-1">
                            <a class="text-success" href="">View All<i class="ri-arrow-right-line ms-1"></i></a>
                            <div class="text-end">
                                <p class="mb-0 text-success">+{{ rand(10, 50) }}%</p>
                                <span class="badge bg-success-subtle text-success small">this month</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 col-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="p-2 border border-danger rounded-circle me-3">
                                <div class="icon-box md bg-danger-subtle rounded-5">
                                    <i class="ri-close-circle-line fs-4 text-danger"></i>
                                </div>
                            </div>
                            <div class="d-flex flex-column">
                                <h2 class="lh-1">{{ $appointmentsCancelled }}</h2>
                                <p class="m-0">Cancelled Appointments</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-end justify-content-between mt-1">
                            <a class="text-danger" href="">View All<i class="ri-arrow-right-line ms-1"></i></a>
                            <div class="text-end">
                                <p class="mb-0 text-danger">+{{ rand(5, 30) }}%</p>
                                <span class="badge bg-danger-subtle text-danger small">this month</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 col-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="p-2 border border-warning rounded-circle me-3">
                                <div class="icon-box md bg-warning-subtle rounded-5">
                                    <i class="ri-time-line fs-4 text-warning"></i>
                                </div>
                            </div>
                            <div class="d-flex flex-column">
                                <h2 class="lh-1">{{ $appointmentsPending }}</h2>
                                <p class="m-0">Pending Appointments</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-end justify-content-between mt-1">
                            <a class="text-warning" href="">View All<i class="ri-arrow-right-line ms-1"></i></a>
                            <div class="text-end">
                                <p class="mb-0 text-warning">+{{ rand(10, 60) }}%</p>
                                <span class="badge bg-warning-subtle text-warning small">this month</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Best Product, Best Doctor, Best Customer, Low Stock -->
        <div class="row gx-3">
            <div class="col-xl-6 col-sm-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title">Best Selling Product</h5>
                    </div>
                    <div class="card-body">
                        @if($bestProduct)
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('storage/' . ($bestProduct->images->where('isPrimary', true)->first()->image ?? 'uploads/products/default.jpg')) }}" alt="{{ $bestProduct->name }}" class="img-fluid me-3" style="width: 100px; height: 100px; object-fit: cover;">
                            <div>
                                <h6>{{ $bestProduct->name }}</h6>
                                <p class="m-0">Total Sold: {{ $bestProduct->total_sold }}</p>
                                <p class="m-0">Price: Rs.{{ $bestProduct->price }}</p>
                            </div>
                        </div>
                        @else
                        <p>No sales data available.</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-sm-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title">Best Doctor</h5>
                    </div>
                    <div class="card-body">
                        @if($bestDoctor)
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('storage/' . ($bestDoctor->profile_image ?? 'uploads/doctors/default.jpg')) }}" alt="{{ $bestDoctor->first_name }}" class="img-fluid me-3" style="width: 100px; height: 100px; object-fit: cover;">
                            <div>
                                <h6>{{ $bestDoctor->first_name }} {{ $bestDoctor->last_name }}</h6>
                                <p class="m-0">Completed Appointments: {{ $bestDoctor->completed_appointments }}</p>
                                <p class="m-0">Specialization: {{ $bestDoctor->designation }}</p>
                            </div>
                        </div>
                        @else
                        <p>No appointment data available.</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-sm-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title">Best Customer</h5>
                    </div>
                    <div class="card-body">
                        @if($bestCustomer)
                        <div class="d-flex align-items-center">
                            <div class="icon-box lg bg-primary rounded-3 me-3">
                                <i class="ri-user-line fs-4"></i>
                            </div>
                            <div>
                                <h6>{{ $bestCustomer->first_name }} {{ $bestCustomer->last_name }}</h6>
                                <p class="m-0">Total Purchases: Rs.{{ $bestCustomer->total_spent }}</p>
                                <p class="m-0">Orders: {{ $bestCustomer->total_orders }}</p>
                            </div>
                        </div>
                        @else
                        <p>No customer purchase data available.</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-sm-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title">Low Stock Products</h5>
                    </div>
                    <div class="card-body">
                        @if($lowStockProducts->isNotEmpty())
                        <ul class="list-group">
                            @foreach($lowStockProducts as $product)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $product->name }}
                                <span class="badge bg-danger rounded-pill">{{ $product->quantity }} in stock</span>
                            </li>
                            @endforeach
                        </ul>
                        @else
                        <p>No low stock products.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Latest Orders and Appointments -->
        <div class="row gx-3">
            <div class="col-xl-6 col-sm-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title">Latest 5 Orders</h5>
                    </div>
                    <div class="card-body">
                        @if($latestOrders->isNotEmpty())
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($latestOrders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->customer ? $order->customer->first_name . ' ' . $order->customer->last_name : 'N/A' }}</td>
                                    <td>Rs.{{ $order->total }}</td>
                                    <td>
                                        <span class="badge {{ $order->status == 'confirmed' ? 'bg-success' : ($order->status == 'cancelled' ? 'bg-danger' : ($order->status == 'shipped' ? 'bg-warning' : 'bg-secondary')) }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $order->created_at->format('Y-m-d') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <p>No recent orders available.</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-sm-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title">Latest 5 Appointments</h5>
                    </div>
                    <div class="card-body">
                        @if($latestAppointments->isNotEmpty())
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Appointment ID</th>
                                    <th>Doctor</th>
                                    <th>Patient</th>
                                    <th>Date & Time</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($latestAppointments as $appointment)
                                <tr>
                                    <td>{{ $appointment->appointmentId }}</td>
                                    <td>{{ $appointment->doctor ? $appointment->doctor->first_name . ' ' . $appointment->doctor->last_name : 'N/A' }}</td>
                                    <td>{{ $appointment->name }}</td>
                                    <td>{{ $appointment->date }} {{ $appointment->time }}</td>
                                    <td>
                                        <span class="badge {{ $appointment->status == 'completed' ? 'bg-success' : ($appointment->status == 'cancelled' ? 'bg-danger' : ($appointment->status == 'accepted' ? 'bg-primary' : 'bg-secondary')) }}">
                                            {{ ucfirst($appointment->status) }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <p>No recent appointments available.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="row gx-3">
            <div class="col-xl-6 col-lg-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title">Order Status Distribution</h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-height">
                            <div id="orderStatusChart" class="auto-align-graph"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title">Appointment Status Distribution</h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-height">
                            <div id="appointmentStatusChart" class="auto-align-graph"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title">Customer Messages Today</h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-height">
                            <div id="messagesChart" class="auto-align-graph"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-lg-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title">Total Income Over Time</h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-height">
                            <div id="incomeChart" class="auto-align-graph"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title">Doctors vs Customers</h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-height">
                            <div id="doctorsCustomersChart" class="auto-align-graph"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title">Low Stock Products</h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-height">
                            <div id="lowStockChart" class="auto-align-graph"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 col-lg-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title">Monthly Appointments Trend</h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-height">
                            <div id="monthlyAppointmentsChart" class="auto-align-graph"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- App body ends -->

</div>

@endsection

@push('js')

<script>
    // Order Status Distribution (Pie Chart)
    var orderStatusOptions = {
        series: [{{ $ordersPending }}, {{ $ordersCompleted }}, {{ $ordersCancelled }}, {{ $ordersShipped }}],
        chart: {
            type: 'pie',
            height: 350
        },
        labels: ['Pending', 'Completed', 'Cancelled', 'Shipped'],
        colors: ['#FFCE56', '#36A2EB', '#FF6384', '#4BC0C0'],
        dataLabels: {
            enabled: true,
            formatter: function(val) {
                return val.toFixed(1) + "%";
            }
        },
        legend: {
            position: 'bottom'
        },
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 200
                },
                legend: {
                    position: 'bottom'
                }
            }
        }]
    };
    var orderStatusChart = new ApexCharts(document.querySelector("#orderStatusChart"), orderStatusOptions);
    orderStatusChart.render();

    // Appointment Status Distribution (Donut Chart)
    var appointmentStatusOptions = {
        series: [{{ $appointmentsConfirmed }}, {{ $appointmentsCancelled }}, {{ $appointmentsPending }}],
        chart: {
            type: 'donut',
            height: 350
        },
        labels: ['Confirmed', 'Cancelled', 'Pending'],
        colors: ['#36A2EB', '#FF6384', '#FFCE56'],
        dataLabels: {
            enabled: true,
            formatter: function(val) {
                return val.toFixed(1) + "%";
            }
        },
        legend: {
            position: 'bottom'
        },
        plotOptions: {
            pie: {
                donut: {
                    labels: {
                        show: true,
                        total: {
                            show: true,
                            label: 'Total',
                            formatter: function(w) {
                                return {{ $totalAppointments }};
                            }
                        }
                    }
                }
            }
        }
    };
    var appointmentStatusChart = new ApexCharts(document.querySelector("#appointmentStatusChart"), appointmentStatusOptions);
    appointmentStatusChart.render();

    // Customer Messages (Radial Bar Chart)
    var messagesOptions = {
        series: [{{ $messagesToday }}],
        chart: {
            height: 350,
            type: 'radialBar',
        },
        plotOptions: {
            radialBar: {
                startAngle: -135,
                endAngle: 135,
                hollow: {
                    margin: 0,
                    size: '70%',
                },
                dataLabels: {
                    name: {
                        offsetY: -10,
                        color: '#333',
                        fontSize: '13px'
                    },
                    value: {
                        color: '#333',
                        fontSize: '30px',
                        show: true
                    }
                },
                track: {
                    background: '#e0e0e0',
                    strokeWidth: '97%',
                    margin: 5,
                }
            }
        },
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'dark',
                shadeIntensity: 0.15,
                inverseColors: false,
                opacityFrom: 1,
                opacityTo: 1,
                stops: [0, 50, 65, 91]
            },
        },
        stroke: {
            dashArray: 4
        },
        labels: ['Messages Today'],
        colors: ['#36A2EB']
    };
    var messagesChart = new ApexCharts(document.querySelector("#messagesChart"), messagesOptions);
    messagesChart.render();

    // Total Income Over Time (Area Chart)
    var incomeOptions = {
        series: [{
            name: "Total Income",
            data: [
                {{ $incomeData['jan'] ?? 0 }},
                {{ $incomeData['feb'] ?? 0 }},
                {{ $incomeData['mar'] ?? 0 }},
                {{ $incomeData['apr'] ?? 0 }},
                {{ $incomeData['may'] ?? 0 }},
                {{ $incomeData['jun'] ?? 0 }}
            ]
        }],
        chart: {
            type: 'area',
            height: 350,
            zoom: {
                enabled: false
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth',
            width: 2
        },
        colors: ['#4BC0C0'],
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        xaxis: {
            type: 'category',
        },
        yaxis: {
            opposite: false,
            title: {
                text: "Amount (Rs.)"
            }
        },
        legend: {
            horizontalAlign: 'left'
        },
        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.7,
                opacityTo: 0.3,
                stops: [0, 100]
            }
        },
    };
    var incomeChart = new ApexCharts(document.querySelector("#incomeChart"), incomeOptions);
    incomeChart.render();

    // Doctors vs Customers (Bar Chart)
    var doctorsCustomersOptions = {
        series: [{
            name: 'Doctors',
            data: [{{ $totalDoctors }}]
        }, {
            name: 'Customers',
            data: [{{ $totalCustomers }}]
        }],
        chart: {
            type: 'bar',
            height: 350
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'
            },
        },
        dataLabels: {
            enabled: false
        },
        colors: ['#36A2EB', '#4BC0C0'],
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        xaxis: {
            categories: ['Total'],
        },
        yaxis: {
            title: {
                text: 'Count'
            }
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return val
                }
            }
        }
    };
    var doctorsCustomersChart = new ApexCharts(document.querySelector("#doctorsCustomersChart"), doctorsCustomersOptions);
    doctorsCustomersChart.render();

    // Low Stock Gauge Chart
    var lowStockOptions = {
        series: [{{ $lowStockProducts->count() }}],
        chart: {
            height: 350,
            type: 'radialBar',
        },
        plotOptions: {
            radialBar: {
                startAngle: -135,
                endAngle: 135,
                hollow: {
                    margin: 0,
                    size: '70%',
                },
                dataLabels: {
                    name: {
                        fontSize: '16px',
                        color: '#333',
                        offsetY: -10
                    },
                    value: {
                        offsetY: 0,
                        fontSize: '22px',
                        color: '#333',
                        formatter: function (val) {
                            return val;
                        }
                    }
                },
                track: {
                    background: '#e0e0e0',
                    strokeWidth: '97%',
                    margin: 5,
                }
            }
        },
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'dark',
                shadeIntensity: 0.15,
                inverseColors: false,
                opacityFrom: 1,
                opacityTo: 1,
                stops: [0, 50, 65, 91]
            },
        },
        stroke: {
            dashArray: 4
        },
        labels: ['Low Stock Products'],
        colors: ['#FF6384']
    };
    var lowStockChart = new ApexCharts(document.querySelector("#lowStockChart"), lowStockOptions);
    lowStockChart.render();

    // Monthly Appointments Trend (Line Chart)
    // This would require additional data from your controller
    var monthlyAppointmentsOptions = {
        series: [{
            name: "Appointments",
            data: [30, 40, 45, 50, 49, 60, 70, 91, 125, 150, 170, 200]
        }],
        chart: {
            height: 350,
            type: 'line',
            zoom: {
                enabled: false
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'straight'
        },
        colors: ['#FF6384'],
        title: {
            text: 'Monthly Appointments Trend',
            align: 'left'
        },
        grid: {
            row: {
                colors: ['#f3f3f3', 'transparent'],
                opacity: 0.5
            },
        },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        },
        yaxis: {
            title: {
                text: 'Number of Appointments'
            }
        }
    };
    var monthlyAppointmentsChart = new ApexCharts(document.querySelector("#monthlyAppointmentsChart"), monthlyAppointmentsOptions);
    monthlyAppointmentsChart.render();
</script>
@endpush

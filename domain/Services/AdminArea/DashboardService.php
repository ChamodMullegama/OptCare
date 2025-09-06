<?php

namespace domain\Services\AdminArea;

use App\Models\Appointment;
use App\Models\Customer;
use App\Models\CustomerMessage;
use App\Models\Doctor;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardService
{
    protected $doctor;
    protected $appointment;
    protected $customer;
    protected $order;
    protected $customerMessage;
    protected $product;

    public function __construct()
    {
        $this->doctor = new Doctor();
        $this->appointment = new Appointment();
        $this->customer = new Customer();
        $this->order = new Order();
        $this->customerMessage = new CustomerMessage();
        $this->product = new Product();
    }

    public function getDashboardData()
    {
        try {
            // Total Doctors
            $totalDoctors = $this->doctor->count();

            // Total Appointments and Status Breakdown
            $totalAppointments = $this->appointment->count();
            $appointmentsCompleted = $this->appointment->where('status', 'completed')->count();
            $appointmentsCancelled = $this->appointment->where('status', 'canceled')->count();
            $appointmentsPending = $this->appointment->whereIn('status', ['pending', 'accepted'])->count();
            $appointmentsConfirmed = $this->appointment->where('status', 'completed')->count();

            // Total Customers
            $totalCustomers = $this->customer->count();

            // Total Orders and Status Breakdown
            $totalOrders = $this->order->count();
            $ordersPending = $this->order->where('status', 'pending')->count();
            $ordersCompleted = $this->order->where('status', 'confirmed')->count();
            $ordersCancelled = $this->order->where('status', 'cancelled')->count();
            $ordersShipped = $this->order->where('status', 'shipped')->count();

            // Customer Messages Today
            $messagesToday = $this->customerMessage->whereDate('created_at', Carbon::today())->count();

            // Best Selling Product
            $bestProduct = $this->product->select(
                'products.id',
                'products.productId',
                'products.name',
                'products.description',
                'products.quantity',
                'products.price',
                'products.product_color',
                'products.brand_name',
                'products.category_id',
                'products.discount',
                DB::raw('SUM(order_items.quantity) as total_sold')
            )
            ->join('order_items', 'products.id', '=', 'order_items.product_id')
            ->groupBy(
                'products.id',
                'products.productId',
                'products.name',
                'products.description',
                'products.quantity',
                'products.price',
                'products.product_color',
                'products.brand_name',
                'products.category_id',
                'products.discount'
            )
            ->orderByRaw('SUM(order_items.quantity) DESC')
            ->with(['images' => function ($query) {
                $query->where('isPrimary', true);
            }])
            ->first();

            // Best Doctor (by completed appointments)
            $bestDoctor = $this->doctor->select(
                'doctors.id',
                'doctors.doctorId',
                'doctors.first_name',
                'doctors.last_name',
                'doctors.age',
                'doctors.gender',
                'doctors.email',
                'doctors.mobile_number',
                'doctors.marital_status',
                'doctors.qualification',
                'doctors.designation',
                'doctors.blood_group',
                'doctors.address',
                'doctors.country',
                'doctors.state',
                'doctors.city',
                'doctors.postal_code',
                'doctors.profile_image',
                'doctors.bio',
                'doctors.availability',
                'doctors.username',
                DB::raw('COUNT(appointments.id) as completed_appointments')
            )
            ->join('appointments', 'doctors.doctorId', '=', 'appointments.doctorId')
            ->where('appointments.status', 'completed')
            ->groupBy(
                'doctors.id',
                'doctors.doctorId',
                'doctors.first_name',
                'doctors.last_name',
                'doctors.age',
                'doctors.gender',
                'doctors.email',
                'doctors.mobile_number',
                'doctors.marital_status',
                'doctors.qualification',
                'doctors.designation',
                'doctors.blood_group',
                'doctors.address',
                'doctors.country',
                'doctors.state',
                'doctors.city',
                'doctors.postal_code',
                'doctors.profile_image',
                'doctors.bio',
                'doctors.availability',
                'doctors.username'
            )
            ->orderByRaw('COUNT(appointments.id) DESC')
            ->first();

            // Best Customer (by total spent)
            $bestCustomer = $this->customer->select(
                'customers.id',
                'customers.first_name',
                'customers.last_name',
                'customers.email',
                'customers.phone',
                'customers.gender',
                'customers.birth_date',
                'customers.age',
                'customers.verified_account',
                'customers.avatar',
                DB::raw('SUM(orders.total) as total_spent'),
                DB::raw('COUNT(orders.id) as total_orders')
            )
            ->join('orders', 'customers.id', '=', 'orders.customer_id')
            ->where('orders.status', 'confirmed')
            ->groupBy(
                'customers.id',
                'customers.first_name',
                'customers.last_name',
                'customers.email',
                'customers.phone',
                'customers.gender',
                'customers.birth_date',
                'customers.age',
                'customers.verified_account',
                'customers.avatar'
            )
            ->orderByRaw('SUM(orders.total) DESC')
            ->first();

            // Low Stock Products (quantity <= 10)
            $lowStockProducts = $this->product->where('quantity', '<=', 10)->get();

            // Latest 5 Orders
            $latestOrders = $this->order->with('customer')
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();

            // Latest 5 Appointments
            $latestAppointments = $this->appointment->with('doctor')
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();

            // Total Income Over Time (last 6 months)
            $incomeData = $this->order->select(DB::raw('MONTH(created_at) as month, SUM(total) as total'))
                ->where('status', 'confirmed')
                ->where('created_at', '>=', Carbon::now()->subMonths(6))
                ->groupBy(DB::raw('MONTH(created_at)'))
                ->pluck('total', 'month')
                ->mapWithKeys(function ($total, $month) {
                    $monthNames = ['', 'jan', 'feb', 'mar', 'apr', 'may', 'jun', 'jul', 'aug', 'sep', 'oct', 'nov', 'dec'];
                    return [$monthNames[$month] => $total];
                });

            // Monthly Appointments Data (last 12 months)
            $monthlyAppointments = $this->appointment->select(DB::raw('MONTH(created_at) as month, COUNT(*) as count'))
                ->where('created_at', '>=', Carbon::now()->subMonths(12))
                ->groupBy(DB::raw('MONTH(created_at)'))
                ->pluck('count', 'month');

            return view('AdminArea.Pages.Dashboard.index', compact(
                'totalDoctors', 'totalAppointments', 'totalCustomers', 'totalOrders',
                'ordersPending', 'ordersCompleted', 'ordersCancelled', 'ordersShipped',
                'messagesToday', 'bestProduct', 'bestDoctor', 'bestCustomer', 'lowStockProducts',
                'appointmentsCompleted', 'appointmentsCancelled', 'appointmentsPending', 'appointmentsConfirmed',
                'latestOrders', 'latestAppointments', 'incomeData', 'monthlyAppointments'
            ));
        } catch (\Exception $e) {
            throw new \Exception('Failed to load admin dashboard data: ' . $e->getMessage());
        }
    }
}

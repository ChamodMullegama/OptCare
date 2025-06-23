<?php

namespace App\Http\Controllers\AdminArea;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Customer;
use App\Models\CustomerMessage;
use App\Models\Doctor;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;
use domain\Facades\AdminArea\Auth;
use domain\Facades\AdminArea\DashboardFacade;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{



    public function index()
    {
        return view('AdminArea.Pages.Dashboard.index');
    }

    public function dashboard()
    {
        try {
            return DashboardFacade::getDashboardData();
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }



    // public function dashboard()
    // {
    //     return view('AdminArea.Pages.Dashboard.index');
    // }

    //     public function index()
    //     {
    //         return view('AdminArea.Pages.Dashboard.index');
    //     }


    //    public function dashboard()
    //     {
    //         // Total Doctors
    //         $totalDoctors = Doctor::count();

    //         // Total Appointments and Status Breakdown
    //         $totalAppointments = Appointment::count();
    //         $appointmentsCompleted = Appointment::where('status', 'completed')->count();
    //         $appointmentsCancelled = Appointment::where('status', 'canceled')->count();
    //         $appointmentsPending = Appointment::whereIn('status', ['pending', 'accepted'])->count();
    //         $appointmentsConfirmed = Appointment::where('status', 'completed')->count();

    //         // Total Customers
    //         $totalCustomers = Customer::count();

    //         // Total Orders and Status Breakdown
    //         $totalOrders = Order::count();
    //         $ordersPending = Order::where('status', 'pending')->count();
    //         $ordersCompleted = Order::where('status', 'confirmed')->count();
    //         $ordersCancelled = Order::where('status', 'cancelled')->count();
    //         $ordersShipped = Order::where('status', 'shipped')->count();

    //         // Customer Messages Today
    //         $messagesToday = CustomerMessage::whereDate('created_at', Carbon::today())->count();

    //         // Best Selling Product
    //         $bestProduct = Product::select(
    //             'products.id',
    //             'products.productId',
    //             'products.name',
    //             'products.description',
    //             'products.quantity',
    //             'products.price',
    //             'products.product_color',
    //             'products.brand_name',
    //             'products.category_id',
    //             'products.discount',
    //             DB::raw('SUM(order_items.quantity) as total_sold')
    //         )
    //         ->join('order_items', 'products.id', '=', 'order_items.product_id')
    //         ->groupBy(
    //             'products.id',
    //             'products.productId',
    //             'products.name',
    //             'products.description',
    //             'products.quantity',
    //             'products.price',
    //             'products.product_color',
    //             'products.brand_name',
    //             'products.category_id',
    //             'products.discount'
    //         )
    //         ->orderByRaw('SUM(order_items.quantity) DESC')
    //         ->with(['images' => function ($query) {
    //             $query->where('isPrimary', true);
    //         }])
    //         ->first();

    //         // Best Doctor (by completed appointments)
    //         $bestDoctor = Doctor::select(
    //             'doctors.id',
    //             'doctors.doctorId',
    //             'doctors.first_name',
    //             'doctors.last_name',
    //             'doctors.age',
    //             'doctors.gender',
    //             'doctors.email',
    //             'doctors.mobile_number',
    //             'doctors.marital_status',
    //             'doctors.qualification',
    //             'doctors.designation',
    //             'doctors.blood_group',
    //             'doctors.address',
    //             'doctors.country',
    //             'doctors.state',
    //             'doctors.city',
    //             'doctors.postal_code',
    //             'doctors.profile_image',
    //             'doctors.bio',
    //             'doctors.availability',
    //             'doctors.username',
    //             DB::raw('COUNT(appointments.id) as completed_appointments')
    //         )
    //         ->join('appointments', 'doctors.doctorId', '=', 'appointments.doctorId')
    //         ->where('appointments.status', 'completed')
    //         ->groupBy(
    //             'doctors.id',
    //             'doctors.doctorId',
    //             'doctors.first_name',
    //             'doctors.last_name',
    //             'doctors.age',
    //             'doctors.gender',
    //             'doctors.email',
    //             'doctors.mobile_number',
    //             'doctors.marital_status',
    //             'doctors.qualification',
    //             'doctors.designation',
    //             'doctors.blood_group',
    //             'doctors.address',
    //             'doctors.country',
    //             'doctors.state',
    //             'doctors.city',
    //             'doctors.postal_code',
    //             'doctors.profile_image',
    //             'doctors.bio',
    //             'doctors.availability',
    //             'doctors.username'
    //         )
    //         ->orderByRaw('COUNT(appointments.id) DESC')
    //         ->first();

    //         // Best Customer (by total spent)
    //         $bestCustomer = Customer::select(
    //             'customers.id',
    //             'customers.first_name',
    //             'customers.last_name',
    //             'customers.email',
    //             'customers.phone',
    //             'customers.gender',
    //             'customers.birth_date',
    //             'customers.age',
    //             'customers.verified_account',
    //             'customers.avatar',
    //             DB::raw('SUM(orders.total) as total_spent'),
    //             DB::raw('COUNT(orders.id) as total_orders')
    //         )
    //         ->join('orders', 'customers.id', '=', 'orders.customer_id')
    //         ->where('orders.status', 'confirmed')
    //         ->groupBy(
    //             'customers.id',
    //             'customers.first_name',
    //             'customers.last_name',
    //             'customers.email',
    //             'customers.phone',
    //             'customers.gender',
    //             'customers.birth_date',
    //             'customers.age',
    //             'customers.verified_account',
    //             'customers.avatar'
    //         )
    //         ->orderByRaw('SUM(orders.total) DESC')
    //         ->first();

    //         // Low Stock Products (quantity <= 10)
    //         $lowStockProducts = Product::where('quantity', '<=', 10)->get();

    //         // Latest 5 Orders
    //         $latestOrders = Order::with('customer')
    //             ->orderBy('created_at', 'desc')
    //             ->take(5)
    //             ->get();

    //         // Latest 5 Appointments
    //         $latestAppointments = Appointment::with('doctor')
    //             ->orderBy('created_at', 'desc')
    //             ->take(5)
    //             ->get();

    //         // Total Income Over Time (sample monthly data for last 6 months)
    //         $incomeData = Order::select(DB::raw('MONTH(created_at) as month, SUM(total) as total'))
    //             ->where('status', 'confirmed')
    //             ->where('created_at', '>=', Carbon::now()->subMonths(6))
    //             ->groupBy(DB::raw('MONTH(created_at)'))
    //             ->pluck('total', 'month')
    //             ->mapWithKeys(function ($total, $month) {
    //                 $monthNames = ['', 'jan', 'feb', 'mar', 'apr', 'may', 'jun', 'jul', 'aug', 'sep', 'oct', 'nov', 'dec'];
    //                 return [$monthNames[$month] => $total];
    //             });

    //         // Monthly Appointments Data (for the trend chart)
    //         $monthlyAppointments = Appointment::select(DB::raw('MONTH(created_at) as month, COUNT(*) as count'))
    //             ->where('created_at', '>=', Carbon::now()->subMonths(12))
    //             ->groupBy(DB::raw('MONTH(created_at)'))
    //             ->pluck('count', 'month');

    //         return view('AdminArea.Pages.Dashboard.index', compact(
    //             'totalDoctors', 'totalAppointments', 'totalCustomers', 'totalOrders',
    //             'ordersPending', 'ordersCompleted', 'ordersCancelled', 'ordersShipped',
    //             'messagesToday', 'bestProduct', 'bestDoctor', 'bestCustomer', 'lowStockProducts',
    //             'appointmentsCompleted', 'appointmentsCancelled', 'appointmentsPending', 'appointmentsConfirmed',
    //             'latestOrders', 'latestAppointments', 'incomeData', 'monthlyAppointments'
    //         ));
    //     }


    //  public function dashboard()
    // {
    //     // Total Doctors
    //     $totalDoctors = Doctor::count();

    //     // Total Appointments and Status Breakdown
    //     $totalAppointments = Appointment::count();
    //     $appointmentsCompleted = Appointment::where('status', 'completed')->count();
    //     $appointmentsCancelled = Appointment::where('status', 'canceled')->count();
    //     $appointmentsPending = Appointment::whereIn('status', ['pending', 'accepted'])->count();
    //     $appointmentsConfirmed = Appointment::where('status', 'completed')->count(); // Assuming 'completed' is equivalent to 'confirmed'

    //     // Total Customers
    //     $totalCustomers = Customer::count();

    //     // Total Orders and Status Breakdown
    //     $totalOrders = Order::count();
    //     $ordersPending = Order::where('status', 'pending')->count();
    //     $ordersCompleted = Order::where('status', 'confirmed')->count();
    //     $ordersCancelled = Order::where('status', 'cancelled')->count();
    //     $ordersShipped = Order::where('status', 'shipped')->count();

    //     // Customer Messages Today
    //     $messagesToday = CustomerMessage::whereDate('created_at', Carbon::today())->count();

    //     // Best Selling Product
    //     $bestProduct = Product::select(
    //         'products.id',
    //         'products.productId',
    //         'products.name',
    //         'products.description',
    //         'products.quantity',
    //         'products.price',
    //         'products.product_color',
    //         'products.brand_name',
    //         'products.category_id',
    //         'products.discount',
    //         DB::raw('SUM(order_items.quantity) as total_sold')
    //     )
    //     ->join('order_items', 'products.id', '=', 'order_items.product_id')
    //     ->groupBy(
    //         'products.id',
    //         'products.productId',
    //         'products.name',
    //         'products.description',
    //         'products.quantity',
    //         'products.price',
    //         'products.product_color',
    //         'products.brand_name',
    //         'products.category_id',
    //         'products.discount'
    //     )
    //     ->orderByRaw('SUM(order_items.quantity) DESC')
    //     ->with(['images' => function ($query) {
    //         $query->where('isPrimary', true);
    //     }])
    //     ->first();

    //     // Best Doctor (by completed appointments)
    //     $bestDoctor = Doctor::select(
    //         'doctors.id',
    //         'doctors.doctorId',
    //         'doctors.first_name',
    //         'doctors.last_name',
    //         'doctors.age',
    //         'doctors.gender',
    //         'doctors.email',
    //         'doctors.mobile_number',
    //         'doctors.marital_status',
    //         'doctors.qualification',
    //         'doctors.designation',
    //         'doctors.blood_group',
    //         'doctors.address',
    //         'doctors.country',
    //         'doctors.state',
    //         'doctors.city',
    //         'doctors.postal_code',
    //         'doctors.profile_image',
    //         'doctors.bio',
    //         'doctors.availability',
    //         'doctors.username',
    //         DB::raw('COUNT(appointments.id) as completed_appointments')
    //     )
    //     ->join('appointments', 'doctors.doctorId', '=', 'appointments.doctorId')
    //     ->where('appointments.status', 'completed')
    //     ->groupBy(
    //         'doctors.id',
    //         'doctors.doctorId',
    //         'doctors.first_name',
    //         'doctors.last_name',
    //         'doctors.age',
    //         'doctors.gender',
    //         'doctors.email',
    //         'doctors.mobile_number',
    //         'doctors.marital_status',
    //         'doctors.qualification',
    //         'doctors.designation',
    //         'doctors.blood_group',
    //         'doctors.address',
    //         'doctors.country',
    //         'doctors.state',
    //         'doctors.city',
    //         'doctors.postal_code',
    //         'doctors.profile_image',
    //         'doctors.bio',
    //         'doctors.availability',
    //         'doctors.username'
    //     )
    //     ->orderByRaw('COUNT(appointments.id) DESC')
    //     ->first();

    //     // Best Customer (by total spent)
    //     $bestCustomer = Customer::select(
    //         'customers.id',
    //         'customers.first_name',
    //         'customers.last_name',
    //         'customers.email',
    //         'customers.phone',
    //         'customers.gender',
    //         'customers.birth_date',
    //         'customers.age',
    //         'customers.verified_account',
    //         'customers.avatar',
    //         DB::raw('SUM(orders.total) as total_spent'),
    //         DB::raw('COUNT(orders.id) as total_orders')
    //     )
    //     ->join('orders', 'customers.id', '=', 'orders.customer_id')
    //     ->where('orders.status', 'confirmed')
    //     ->groupBy(
    //         'customers.id',
    //         'customers.first_name',
    //         'customers.last_name',
    //         'customers.email',
    //         'customers.phone',
    //         'customers.gender',
    //         'customers.birth_date',
    //         'customers.age',
    //         'customers.verified_account',
    //         'customers.avatar'
    //     )
    //     ->orderByRaw('SUM(orders.total) DESC')
    //     ->first();

    //     // Low Stock Products (quantity <= 10)
    //     $lowStockProducts = Product::where('quantity', '<=', 10)->get();

    //     // Latest 5 Orders
    //     $latestOrders = Order::with('customer')
    //         ->orderBy('created_at', 'desc')
    //         ->take(5)
    //         ->get();

    //     // Latest 5 Appointments
    //     $latestAppointments = Appointment::with('doctor')
    //         ->orderBy('created_at', 'desc')
    //         ->take(5)
    //         ->get();

    //     // Total Income Over Time (sample monthly data for last 6 months)
    //     $incomeData = Order::select(DB::raw('MONTH(created_at) as month, SUM(total) as total'))
    //         ->where('status', 'confirmed')
    //         ->where('created_at', '>=', Carbon::now()->subMonths(6))
    //         ->groupBy(DB::raw('MONTH(created_at)'))
    //         ->pluck('total', 'month')
    //         ->mapWithKeys(function ($total, $month) {
    //             $monthNames = ['', 'jan', 'feb', 'mar', 'apr', 'may', 'jun', 'jul', 'aug', 'sep', 'oct', 'nov', 'dec'];
    //             return [$monthNames[$month] => $total];
    //         });

    //     return view('AdminArea.Pages.Dashboard.index', compact(
    //         'totalDoctors', 'totalAppointments', 'totalCustomers', 'totalOrders',
    //         'ordersPending', 'ordersCompleted', 'ordersCancelled', 'ordersShipped',
    //         'messagesToday', 'bestProduct', 'bestDoctor', 'bestCustomer', 'lowStockProducts',
    //         'appointmentsCompleted', 'appointmentsCancelled', 'appointmentsPending', 'appointmentsConfirmed',
    //         'latestOrders', 'latestAppointments', 'incomeData'
    //     ));
    // }


    // public function dashboard()
    // {
    //     // Total Doctors
    //     $totalDoctors = Doctor::count();

    //     // Total Appointments
    //     $totalAppointments = Appointment::count();

    //     // Total Customers
    //     $totalCustomers = Customer::count();

    //     // Total Orders
    //     $totalOrders = Order::count();

    //     // Order Statuses
    //     $pendingOrders = Order::where('status', 'pending')->count();
    //     $completedOrders = Order::where('status', 'confirmed')->count();
    //     $cancelledOrders = Order::where('status', 'cancelled')->count();
    //     $shippedOrders = Order::where('status', 'shipped')->count();

    //     // Percentage calculations
    //     $pendingOrdersPercentage = $totalOrders ? round(($pendingOrders / $totalOrders) * 100, 2) : 0;
    //     $completedOrdersPercentage = $totalOrders ? round(($completedOrders / $totalOrders) * 100, 2) : 0;
    //     $cancelledOrdersPercentage = $totalOrders ? round(($cancelledOrders / $totalOrders) * 100, 2) : 0;
    //     $shippedOrdersPercentage = $totalOrders ? round(($shippedOrders / $totalOrders) * 100, 2) : 0;

    //     // Today's Customer Messages
    //     $todayMessages = CustomerMessage::whereDate('created_at', Carbon::today())->count();

    //     // Best Customer
    //     $bestCustomer = Customer::join('orders', 'customers.id', '=', 'orders.customer_id')
    //         ->groupBy('customers.id', 'customers.first_name', 'customers.last_name')
    //         ->select('customers.first_name', 'customers.last_name', DB::raw('SUM(orders.total) as total_spent'))
    //         ->orderBy('total_spent', 'desc')
    //         ->first();

    //     // Best Product
    //     $bestProduct = Product::join('order_items', 'products.id', '=', 'order_items.product_id')
    //         ->groupBy('products.id', 'products.name')
    //         ->select('products.name', DB::raw('SUM(order_items.quantity) as total_sold'))
    //         ->orderBy('total_sold', 'desc')
    //         ->first();

    //     // Top Products for Chart
    //     $topProducts = Product::join('order_items', 'products.id', '=', 'order_items.product_id')
    //         ->groupBy('products.id', 'products.name')
    //         ->select('products.name', DB::raw('SUM(order_items.quantity) as total_sold'))
    //         ->orderBy('total_sold', 'desc')
    //         ->take(5)
    //         ->get();

    //     // Low Stock Products
    //     $lowStockProducts = Product::where('quantity', '<=', 10)->count();

    //     // Appointment Statuses
    //     $pendingAppointments = Appointment::where('status', 'pending')->count();
    //     $acceptedAppointments = Appointment::where('status', 'accepted')->count();
    //     $completedAppointments = Appointment::where('status', 'completed')->count();
    //     $cancelledAppointments = Appointment::where('status', 'cancelled')->count();

    //     // Total Income
    //     $totalIncome = Order::where('status', 'confirmed')->sum('total');

    //     // Monthly Income Trend
    //     $monthlyIncome = Order::where('status', 'confirmed')
    //         ->whereYear('created_at', Carbon::now()->year)
    //         ->groupBy(DB::raw('MONTH(created_at)'))
    //         ->select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(total) as total'))
    //         ->get();

    //     $monthlyIncomeLabels = $monthlyIncome->map(function ($item) {
    //         return Carbon::create()->month($item->month)->format('F');
    //     })->toArray();
    //     $monthlyIncomeData = $monthlyIncome->pluck('total')->toArray();

    //     return view('AdminArea.Pages.Dashboard.index', compact(
    //         'totalDoctors',
    //         'totalAppointments',
    //         'totalCustomers',
    //         'totalOrders',
    //         'pendingOrders',
    //         'completedOrders',
    //         'cancelledOrders',
    //         'shippedOrders',
    //         'pendingOrdersPercentage',
    //         'completedOrdersPercentage',
    //         'cancelledOrdersPercentage',
    //         'shippedOrdersPercentage',
    //         'todayMessages',
    //         'bestCustomer',
    //         'bestProduct',
    //         'lowStockProducts',
    //         'pendingAppointments',
    //         'acceptedAppointments',
    //         'completedAppointments',
    //         'cancelledAppointments',
    //         'totalIncome',
    //         'monthlyIncomeLabels',
    //         'monthlyIncomeData',
    //         'topProducts'
    //     ));
    // }

}

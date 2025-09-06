<?php

namespace App\Http\Controllers\AdminArea;

use App\Http\Controllers\Controller;
use App\Mail\OrderConfirmed;
use App\Models\Order;
use domain\Facades\AdminArea\OrderFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    //  public function index()
    // {
    //     $orders = Order::with('orderItems.product')->latest()->get();
    //     return view('AdminArea.Pages.Order.index', compact('orders'));
    // }

    // public function getOrderDetails($id)
    // {
    //     $order = Order::with('orderItems.product.images')->findOrFail($id);
    //     return response()->json(['order' => $order]);
    // }

    // public function updateStatus(Request $request, $id)
    // {
    //     $request->validate([
    //         'status' => 'required|in:confirmed,cancelled,shipped',
    //     ]);

    //     $order = Order::findOrFail($id);
    //     $order->status = $request->status;
    //     $order->save();

    //     // Send email if order is confirmed
    //     if ($request->status === 'confirmed') {
    //         try {
    //             Mail::to($order->email)->send(new OrderConfirmed($order));
    //         } catch (\Exception $e) {
    //             return redirect()->back()->with('error', 'Order status updated, but failed to send confirmation email: ' . $e->getMessage());
    //         }
    //     }

    //     return redirect()->back()->with('success', 'Order status updated successfully.');
    // }

    // public function delete(Request $request)
    // {
    //     $request->validate([
    //         'id' => 'required|exists:orders,id',
    //     ]);

    //     $order = Order::findOrFail($request->id);
    //     $order->delete();

    //     return redirect()->back()->with('success', 'Order deleted successfully.');
    // }

      public function index()
    {
        return OrderFacade::index();
    }

    public function getOrderDetails($id)
    {
        return OrderFacade::getOrderDetails($id);
    }

    public function updateStatus(Request $request, $id)
    {
        return OrderFacade::updateStatus($request, $id);
    }

    public function delete(Request $request)
    {
        return OrderFacade::delete($request);
    }
}

<?php

namespace domain\Services\AdminArea;

use App\Mail\OrderConfirmed;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class OrderService
{
    protected $order;

    public function __construct()
    {
        $this->order = new Order();
    }

    public function index()
    {
        try {
            $orders = $this->order->with('orderItems.product')->latest()->get();
            return view('AdminArea.Pages.Order.index', compact('orders'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function getOrderDetails($id)
    {
        try {
            $order = $this->order->with('orderItems.product.images')->findOrFail($id);
            return response()->json(['order' => $order]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch order details: ' . $e->getMessage()], 500);
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:confirmed,cancelled,shipped',
        ]);

        if ($validator->fails()) {
            return back()->withErrors(['error' => $validator->errors()->first()]);
        }

        try {
            $order = $this->order->findOrFail($id);
            $order->status = $request->status;
            $order->save();

            // Send email if order is confirmed
            if ($request->status === 'confirmed') {
                try {
                    Mail::to($order->email)->send(new OrderConfirmed($order));
                } catch (\Exception $e) {
                    return back()->with('error', 'Order status updated, but failed to send confirmation email: ' . $e->getMessage());
                }
            }

            return back()->with('success', 'Order status updated successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to update order status: ' . $e->getMessage()]);
        }
    }

    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:orders,id',
        ]);

        if ($validator->fails()) {
            return back()->withErrors(['error' => $validator->errors()->first()]);
        }

        try {
            $order = $this->order->findOrFail($request->id);
            $order->delete();
            return back()->with('success', 'Order deleted successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to delete order: ' . $e->getMessage()]);
        }
    }
}

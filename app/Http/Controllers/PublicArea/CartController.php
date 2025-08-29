<?php

namespace App\Http\Controllers\PublicArea;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Stripe\Charge;
use Stripe\Stripe;

class CartController extends Controller
{
//    public function addToCart(Request $request)
//     {
//         $request->validate([
//             'product_id' => 'required|exists:products,id',
//             'quantity' => 'required|integer|min:1',
//         ]);

//         $customerId = Session::get('customer_id');
//         $sessionId = Session::getId();

//         $product = Product::findOrFail($request->product_id);
//         if ($product->quantity < $request->quantity) {
//             return redirect()->back()->with('error', 'Insufficient stock.');
//         }

//         $cartItem = CartItem::where(function ($query) use ($customerId, $sessionId) {
//             if ($customerId) {
//                 $query->where('customer_id', $customerId);
//             } else {
//                 $query->where('session_id', $sessionId);
//             }
//         })
//             ->where('product_id', $request->product_id)
//             ->first();

//         if ($cartItem) {
//             $cartItem->quantity += $request->quantity;
//             $cartItem->save();
//         } else {
//             CartItem::create([
//                 'customer_id' => $customerId,
//                 'session_id' => $sessionId,
//                 'product_id' => $request->product_id,
//                 'quantity' => $request->quantity,
//                 'price' => $product->price,
//                 'discount' => $product->discount ?? 0,
//             ]);
//         }

//         return redirect()->route('cart.view')->with('success', 'Product added to cart successfully.');
//     }

//     public function viewCart()
//     {
//         $customerId = Session::get('customer_id');
//         $sessionId = Session::getId();

//         $cartItems = CartItem::where(function ($query) use ($customerId, $sessionId) {
//             if ($customerId) {
//                 $query->where('customer_id', $customerId);
//             } else {
//                 $query->where('session_id', $sessionId);
//             }
//         })->with('product')->get();

//         $subtotal = $cartItems->sum('subtotal');
//         $total = $subtotal; // Add shipping or other fees if applicable

//         return view('PublicArea.Pages.shop.cart', compact('cartItems', 'subtotal', 'total'));
//     }

//     public function updateCart(Request $request)
//     {
//         $request->validate([
//             'cart_item_id' => 'required|exists:cart_items,id',
//             'quantity' => 'required|integer|min:1',
//         ]);

//         $customerId = Session::get('customer_id');
//         $sessionId = Session::getId();

//         $cartItem = CartItem::where('id', $request->cart_item_id)
//             ->where(function ($query) use ($customerId, $sessionId) {
//                 if ($customerId) {
//                     $query->where('customer_id', $customerId);
//                 } else {
//                     $query->where('session_id', $sessionId);
//                 }
//             })
//             ->firstOrFail();

//         $product = $cartItem->product;
//         if ($product->quantity < $request->quantity) {
//             return redirect()->back()->with('error', 'Insufficient stock.');
//         }

//         $cartItem->quantity = $request->quantity;
//         $cartItem->save();

//         return redirect()->route('cart.view')->with('success', 'Cart updated successfully.');
//     }

//     public function removeFromCart(Request $request)
//     {
//         $request->validate([
//             'cart_item_id' => 'required|exists:cart_items,id',
//         ]);

//         $customerId = Session::get('customer_id');
//         $sessionId = Session::getId();

//         $cartItem = CartItem::where('id', $request->cart_item_id)
//             ->where(function ($query) use ($customerId, $sessionId) {
//                 if ($customerId) {
//                     $query->where('customer_id', $customerId);
//                 } else {
//                     $query->where('session_id', $sessionId);
//                 }
//             })
//             ->firstOrFail();

//         $cartItem->delete();

//         return redirect()->route('cart.view')->with('success', 'Item removed from cart.');
//     }

//     public function checkout()
//     {
//         $customerId = Session::get('customer_id');
//         $sessionId = Session::getId();

//         if (!$customerId) {
//             return redirect()->route('login')->with('error', 'Please log in to proceed with checkout.');
//         }

//         $cartItems = CartItem::where('customer_id', $customerId)->with('product')->get();
//         $subtotal = $cartItems->sum('subtotal');
//         $total = $subtotal; // Add shipping or other fees if applicable

//         return view('PublicArea.Pages.shop.checkout', compact('cartItems', 'subtotal', 'total'));
//     }


public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $customerId = Session::get('customer_id');
        $sessionId = Session::getId();

        $product = Product::findOrFail($request->product_id);
        if ($product->quantity < $request->quantity) {
            return redirect()->back()->with('error', 'Insufficient stock.');
        }

        $cartItem = CartItem::where(function ($query) use ($customerId, $sessionId) {
            if ($customerId) {
                $query->where('customer_id', $customerId);
            } else {
                $query->where('session_id', $sessionId);
            }
        })
            ->where('product_id', $request->product_id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            CartItem::create([
                'customer_id' => $customerId,
                'session_id' => $customerId ? null : $sessionId,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'price' => $product->price,
                'discount' => $product->discount ?? 0,
            ]);
        }

        return redirect()->route('cart.view')->with('success', 'Product added to cart successfully.');
    }

    public function viewCart()
    {
        $customerId = Session::get('customer_id');
        $sessionId = Session::getId();

        $cartItems = CartItem::where(function ($query) use ($customerId, $sessionId) {
            if ($customerId) {
                $query->where('customer_id', $customerId);
            } else {
                $query->where('session_id', $sessionId);
            }
        })->with('product')->get();

        $subtotal = $cartItems->sum('subtotal');
        $total = $subtotal; // Add shipping or other fees if applicable

        return view('PublicArea.Pages.shop.cart', compact('cartItems', 'subtotal', 'total'));
    }

    public function updateCart(Request $request)
    {
        $request->validate([
            'cart_item_id' => 'required|exists:cart_items,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $customerId = Session::get('customer_id');
        $sessionId = Session::getId();

        $cartItem = CartItem::where('id', $request->cart_item_id)
            ->where(function ($query) use ($customerId, $sessionId) {
                if ($customerId) {
                    $query->where('customer_id', $customerId);
                } else {
                    $query->where('session_id', $sessionId);
                }
            })
            ->firstOrFail();

        $product = $cartItem->product;
        if ($product->quantity < $request->quantity) {
            return redirect()->back()->with('error', 'Insufficient stock.');
        }

        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return redirect()->route('cart.view')->with('success', 'Cart updated successfully.');
    }

    public function removeFromCart(Request $request)
    {
        $request->validate([
            'cart_item_id' => 'required|exists:cart_items,id',
        ]);

        $customerId = Session::get('customer_id');
        $sessionId = Session::getId();

        $cartItem = CartItem::where('id', $request->cart_item_id)
            ->where(function ($query) use ($customerId, $sessionId) {
                if ($customerId) {
                    $query->where('customer_id', $customerId);
                } else {
                    $query->where('session_id', $sessionId);
                }
            })
            ->firstOrFail();

        $cartItem->delete();

        return redirect()->route('cart.view')->with('success', 'Item removed from cart.');
    }

    public function checkout()
    {
        $customerId = Session::get('customer_id');
        $sessionId = Session::getId();

        if (!$customerId) {
                return redirect()->route('login')->withErrors(['error' => 'Please log in to proceed with checkout.']);
        }

        $cartItems = CartItem::where('customer_id', $customerId)->with('product')->get();
        $subtotal = $cartItems->sum('subtotal');
        $total = $subtotal; // Add shipping or other fees if applicable

        return view('PublicArea.Pages.shop.checkout', compact('cartItems', 'subtotal', 'total'));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'country' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'town_city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'required|string|max:10',
            'note_box' => 'nullable|string',
            'stripeToken' => 'required',
        ]);

        $customerId = Session::get('customer_id');
        if (!$customerId) {
            return redirect()->route('login')->with('error', 'Please log in to proceed with checkout.');
        }

        $cartItems = CartItem::where('customer_id', $customerId)->with('product')->get();
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.view')->with('error', 'Your cart is empty.');
        }

        $subtotal = $cartItems->sum('subtotal');
        $total = $subtotal; // Add shipping or other fees if applicable

        // Set Stripe API key
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            // Create charge
            $charge = Charge::create([
                'amount' => $total * 100, // Convert to cents
                'currency' => 'lkr',
                'source' => $request->stripeToken,
                'description' => 'Order payment for customer ID: ' . $customerId,
            ]);

            // Create order
            $order = Order::create([
                'customer_id' => $customerId,
                'total' => $total,
                'status' => 'completed',
                'payment_status' => 'completed',
                'payment_confirmation' => $charge->id,
                'first_name' => $request->first_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'country' => $request->country,
                'address' => $request->address,
                'town_city' => $request->town_city,
                'state' => $request->state,
                'zip' => $request->zip,
                'note' => $request->note_box,
            ]);

            // Create order items
            foreach ($cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->price,
                    'discount' => $cartItem->discount,
                    'subtotal' => $cartItem->subtotal,
                ]);

                // Update product quantity
                $product = $cartItem->product;
                $product->quantity -= $cartItem->quantity;
                $product->save();

                // Delete cart item
                $cartItem->delete();
            }

            return redirect()->route('order.history')->with('success', 'Order placed successfully.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Payment failed: ' . $e->getMessage());
        }
    }

    public function orderHistory()
    {
        $customerId = Session::get('customer_id');
        if (!$customerId) {
            return redirect()->route('login')->with('error', 'Please log in to view your order history.');
        }

        $orders = Order::where('customer_id', $customerId)->with('orderItems.product')->latest()->get();

        return view('PublicArea.Pages.shop.order-history', compact('orders'));
    }

     public function downloadBill($orderId)
    {
        $customerId = Session::get('customer_id');
        if (!$customerId) {
            return redirect()->route('login')->with('error', 'Please log in to download your bill.');
        }

        $order = Order::where('id', $orderId)
            ->where('customer_id', $customerId)
            ->with('orderItems.product')
            ->firstOrFail();

        $pdf = Pdf::loadView('PublicArea.Pages.shop.orderBillPdf', compact('order'));
        return $pdf->download('order_bill_' . $order->id . '.pdf');
    }


    public function createStripeSession(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'country' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'town_city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'required|string|max:10',
            'note_box' => 'nullable|string',
        ]);

        $customerId = Session::get('customer_id');
        if (!$customerId) {
            return redirect()->route('login')->with('error', 'Please log in to proceed with checkout.');
        }

        $cartItems = CartItem::where('customer_id', $customerId)->with('product')->get();
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.view')->with('error', 'Your cart is empty.');
        }

        $subtotal = $cartItems->sum('subtotal');
        $total = $subtotal;

        // Store billing details in session for later use
        Session::put('billing_details', [
            'first_name' => $request->first_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'country' => $request->country,
            'address' => $request->address,
            'town_city' => $request->town_city,
            'state' => $request->state,
            'zip' => $request->zip,
            'note' => $request->note_box,
        ]);

        // Set Stripe API key
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            // Prepare line items for Stripe
            $lineItems = [];
            foreach ($cartItems as $cartItem) {
                $unitAmount = $cartItem->price * (1 - ($cartItem->discount / 100));
                $lineItems[] = [
                    'price_data' => [
                        'currency' => 'lkr',
                        'product_data' => [
                            'name' => $cartItem->product->name,
                            'description' => $cartItem->product->description ?? 'Product from our store',
                        ],
                        'unit_amount' => (int)($unitAmount * 100), // Convert to cents
                    ],
                    'quantity' => $cartItem->quantity,
                ];
            }

            // Create Stripe Checkout Session
            $session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => route('stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('stripe.cancel'),
                'customer_email' => $request->email,
                'billing_address_collection' => 'auto',
                'shipping_address_collection' => [
                    'allowed_countries' => ['LK', 'IN', 'US', 'GB'], // Add your allowed countries
                ],
                'metadata' => [
                    'customer_id' => $customerId,
                    'first_name' => $request->first_name,
                    'phone' => $request->phone,
                ],
            ]);

            // Store session ID for verification
            Session::put('stripe_session_id', $session->id);

            // Redirect to Stripe Checkout
            return redirect($session->url);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create payment session: ' . $e->getMessage());
        }
    }

    public function stripeSuccess(Request $request)
    {
        $sessionId = $request->get('session_id');
        $storedSessionId = Session::get('stripe_session_id');

        if (!$sessionId || $sessionId !== $storedSessionId) {
            return redirect()->route('home')->with('error', 'Invalid payment session.');
        }

        $stripeSecret = env('STRIPE_SECRET');
    if (!$stripeSecret) {
        Log::error('Stripe secret key is not set in the .env file.');
        return redirect()->back()->with('error', 'Stripe configuration error. Please contact support.');
    }

        // Set Stripe API key
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            // Retrieve the session
            $session = \Stripe\Checkout\Session::retrieve($sessionId);

            if ($session->payment_status !== 'paid') {
                return redirect()->route('checkout')->with('error', 'Payment was not completed.');
            }

            $customerId = Session::get('customer_id');
            $billingDetails = Session::get('billing_details');

            $cartItems = CartItem::where('customer_id', $customerId)->with('product')->get();
            $subtotal = $cartItems->sum('subtotal');
            $total = $subtotal;

            // Create order
            $order = Order::create([
                'customer_id' => $customerId,
                'total' => $total,
                'status' => 'completed',
                'payment_status' => 'completed',
                'payment_confirmation' => $session->payment_intent,
                'first_name' => $billingDetails['first_name'],
                'email' => $billingDetails['email'],
                'phone' => $billingDetails['phone'],
                'country' => $billingDetails['country'],
                'address' => $billingDetails['address'],
                'town_city' => $billingDetails['town_city'],
                'state' => $billingDetails['state'],
                'zip' => $billingDetails['zip'],
                'note' => $billingDetails['note'],
            ]);

            // Create order items
            foreach ($cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->price,
                    'discount' => $cartItem->discount,
                    'subtotal' => $cartItem->subtotal,
                ]);

                // Update product quantity
                $product = $cartItem->product;
                $product->quantity -= $cartItem->quantity;
                $product->save();

                // Delete cart item
                $cartItem->delete();
            }

            // Clear session data
            Session::forget(['stripe_session_id', 'billing_details']);

            return redirect()->route('order.history')->with('success', 'Payment successful! Your order has been confirmed.');

        } catch (\Exception $e) {
            return redirect()->route('checkout')->with('error', 'Error processing payment: ' . $e->getMessage());
        }
    }

    public function stripeCancel()
    {
        Session::forget(['stripe_session_id', 'billing_details']);
        return redirect()->route('checkout')->with('error', 'Payment was cancelled. Please try again.');
    }

}

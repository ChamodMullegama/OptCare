<?php

namespace App\Http\Controllers\PublicArea;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
            return redirect()->route('login')->with('error', 'Please log in to proceed with checkout.');
        }

        $cartItems = CartItem::where('customer_id', $customerId)->with('product')->get();
        $subtotal = $cartItems->sum('subtotal');
        $total = $subtotal; // Add shipping or other fees if applicable

        return view('PublicArea.Pages.shop.checkout', compact('cartItems', 'subtotal', 'total'));
    }
}

<?php

namespace App\Http\Controllers\PublicArea;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Customer;
use domain\Facades\PublicArea\CustomerFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class CustomerAuthController extends Controller
{


//     public function showRegistrationForm()
//     {
//        return view('PublicArea.Pages.Authentication.registration');
//     }

//     public function register(Request $request)
//     {
//         $request->validate([
//             'first_name' => 'required|string|max:255',
//             'last_name' => 'required|string|max:255',
//             'email' => 'required|email|unique:customers,email',
//             'phone' => 'required|string|max:15',
//             'gender' => 'required|in:male,female',
//             'birth_date' => 'required|date',
//             'password' => 'required|string|min:6|confirmed',
//         ]);

//         $customer = CustomerFacade::register($request->all());

//         // Store email in session
//         Session::put('otp_verification_email', $customer->email);

//         return redirect()->route('verify.otp')
//                          ->with('success', 'Registration successful. Please verify your OTP.');
//     }

//     public function showOtpForm()
//     {
//         $email = Session::get('otp_verification_email');
//         if (!$email) {
//             return redirect()->route('register')->withErrors(['email' => 'No registration found. Please register again.']);
//         }
//         $customer = \App\Models\Customer::where('email', $email)->first();
//         if (!$customer) {
//             Session::forget('otp_verification_email');
//             return redirect()->route('register')->withErrors(['email' => 'Invalid email address.']);
//         }
//            return view('PublicArea.Pages.Authentication.otp', compact('email'));
//     }

//     public function verifyOtp(Request $request)
//     {
//         $email = Session::get('otp_verification_email');
//         if (!$email) {
//             return redirect()->route('register')->withErrors(['email' => 'No registration found. Please register again.']);
//         }

//         $request->validate([
//             'email' => 'required|email',
//             'otp' => 'required|digits:6',
//         ]);

//         $customer = CustomerFacade::verifyOtp($request->email, $request->otp);
//         if ($customer) {
//             Session::put('customer_id', $customer->id);
//             Session::put('customer_email', $customer->email);
//             Session::put('customer_name', $customer->first_name . ' ' . $customer->last_name);
//             Session::forget('otp_verification_email'); // Clear the temporary session
//             return redirect()->route('home')->with('success', 'OTP verified. You are now logged in.');
//         }

//         return back()->withErrors(['otp' => 'Invalid or expired OTP.']);
//     }

//     public function showLoginForm()
//     {
//          return view('PublicArea.Pages.Authentication.login');
//     }

//    public function login(Request $request)
// {
//     $request->validate([
//         'email' => 'required|email',
//         'password' => 'required|string',
//     ]);

//     $customer = \App\Models\Customer::where('email', $request->email)->first();

//     if (!$customer) {
//         return back()->withErrors(['email' => 'Email is not registered.']);
//     }

//     if (!Hash::check($request->password, $customer->password)) {
//         return back()->withErrors(['password' => 'Invalid credentials. Please check your password.']);
//     }

//     if (!$customer->verified_account) {
//         return back()->withErrors(['email' => 'Account not verified. Please verify your email first.']);
//     }

//     Session::put('customer_id', $customer->id);
//     Session::put('customer_email', $customer->email);
//     Session::put('customer_name', $customer->first_name . ' ' . $customer->last_name);
//     return redirect()->route('home')->with('success', 'Login successful.');
// }

//     public function logout(Request $request)
//     {
//         Session::flush();
//         return redirect()->route('home')->with('success', 'Logout successful.');
//     }


//     public function redirectToGoogle()
// {
//     return Socialite::driver('google')->redirect();
// }

//  public function handleGoogleCallback()
//     {
//         try {
//             $googleUser = Socialite::driver('google')->user();

//             // Check if email exists with a non-Google account
//             $existingCustomer = Customer::where('email', $googleUser->getEmail())->first();

//             if ($existingCustomer && !$existingCustomer->google_id) {
//                 return redirect()->route('login')
//                     ->withErrors(['email' => 'This email is already registered with a password. Please login with your password.']);
//             }

//             // Create or update customer
//             $customer = Customer::updateOrCreate(
//                 ['email' => $googleUser->getEmail()],
//                 [
//                     'google_id' => $googleUser->getId(),
//                     'first_name' => $googleUser->user['given_name'] ?? explode(' ', $googleUser->getName())[0] ?? 'Google',
//                     'last_name' => $googleUser->user['family_name'] ?? (explode(' ', $googleUser->getName())[1] ?? 'User'),
//                     'password' => Hash::make(Str::random(24)),
//                     'verified_account' => 1,
//                     'phone' => null,
//                     'gender' => null,
//                     'age' => null,
//                     'otp' => null,
//                     'otp_expires_at' => null,
//                     'avatar' => null,
//                     'birth_date' => null,
//                 ]
//             );

//             // Log in the customer
//             Session::put('customer_id', $customer->id);
//             Session::put('customer_email', $customer->email);
//             Session::put('customer_name', $customer->first_name . ' ' . $customer->last_name);

//             return redirect()->intended(route('home'))->with('success', 'Login successful with Google.');

//         } catch (\Exception $e) {
//             Log::error('Google Auth Error: ' . $e->getMessage());
//             return redirect()->route('login')->withErrors(['error' => 'Google authentication failed. Please try again.']);
//         }
//     }

 public function showRegistrationForm()
    {
        return view('PublicArea.Pages.Authentication.registration');
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required|string|max:15',
            'gender' => 'required|in:male,female',
            'birth_date' => 'required|date',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $customer = CustomerFacade::register($request->all());

        Session::put('otp_verification_email', $customer->email);

        return redirect()->route('verify.otp')
                         ->with('success', 'Registration successful. Please verify your OTP.');
    }

    public function showOtpForm()
    {
        $email = Session::get('otp_verification_email');
        if (!$email) {
            return redirect()->route('register')->withErrors(['email' => 'No registration found. Please register again.']);
        }
        $customer = \App\Models\Customer::where('email', $email)->first();
        if (!$customer) {
            Session::forget('otp_verification_email');
            return redirect()->route('register')->withErrors(['email' => 'Invalid email address.']);
        }
        return view('PublicArea.Pages.Authentication.otp', compact('email'));
    }

    public function verifyOtp(Request $request)
    {
        $email = Session::get('otp_verification_email');
        if (!$email) {
            return redirect()->route('register')->withErrors(['email' => 'No registration found. Please register again.']);
        }

        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:6',
        ]);

        $customer = CustomerFacade::verifyOtp($request->email, $request->otp);
        if ($customer) {
            Session::put('customer_id', $customer->id);
            Session::put('customer_email', $customer->email);
            Session::put('customer_name', $customer->first_name . ' ' . $customer->last_name);
            Session::forget('otp_verification_email'); // Clear the temporary session

            // Merge guest cart with customer cart
            $sessionId = Session::getId();
            $guestCartItems = CartItem::where('session_id', $sessionId)->get();
            foreach ($guestCartItems as $guestCartItem) {
                $existingCartItem = CartItem::where('customer_id', $customer->id)
                    ->where('product_id', $guestCartItem->product_id)
                    ->first();
                if ($existingCartItem) {
                    $existingCartItem->quantity += $guestCartItem->quantity;
                    $existingCartItem->save();
                    $guestCartItem->delete();
                } else {
                    $guestCartItem->customer_id = $customer->id;
                    $guestCartItem->session_id = null;
                    $guestCartItem->save();
                }
            }

            return redirect()->route('home')->with('success', 'OTP verified. You are now logged in.');
        }

        return back()->withErrors(['otp' => 'Invalid or expired OTP.']);
    }

    public function showLoginForm()
    {
        return view('PublicArea.Pages.Authentication.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $customer = \App\Models\Customer::where('email', $request->email)->first();

        if (!$customer) {
            return back()->withErrors(['email' => 'Email is not registered.']);
        }

        if (!Hash::check($request->password, $customer->password)) {
            return back()->withErrors(['password' => 'Invalid credentials. Please check your password.']);
        }

        if (!$customer->verified_account) {
            return back()->withErrors(['email' => 'Account not verified. Please verify your email first.']);
        }

        Session::put('customer_id', $customer->id);
        Session::put('customer_email', $customer->email);
        Session::put('customer_name', $customer->first_name . ' ' . $customer->last_name);

        // Ensure existing cart items are linked to the user
        $sessionId = Session::getId();
        $guestCartItems = CartItem::where('session_id', $sessionId)->get();
        foreach ($guestCartItems as $guestCartItem) {
            $existingCartItem = CartItem::where('customer_id', $customer->id)
                ->where('product_id', $guestCartItem->product_id)
                ->first();
            if ($existingCartItem) {
                $existingCartItem->quantity += $guestCartItem->quantity;
                $existingCartItem->save();
                $guestCartItem->delete();
            } else {
                $guestCartItem->customer_id = $customer->id;
                $guestCartItem->session_id = null;
                $guestCartItem->save();
            }
        }

        // Fetch and display existing user cart items
        return redirect()->route('home')->with('success', 'Login successful.');
    }

    public function logout(Request $request)
    {
        $customerId = Session::get('customer_id');
        // Do not delete cart items on logout, just clear session
        Session::flush();
        return redirect()->route('home')->with('success', 'Logout successful.');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $existingCustomer = Customer::where('email', $googleUser->getEmail())->first();

            if ($existingCustomer && !$existingCustomer->google_id) {
                return redirect()->route('login')
                    ->withErrors(['email' => 'This email is already registered with a password. Please login with your password.']);
            }

            $customer = Customer::updateOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'google_id' => $googleUser->getId(),
                    'first_name' => $googleUser->user['given_name'] ?? explode(' ', $googleUser->getName())[0] ?? 'Google',
                    'last_name' => $googleUser->user['family_name'] ?? (explode(' ', $googleUser->getName())[1] ?? 'User'),
                    'password' => Hash::make(Str::random(24)),
                    'verified_account' => 1,
                    'phone' => null,
                    'gender' => null,
                    'age' => null,
                    'otp' => null,
                    'otp_expires_at' => null,
                    'avatar' => null,
                    'birth_date' => null,
                ]
            );

            Session::put('customer_id', $customer->id);
            Session::put('customer_email', $customer->email);
            Session::put('customer_name', $customer->first_name . ' ' . $customer->last_name);

            // Merge guest cart with customer cart
            $sessionId = Session::getId();
            $guestCartItems = CartItem::where('session_id', $sessionId)->get();
            foreach ($guestCartItems as $guestCartItem) {
                $existingCartItem = CartItem::where('customer_id', $customer->id)
                    ->where('product_id', $guestCartItem->product_id)
                    ->first();
                if ($existingCartItem) {
                    $existingCartItem->quantity += $guestCartItem->quantity;
                    $existingCartItem->save();
                    $guestCartItem->delete();
                } else {
                    $guestCartItem->customer_id = $customer->id;
                    $guestCartItem->session_id = null;
                    $guestCartItem->save();
                }
            }

            // Fetch and display existing user cart items
            return redirect()->route('home')->with('success', 'Login successful with Google.');

        } catch (\Exception $e) {
            Log::error('Google Auth Error: ' . $e->getMessage());
            return redirect()->route('login')->withErrors(['error' => 'Google authentication failed. Please try again.']);
        }
    }

      public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    // Handle Facebook callback separately
    public function handleFacebookCallback()
    {
        try {
            $facebookUser = Socialite::driver('facebook')->user();

            // Check if user already exists by email
            $existingCustomer = Customer::where('email', $facebookUser->getEmail())->first();

            if ($existingCustomer && !$existingCustomer->facebook_id) {
                return redirect()->route('login')
                    ->withErrors(['email' => 'This email is already registered with a password. Please login with your password.']);
            }

            // Create or update customer specifically for Facebook
            if ($existingCustomer) {
                $existingCustomer->facebook_id = $facebookUser->getId();
                $existingCustomer->avatar = $facebookUser->getAvatar();
                $existingCustomer->save();
                $customer = $existingCustomer;
            } else {
                $customer = Customer::create([
                    'first_name' => $facebookUser->user['first_name'] ?? explode(' ', $facebookUser->getName())[0] ?? 'Facebook',
                    'last_name' => $facebookUser->user['last_name'] ?? (explode(' ', $facebookUser->getName())[1] ?? 'User'),
                    'email' => $facebookUser->getEmail(),
                    'facebook_id' => $facebookUser->getId(),
                    'password' => Hash::make(Str::random(24)),
                    'verified_account' => 1,
                    'phone' => null,
                    'gender' => null,
                    'age' => null,
                    'otp' => null,
                    'otp_expires_at' => null,
                    'avatar' => $facebookUser->getAvatar(),
                    'birth_date' => null,
                ]);
            }

            // Store session
            Session::put('customer_id', $customer->id);
            Session::put('customer_email', $customer->email);
            Session::put('customer_name', $customer->first_name . ' ' . $customer->last_name);

            // Merge guest cart
            $sessionId = Session::getId();
            $guestCartItems = CartItem::where('session_id', $sessionId)->get();
            foreach ($guestCartItems as $guestCartItem) {
                $existingCartItem = CartItem::where('customer_id', $customer->id)
                    ->where('product_id', $guestCartItem->product_id)
                    ->first();
                if ($existingCartItem) {
                    $existingCartItem->quantity += $guestCartItem->quantity;
                    $existingCartItem->save();
                    $guestCartItem->delete();
                } else {
                    $guestCartItem->customer_id = $customer->id;
                    $guestCartItem->session_id = null;
                    $guestCartItem->save();
                }
            }

            return redirect()->route('home')->with('success', 'Login successful with Facebook.');

        } catch (\Exception $e) {
            Log::error('Facebook Auth Error: ' . $e->getMessage());
            return redirect()->route('login')->withErrors(['error' => 'Facebook authentication failed. Please try again.']);
        }
    }

}

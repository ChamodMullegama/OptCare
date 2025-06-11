<?php

namespace App\Http\Controllers\PublicArea;

use App\Http\Controllers\Controller;
use domain\Facades\PublicArea\CustomerFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class CustomerAuthController extends Controller
{


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

        // Store email in session
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
    return redirect()->route('home')->with('success', 'Login successful.');
}

    public function logout(Request $request)
    {
        Session::flush();
        return redirect()->route('home')->with('success', 'Logout successful.');
    }
}

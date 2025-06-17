<?php

namespace domain\Services\AdminArea;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthService
{
    // public function attemptLogin($email, $password)
    // {
    //     $admin = Admin::where('email', $email)->first();

    //     if (!$admin || !Hash::check($password, $admin->password)) {
    //         return false;
    //     }

    //     Auth::guard('admin')->login($admin);
    //     return true;
    // }

    // public function logout()
    // {
    //     Auth::guard('admin')->logout();
    // }

    // public function getCurrentAdmin()
    // {
    //     return Auth::guard('admin')->user();
    // }

    public function attemptLogin($email, $password)
    {
        $admin = Admin::where('email', $email)->first();

        if (!$admin || !Hash::check($password, $admin->password)) {
            return false;
        }

        Auth::guard('admin')->login($admin);

        // Store admin data in session
        Session::put('admin', [
            'name' => $admin->name,
            'email' => $admin->email,
            'id' => $admin->id,
             'first_name' => $admin->first_name,
              'last_name' => $admin->last_name,
        ]);

        return true;
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        Session::forget('admin'); // Clear admin session data
    }

    public function getCurrentAdmin()
    {
        return Auth::guard('admin')->user();
    }
}

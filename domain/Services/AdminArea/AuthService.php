<?php

namespace domain\Services\AdminArea;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function attemptLogin($email, $password)
    {
        $admin = Admin::where('email', $email)->first();

        if (!$admin || !Hash::check($password, $admin->password)) {
            return false;
        }

        Auth::guard('admin')->login($admin);
        return true;
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
    }

    public function getCurrentAdmin()
    {
        return Auth::guard('admin')->user();
    }
}

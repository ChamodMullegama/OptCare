<?php

namespace App\Http\Controllers\DoctorArea;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use domain\Facades\DoctorArea\Auth;

class DoctorController extends Controller
{
    public function dashboard()
    {
        return view('DoctorArea.Pages.Dashboard.index');
    }

    public function index()
    {
        return view('DoctorArea.Pages.Dashboard.index');
    }
}
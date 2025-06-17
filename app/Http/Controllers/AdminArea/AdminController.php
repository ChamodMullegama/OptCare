<?php

namespace App\Http\Controllers\AdminArea;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use domain\Facades\AdminArea\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('AdminArea.Pages.Dashboard.index');
    }

    public function index()
    {
        return view('AdminArea.Pages.Dashboard.index');
    }
}

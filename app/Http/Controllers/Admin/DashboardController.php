<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Display applications's admin dashboard.
     * 
     * @return  view
     */
    public function index() 
    {
        return view('admin.dashboard');
    }
}

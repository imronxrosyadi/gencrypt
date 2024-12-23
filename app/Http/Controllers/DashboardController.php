<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'title' => 'PT Buana Express',
            'active' => 'dashboard'
        ]);
    }
}

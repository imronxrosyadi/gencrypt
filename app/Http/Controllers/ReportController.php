<?php

namespace App\Http\Controllers;

class ReportController extends Controller
{
    public function index()
    {
        return view('report-data.index', [
            'title' => 'PT Buana Express',
            'active' => 'report'
        ]);
    }

    public function add()
    {
        return view('report-data.add', [
            'title' => 'PT Buana Express',
            'active' => 'report'
        ]);
    }
}

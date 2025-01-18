<?php

namespace App\Http\Controllers;

use App\Models\ReportData;

class DashboardController extends Controller
{
    public function index()
    {
        $encryptedData = ReportData::count();
        $decryptedData = ReportData::whereNotNull('decryption_time')->count();

        return view('dashboard.index', [
            'title' => 'PT Buana Express',
            'active' => 'dashboard',
            "encryptedData" => $encryptedData,
            "decryptedData" => $decryptedData
        ]);
    }
}

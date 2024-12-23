<?php

namespace App\Http\Controllers;

use App\Models\ReportData;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('report-data.index', [
            'title' => 'PT Buana Express',
            'active' => 'report',
            "reports" => ReportData::latest()->paginate(100)->withQueryString()
        ]);
    }

    public function show() {}

    public function create()
    {
        return view('report-data.create', [
            'title' => 'PT Buana Express',
            'active' => 'report'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:10000'
        ]);

        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $base64Content = base64_encode(file_get_contents($file->getRealPath()));
        ReportData::create([
            'data' => $base64Content,
            'filename' => $fileName,
            'extension' => $extension,
        ]);
        return back()->with('success!');
    }

    public function delete($code)
    {
        $reportData = ReportData::where('id', $code)->first();
        return view('report-data.delete', ["reportData" => $reportData]);
    }

    public function destroy($code)
    {
        $reportData = ReportData::where('id', $code)->firstorfail()->delete();

        $page = 'report.index';
        $success = '';
        $err = '';
        if ($reportData) {
            $success = 'Report Data deleted successfully';
        } else {
            $err = 'Report Data deleted failure';
        }

        return redirect()
            ->route($page)
            ->with('success', $success)
            ->with('err', $err);
    }
}

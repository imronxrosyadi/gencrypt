<?php

namespace App\Http\Controllers;

use App\Helpers\CommonHelper;
use App\Models\ReportData;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Helpers\Helper1\Aesctr;
use Illuminate\Support\Facades\Crypt;



class DecryptionController extends Controller
{
    public function index()
    {


        $reports = ReportData::whereNotNull('decryption_time')
        ->latest()
        ->paginate(100)
        ->withQueryString();

        $reports->getCollection()->transform(function ($report) {
            $report->original_size = CommonHelper::formatSize($report->original_size);
            $report->encrypt_size = CommonHelper::formatSize($report->encrypt_size);
            return $report;
        });
        
        return view('decryption.index', [
            'title' => 'PT Buana Express',
            'active' => 'report',
            "reports" => $reports
        ]);
        
    }
    public function show() {}

    public function create()
    {
        return view('decryption.create', [
            'title' => 'PT Buana Express',
            'active' => 'report'
        ]);
    }

    public function store(Request $request)
    {
        // dd('sempakkk=====');
        // $request->validate([
        //     'file' => 'required|file|mimes:rda|max:10000'
        // ]);

        $key = $request->key;
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();

        $report_data = ReportData::where('filename_encrypt', $fileName)->first();

        if($report_data->key!=$key){
            return back()->with('err', 'Wrong key for decrypt');
        }

        ini_set('max_execution_time', -1);
        ini_set('memory_limit', -1);


        $id = $report_data->id;
        $filename = $report_data->filename;
        $key = $request->key;
        $file_output_path = env('APP_DECRYPTED_BASE_PATH') . '/' . $filename;
        $timer = microtime(true);
        $this->decryptBinary($file, $key, $file_output_path);
        ReportData::where("id", $id)->update([
            "decryption_time" => strval(round(microtime(as_float: true) - $timer, 3)),
            "path_decrypt" => $file_output_path
        ]);

        return redirect('/report/decryption')
            ->with('success', 'Decrypt File success!');
    }

    public function delete($code)
    {
        $reportData = ReportData::where('id', $code)->firstorfail();
        return view('decryption.delete', ["reportData" => $reportData]);
    }

    public function destroy($code)
    {
        $reportData = ReportData::where('id', $code)->firstorfail()->delete();

        $page = 'decryption.index';
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

    public function download($id)
    {
        $report_data = ReportData::where('id', $id)->first();
        $file_output_path = $report_data->path_decrypt;
        if (file_exists($file_output_path)) {
            $fileName = basename($file_output_path);
            $mimeType = mime_content_type($file_output_path);
            header('Content-Type: ' . $mimeType);
            header('Content-Disposition: attachment; filename="' . $fileName . '"');
            header('Content-Length: ' . filesize($file_output_path));
            readfile($file_output_path);
            exit;
        } else {
            return response()->json(['error' => 'File not found'], 404);
        }
    }

    // public function downloadData(Request $request)
    // {
    //     $request->validate([
    //         'key' => 'required',
    //         'id' => 'required',
    //     ]);

    //     $report_data = ReportData::where('id', $request->id)->first();

    //     $filePath = $report_data->path;
    //     $filename = $report_data->filename;
    //     $key = $request->key;
    //     $file_output_path = env('APP_DECRYPTED_BASE_PATH') . '/' . $filename;

    //     if ($report_data->key != $request->key) {
    //         return abort(409, 'wrong key.');
    //     }
    //     ini_set('max_execution_time', -1);
    //     ini_set('memory_limit', -1);
    //     $timer = microtime(true);

    //     $this->decyptBinary($filePath, $file_output_path, $key);
    //     round(microtime(as_float: true) - $timer, 3);

    //     $report_data::update([
    //         'decryption_time' => round(microtime(as_float: true) - $timer, 3),
    //     ]);
    //     if (file_exists($file_output_path)) {
    //         return Storage::download($file_output_path, $filename, []);
    //     } else {
    //         return response()->json(['error' => 'File not found'], 404);
    //     }
    // }

    public function decryptBinary(UploadedFile $file, string $key, string $fileOutputPath): void
    {
        $file_output = fopen($fileOutputPath, 'wb');
        try {
            $encryptedChunk = Aesctr::decrypt($file->getContent(), $key, 256);
            fwrite($file_output, unserialize($encryptedChunk));
        } finally {
            fclose($file_output);
        }
    }
}

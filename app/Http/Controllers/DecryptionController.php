<?php

namespace App\Http\Controllers;

use App\Models\ReportData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Helpers\Helper1\Aesctr;


class DecryptionController extends Controller
{
    public function index()
    {
        return view('decryption.index', [
            'title' => 'PT Buana Express',
            'active' => 'report',
            "reports" => ReportData::latest()->paginate(100)->withQueryString()
        ]);
    }
    public function show() {}

    public function create()
    {
        return view('encryption.create', [
            'title' => 'PT Buana Express',
            'active' => 'report'
        ]);
    }

    public function download(Request $request)
    {

        dd('sempak');
        $request->validate([
            'key' => 'required',
            'id'=> 'required',
        ]);
        
        $report_data = ReportData::where('id', $request->id)->first();

        $filePath = $report_data->path;
        $filename = $report_data->filename;
        $key = $request->key;
        $file_output_path= env('APP_DECRYPTED_BASE_PATH').'/'.$filename;

        if ($report_data->key!=$request->key) {
            return abort(409, 'wrong key.');
        }
        ini_set('max_execution_time', -1);
        ini_set('memory_limit', -1);
        $timer = microtime(true);
        
        $this->decyptBinary($filePath,$file_output_path,$key);
        round(microtime(as_float: true) - $timer, 3);

        $report_data::update([
            'decryption_time' => round(microtime(as_float: true) - $timer, 3),
        ]);
        if (file_exists($file_output_path)) {
            return Storage::download($file_output_path, $filename, []);
        } else {
            return response()->json(['error' => 'File not found'], 404);
        }
    }

    public function decyptBinary($filePath,$fileOutputPath, string $key)
    {
        $chunkSize = 1024 * 64; // 64KB per chunk
        $binaryContent = fopen($filePath, 'rb');
        $file_output = fopen($fileOutputPath, 'wb');
        try {
            while (!feof($binaryContent)) {
                $chunk = fread($binaryContent, $chunkSize);
                if ($chunk === false) {
                    throw new \RuntimeException('Error reading the file.');
                }

                $encryptedChunk = Aesctr::decrypt($chunk, $key, 256);
                fwrite($file_output, $encryptedChunk);
            }
        } finally {
            fclose($binaryContent);
            fclose($file_output);
        }
    }
    
}

<?php

namespace App\Http\Controllers;

use App\Helpers\Helper1\Aesctr;
use App\Models\ReportData;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class EncryptionController extends Controller
{
    public function index()
    {
        return view('encryption.index', [
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

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:10000'
        ]);


        // $key = empty(env('FILE_ENCRYPTION_KEY')) ? env('FILE_ENCRYPTION_KEY') : '1234567890abcdef';
        $key = $request->key;
        $timer = microtime(true);
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $path = $file->store('uploads', 'local');


        //encrypt file slow even more slow if using base64 because converting into base64 increasing size
        //ok bg
        ReportData::create([
            // 'data_binary' => $this->encryptBinary($file,$key),
            // 'data' =>  $this->encryptBase64($file, $key),
            'filename' => $fileName,
            'extension' => $extension,
            'key' => $key,
            'path' => $path,
            // 'encryption_time' => $timer,
        ]);
        // echo round(microtime(as_float: true) - $timer, 3);
        return back()->with('success!');
    }

    public function encryptBase64(UploadedFile $file, string $key)
    {
        $base64Content = base64_encode(file_get_contents($file->getRealPath()));
        return Aesctr::encrypt($base64Content, $key, 256);
    }

    public function encryptBinary(UploadedFile $file, string $key)
    {
        $chunkSize = 1024 * 64; // 64KB per chunk
        $binaryContent = fopen($file->getRealPath(), 'rb');
        $encryptedContent = '';
        try {
            while (!feof($binaryContent)) {
                $chunk = fread($binaryContent, $chunkSize);
                if ($chunk === false) {
                    throw new \RuntimeException('Error reading the file.');
                }

                // Encrypt the chunk
                $encryptedChunk = Aesctr::encrypt($chunk, $key, 256);

                // Append the encrypted chunk
                $encryptedContent .= $encryptedChunk;
            }
        } finally {
            fclose($binaryContent);
        }

        return Aesctr::encrypt($encryptedContent, $key, 256);
    }


    public function decryptBase64($encryptedData, string $key)
    {
        return Aesctr::decrypt($encryptedData, $key, 256);
    }

    public function decyptBinary($encryptedData, string $key)
    {
        return Aesctr::decrypt($encryptedData, $key, 256);
    }

    public function download($file)
    {
        $reportData = ReportData::where('filename', $file)->first();
        if (!Storage::disk('local')->exists($reportData->path)) {
            return abort(404, 'file not found.');
        }
        return Storage::download($reportData->path, $reportData->filename, []);
    }

    public function delete($code)
    {
        $reportData = ReportData::where('id', $code)->first();
        return view('encryption.delete', ["reportData" => $reportData]);
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

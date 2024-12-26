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
    public function show()
    {
    }

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
        $key = $request->key;
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $fileName_without_ex = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $original_size = $file->getSize();

        $basepath = empty(env('APP_ENCRYPTED_BASE_PATH')) ? '/file_encrypt' : env('APP_ENCRYPTED_BASE_PATH');
        $filename_encrypt = $this->enrichfileName($fileName_without_ex);
        $file_output_path = $basepath . '/' . $filename_encrypt;

        ini_set('max_execution_time', -1);
        ini_set('memory_limit', -1);

        // $this->createBaseFolder($basepath);
        $timer = microtime(true);
        $this->encryptBinary($file, $key, $file_output_path);
        ReportData::create([
            'filename' => $fileName,
            'filename_encrypt' => $filename_encrypt,
            'extension' => $extension,
            'key' => $key,
            'path_encrypt' => $file_output_path,
            'original_size' => $original_size,
            'encrypt_size' => filesize($file_output_path),
            'encryption_time' => round(microtime(as_float: true) - $timer, 3),
        ]);
        return back()->with('success!');
    }

    public function enrichfileName($filename): string
    {
        $filename = strtolower(rand(1000, max: 100000) . "-" . $filename);
        $finalFileName = str_replace(' ', '-', $filename);
        $filename_encrypt = $finalFileName . '.' . 'rda';
        return $filename_encrypt;
    }

    public function createBaseFolder($basepath): void
    {
        if (!is_dir($basepath)) {
            if (!mkdir($basepath, 0777, true)) {
                die("failed to create folder: $basepath");
            }
            echo "Folder created: $basepath<br>";
        }
    }
    public function encryptBinary(UploadedFile $file, string $key, string $fileOutputPath): void
    {
        $chunkSize = 1024 * 64; // 64KB per chunk
        $binaryContent = fopen($file->getRealPath(), 'rb');
        $file_output = fopen($fileOutputPath, 'wb');
        try {
            while (!feof($binaryContent)) {
                $chunk = fread($binaryContent, $chunkSize);
                if ($chunk === false) {
                    throw new \RuntimeException('Error reading the file.');
                }

                $encryptedChunk = Aesctr::encrypt($chunk, $key, 256);
                fwrite($file_output, $encryptedChunk);
            }
        } finally {
            fclose($binaryContent);
            fclose($file_output);
        }
    }
    public function decyptBinary($filePath, $fileOutputPath, string $key)
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

    public function download($id)
    {
        $report_data = ReportData::where('id', $id)->first();

        $file_output_path = $report_data->path_encrypt;
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

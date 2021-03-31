<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function store(Request $request)
    {
        $uploadedFiles = $request->file();

        $response = [];

        /** @var UploadedFile $file */
        foreach ($uploadedFiles as $file) {
            $path = Storage::putFileAs(
                'public', $file, time() . '_' . $file->getClientOriginalName()
            );
            Storage::setVisibility($path, 'public');
            $response[] = '/' . $path;
        }

        return response()->json($response);
    }

    public function destroy(Request $request)
    {
        $name = $request->get('name');
        Storage::delete($name);

        return response()->json([
            'success' => 'File deleted'
        ]);
    }
}

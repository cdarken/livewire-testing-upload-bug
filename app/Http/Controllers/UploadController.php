<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function upload()
    {
        $validated = request()->validate([
            'file' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);

        $file = $validated['file'];
        Storage::disk('local')->put($file->getClientOriginalName(), $file->getContent());

        return response()->json(['success' => true]);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function index()
    {
        $files = Attachment::where('user_id', auth()->id())->get();
        return response()->json($files);
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf,doc,docx|max:2048',
        ]);

        $path = $request->file('file')->store('files', 'static');

        $file = Attachment::create([
            'user_id' => auth()->id(),
            'file_name' => $request->file('file')->getClientOriginalName(),
            'file_path' => $path,
            'file_type' => $request->file('file')->extension(), // assuming file type based on extension
        ]);

        return response()->json($file, 201);
    }

    public function show(Attachment $file)
    {
        return response()->json($file);
    }

    public function update(Request $request, Attachment $file)
    {
        $request->validate([
            'file' => 'required|mimes:pdf,doc,docx|max:2048',
        ]);

        Storage::disk('static')->delete($file->file_path);

        $path = $request->file('file')->store('files', 'static');

        $file->update([
            'user_id' => auth()->id(),
            'file_name' => $request->file('file')->getClientOriginalName(),
            'file_path' => $path,
            'file_type' => $request->file('file')->extension(),
        ]);

        return response()->json(['message' => 'File updated successfully', 'file' => $file], 200);
    }

    public function destroy(Attachment $file)
    {
        Storage::disk('static')->delete($file->file_path);
        $file->delete();

        return response()->json(['message' => 'File deleted successfully']);
    }
}

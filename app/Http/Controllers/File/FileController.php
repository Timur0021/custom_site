<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function index()
    {
        $files = Attachment::where('user_id', auth()->id())->get();
        return view('files.file', compact('files'));
    }

    public function create()
    {
        return view('files.create');
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
            'file_type' => $request->file('file')->extension(),
        ]);

        return redirect()->route('files.index')
            ->with('success', 'File uploaded successfully.');
    }

    public function show($id)
    {
        $file = Attachment::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('files.show', compact('file'));
    }

    public function edit($id)
    {
        $file = Attachment::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('files.edit', compact('file'));
    }

    public function update(Request $request, $id)
    {
        $file = Attachment::findOrFail($id);

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

        return redirect()->route('files.index')
            ->with('success', 'File updated successfully.');
    }

    public function destroy($id)
    {
        $file = Attachment::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        Storage::disk('static')->delete($file->file_path);

        $file->delete();

        return redirect()->route('files.index')
            ->with('success', 'File deleted successfully.');
    }

    public function download($id)
    {
        $file = Attachment::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $filePath = storage_path('app/static/' . $file->file_path);

        return response()->download($filePath, $file->file_name);
    }
}

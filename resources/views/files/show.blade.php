<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('File Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p><strong>File Name:</strong> {{ $file->file_name }}</p>
                    <p><strong>File Type:</strong> {{ $file->file_type }}</p>
                    <p><strong>Uploaded By:</strong> {{ $file->user->name }}</p>
                    <p><strong>Uploaded At:</strong> {{ $file->created_at->format('Y-m-d H:i:s') }}</p>

                    <div class="mt-4">
                        <a href="{{ route('files.edit', $file->id) }}" style="background-color: green; color: white; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; display: inline-block; text-decoration: none;">
                            Update File
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

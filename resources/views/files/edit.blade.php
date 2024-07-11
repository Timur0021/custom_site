<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit File') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('files.update', $file->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        {{-- Include hidden fields for user_id, file_name, file_path, file_type --}}
                        <input type="hidden" name="user_id" value="{{ $file->user_id }}">
                        <input type="hidden" name="file_name" value="{{ $file->file_name }}">
                        <input type="hidden" name="file_path" value="{{ $file->file_path }}">
                        <input type="hidden" name="file_type" value="{{ $file->file_type }}">

                        <div class="mb-4">
                            <label for="file" class="block text-sm font-medium text-gray-700">Replace File</label>
                            <input type="file" name="file" id="file" class="form-input rounded-md shadow-sm mt-1 block w-full"/>
                            @error('file')
                            <p class="text-red-500 mt-1 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" style="background-color: #ef4444; color: white; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; display: inline-block; text-decoration: none;">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

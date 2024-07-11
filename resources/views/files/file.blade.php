<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Files') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
                    <a href="{{ route('files.create') }}" style="background-color: #ef4444; color: white; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; display: inline-block; text-decoration: none;">
                        Upload File
                    </a>
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table-auto w-full">
                        <thead>
                        <tr>
                            <th class="px-4 py-2">ID</th>
                            <th class="px-4 py-2">File Name</th>
                            <th class="px-4 py-2">File Path</th>
                            <th class="px-4 py-2">File Type</th>
                            <th class="px-4 py-2">Created At</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($files as $file)
                            <tr>
                                <td class="border px-4 py-2">{{ $file->id }}</td>
                                <td class="border px-4 py-2">{{ $file->file_name }}</td>
                                <td class="border px-4 py-2">{{ $file->file_path }}</td>
                                <td class="border px-4 py-2">{{ $file->file_type }}</td>
                                <td class="border px-4 py-2">{{ $file->created_at }}</td>
                                <td class="border px-4 py-2">
                                    <a href="{{ route('files.show', $file->id) }}" class="text-blue-500 hover:text-blue-700">View</a>
                                    <a href="{{ route('files.edit', $file->id) }}" class="text-yellow-500 hover:text-yellow-700 mx-2">Edit</a>
                                    <form action="{{ route('files.destroy', $file->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                                    </form>
                                    <a href="{{ route('files.download', $file->id) }}" class="text-green-500 hover:text-green-700 ml-2">Download</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

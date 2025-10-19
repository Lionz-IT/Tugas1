@extends('master')

@section('title', 'Edit Departemen')

@section('content')
<div class="container mx-auto max-w-xl">
    <div class="bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit Departemen</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Oops! Terjadi kesalahan:</strong>
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form action ke route 'update' dan method 'PUT' --}}
        <form action="{{ route('departments.update', $department->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT') {{-- Wajib untuk Update --}}

            <div>
                <label for="nama_departemen" class="block text-sm font-medium text-gray-700 mb-1">Nama Departemen</label>
                {{-- value diisi dengan data lama --}}
                <input type="text" id="nama_departemen" name="nama_departemen" 
                       value="{{ old('nama_departemen', $department->nama_departemen) }}" 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                       required>
                
                @error('nama_departemen')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-4 pt-4">
                <a href="{{ route('departments.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg shadow transition duration-300">
                    Batal
                </a>
                <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-lg shadow transition duration-300">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
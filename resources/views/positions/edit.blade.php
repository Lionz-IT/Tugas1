@extends('master')

@section('title', 'Edit Jabatan')

@section('content')
<div class="container mx-auto max-w-xl">
    <div class="bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit Jabatan</h1>

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
        <form action="{{ route('positions.update', $position->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT') {{-- Wajib untuk Update --}}

            <div>
                <label for="nama_jabatan" class="block text-sm font-medium text-gray-700 mb-1">Nama Jabatan</label>
                {{-- value diisi dengan data lama --}}
                <input type="text" id="nama_jabatan" name="nama_jabatan" 
                       value="{{ old('nama_jabatan', $position->nama_jabatan) }}" 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                       required>
                
                @error('nama_jabatan')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="gaji_pokok" class="block text-sm font-medium text-gray-700 mb-1">Gaji Pokok</label>
                {{-- value diisi dengan data lama --}}
                <input type="number" id="gaji_pokok" name="gaji_pokok" 
                       value="{{ old('gaji_pokok', $position->gaji_pokok) }}" 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                       min="0" required>
                
                @error('gaji_pokok')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-4 pt-4">
                <a href="{{ route('positions.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg shadow transition duration-300">
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
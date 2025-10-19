@extends('master')

@section('title', 'Detail Departemen')

@section('content')
<div class="container mx-auto max-w-xl">
    <div class="bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Detail Departemen</h1>

        <div class="space-y-4">
            <div class="border-b pb-4">
                <label class="text-sm font-medium text-gray-600">Nama Departemen</label>
                <p class="text-lg font-semibold text-gray-900">{{ $department->nama_departemen }}</p>
            </div>
            
            <div class="border-b pb-4">
                <label class="text-sm font-medium text-gray-600">Dibuat Pada</label>
                <p class="text-lg font-semibold text-gray-900">{{ $department->created_at->format('l, d F Y H:i') }}</Tgl Dibuat</p>
            </div>

            <div class="pb-4">
                <label class="text-sm font-medium text-gray-600">Terakhir Diperbarui</label>
                <p class="text-lg font-semibold text-gray-900">{{ $department->updated_at->format('l, d F Y H:i') }}</p>
            </div>
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex justify-end space-x-4 mt-8">
            <a href="{{ route('departments.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg shadow transition duration-300">
                Kembali
            </a>
            <a href="{{ route('departments.edit', $department->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-lg shadow transition duration-300">
                Edit
            </a>
        </div>
    </div>
</div>
@endsection
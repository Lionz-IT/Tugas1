@extends('master')

@section('title', 'Detail Jabatan')

@section('content')
<div class="container mx-auto max-w-xl">
    <div class="bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Detail Jabatan</h1>

        <div class="space-y-4">
            <div class="border-b pb-4">
                <label class="text-sm font-medium text-gray-600">Nama Jabatan</label>
                <p class="text-lg font-semibold text-gray-900">{{ $position->nama_jabatan }}</p>
            </div>

            <div class="border-b pb-4">
                <label class="text-sm font-medium text-gray-600">Gaji Pokok</label>
                <p class="text-lg font-semibold text-gray-900">Rp {{ number_format($position->gaji_pokok, 0, ',', '.') }}</p>
            </div>
            
            <div class="border-b pb-4">
                <label class="text-sm font-medium text-gray-600">Dibuat Pada</label>
                <p class="text-lg font-semibold text-gray-900">{{ $position->created_at->format('l, d F Y H:i') }}</Tgl Dibuat</p>
            </div>

            <div class="pb-4">
                <label class="text-sm font-medium text-gray-600">Terakhir Diperbarui</label>
                <p class="text-lg font-semibold text-gray-900">{{ $position->updated_at->format('l, d F Y H:i') }}</p>
            </div>
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex justify-end space-x-4 mt-8">
            <a href="{{ route('positions.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg shadow transition duration-300">
                Kembali
            </a>
            <a href="{{ route('positions.edit', $position->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-lg shadow transition duration-300">
                Edit
            </a>
        </div>
    </div>
</div>
@endsection
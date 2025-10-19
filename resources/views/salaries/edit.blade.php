@extends('master')

@section('title', 'Edit Riwayat Gaji')

@section('content')
<div class="container mx-auto max-w-2xl">
    <div class="bg-white p-8 rounded-lg shadow-lg text-center">
        <h1 class="text-2xl font-bold text-red-600 mb-4">Aksi Tidak Diizinkan</h1>
        <p class="text-gray-700 mb-6">
            Mengedit riwayat gaji yang sudah diproses tidak disarankan untuk menjaga integritas data. 
            Jika terjadi kesalahan, hapus data ini dan proses ulang gaji.
        </p>
        <a href="{{ route('salaries.index') }}" 
           class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg shadow transition duration-300">
            Kembali ke Laporan Gaji
        </a>
    </div>
</div>
@endsection
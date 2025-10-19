{{-- 1. Mewarisi layout utama dari master.blade.php --}}
@extends('master')

{{-- 2. Mengatur judul halaman --}}
@section('title', 'Selamat Datang - Manajemen Karyawan')

{{-- 3. Ini adalah konten utama halaman --}}
@section('content')
    
    {{-- Bagian Header Selamat Datang --}}
    <div class="bg-white shadow-lg rounded-lg p-10 text-center mb-8">
        <h1 class="text-4xl font-bold text-blue-600 mb-4">
            Selamat Datang di Aplikasi Manajemen Karyawan
        </h1>
        <p class="text-lg text-gray-700">
            Kelola semua data karyawan, departemen, jabatan, absensi, dan penggajian di satu tempat.
        </p>
    </div>

    {{-- Bagian Link Akses Cepat --}}
    <div>   
        <h2 class="text-2xl font-semibold text-gray-800 mb-5">Menu Utama</h2>
        
        {{-- Kontainer Grid untuk "Kartu" Menu --}}
        {{-- 'gap-6' memberi jarak, 'grid-cols-3' membuat 3 kolom di layar besar --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            
            {{-- Kartu Karyawan --}}
            <a href="{{ route('employees.index') }}" 
               class="block bg-white shadow-md rounded-lg p-6 transition-transform transform hover:scale-105 hover:shadow-xl">
                <h3 class="text-xl font-semibold text-blue-700 mb-2">Kelola Karyawan</h3>
                <p class="text-gray-600">Lihat, tambah, edit, dan hapus data karyawan.</p>
            </a>

            {{-- Kartu Departemen --}}
            <a href="{{ route('departments.index') }}" 
               class="block bg-white shadow-md rounded-lg p-6 transition-transform transform hover:scale-105 hover:shadow-xl">
                <h3 class="text-xl font-semibold text-blue-700 mb-2">Kelola Departemen</h3>
                <p class="text-gray-600">Atur semua departemen perusahaan.</p>
            </a>

            {{-- Kartu Jabatan --}}
            <a href="{{ route('positions.index') }}" 
               class="block bg-white shadow-md rounded-lg p-6 transition-transform transform hover:scale-105 hover:shadow-xl">
                <h3 class="text-xl font-semibold text-blue-700 mb-2">Kelola Jabatan</h3>
                <p class="text-gray-600">Atur jabatan dan gaji pokok terkait.</p>
            </a>

            {{-- Kartu Absensi --}}
            <a href="{{ route('attendances.index') }}" 
               class="block bg-white shadow-md rounded-lg p-6 transition-transform transform hover:scale-105 hover:shadow-xl">
                <h3 class="text-xl font-semibold text-blue-700 mb-2">Laporan Absensi</h3>
                <p class="text-gray-600">Lihat riwayat absensi harian karyawan.</p>
            </a>

            {{-- Kartu Gaji --}}
            <a href="{{ route('salaries.index') }}" 
               class="block bg-white shadow-md rounded-lg p-6 transition-transform transform hover:scale-105 hover:shadow-xl">
                <h3 class="text-xl font-semibold text-blue-700 mb-2">Proses Gaji</h3>
                <p class="text-gray-600">Proses dan lihat riwayat penggajian.</p>
            </a>

            {{-- Kamu bisa tambahkan kartu lain di sini jika perlu --}}

        </div>
    </div>

@endsection
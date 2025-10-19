@extends('master')

@section('title', 'Detail Absensi')

@section('content')
<div class="container mx-auto max-w-2xl">
    <div class="bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Detail Absensi</h1>

        <div class="space-y-4">
            <div class="border-b pb-4">
                <label class="text-sm font-medium text-gray-600">Karyawan</label>
                <p class="text-lg font-semibold text-gray-900">{{ $attendance->employee->nama_karyawan ?? 'N/A' }}</p>
            </div>

            <div class="border-b pb-4">
                <label class="text-sm font-medium text-gray-600">Tanggal</label>
                <p class="text-lg font-semibold text-gray-900">{{ \Carbon\Carbon::parse($attendance->date)->format('l, d F Y') }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-b pb-4">
                <div>
                    <label class="text-sm font-medium text-gray-600">Check In</label>
                    <p class="text-lg font-semibold text-gray-900">{{ $attendance->check_in }}</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-600">Check Out</label>
                    <p class="text-lg font-semibold text-gray-900">{{ $attendance->check_out ?? '-' }}</p>
                </div>
            </div>

            <div class="pb-4">
                <label class="text-sm font-medium text-gray-600">Status</label>
                <p class="text-lg font-semibold">
                    <span class="px-3 py-1 inline-flex text-base leading-5 font-semibold rounded-full 
                                {{ $attendance->status == 'Hadir' ? 'bg-green-100 text-green-800' : 
                                   ($attendance->status == 'Terlambat' ? 'bg-yellow-100 text-yellow-800' : 
                                   'bg-red-100 text-red-800') }}">
                        {{ $attendance->status }}
                    </span>
                </p>
            </div>
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex justify-end space-x-4 mt-8">
            <a href="{{ route('attendances.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg shadow transition duration-300">
                Kembali ke Laporan
            </a>
            <a href="{{ route('attendances.edit', $attendance->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-lg shadow transition duration-300">
                Edit Data
            </a>
        </div>
    </div>
</div>
@endsection 
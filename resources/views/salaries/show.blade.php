@extends('master')

@section('title', 'Detail Gaji Karyawan')

@section('content')
<div class="container mx-auto max-w-2xl">
    <div class="bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Detail Gaji</h1>

        {{-- Informasi Karyawan dan Periode --}}
        <div class="mb-6 border-b pb-4">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-sm font-medium text-gray-600">Nama Karyawan</label>
                    <p class="text-lg font-semibold text-gray-900">{{ $salary->employee->nama_karyawan ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-600">Jabatan</label>
                    <p class="text-lg font-semibold text-gray-900">{{ $salary->employee->position->nama_jabatan ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-600">Departemen</label>
                    <p class="text-lg font-semibold text-gray-900">{{ $salary->employee->department->nama_departemen ?? 'N/A' }}</p>
                </div>
                 <div>
                    <label class="text-sm font-medium text-gray-600">Tanggal Pembayaran</label>
                    <p class="text-lg font-semibold text-gray-900">{{ \Carbon\Carbon::parse($salary->payment_date)->format('l, d F Y') }}</p>
                </div>
            </div>
        </div>

        {{-- Rincian Gaji --}}
        <div class="space-y-3">
            <h2 class="text-xl font-semibold text-gray-700 mb-3">Rincian Pendapatan & Potongan</h2>
            
            {{-- Gaji Pokok --}}
            <div class="flex justify-between items-center border-b py-2">
                <span class="text-gray-600">Gaji Pokok</span>
                <span class="font-medium text-gray-900">Rp {{ number_format($salary->base_salary, 0, ',', '.') }}</span>
            </div>

            {{-- Bonus --}}
            <div class="flex justify-between items-center border-b py-2">
                <span class="text-gray-600">Bonus</span>
                <span class="font-medium text-green-600">+ Rp {{ number_format($salary->bonus, 0, ',', '.') }}</span>
            </div>

            {{-- Potongan --}}
            <div class="flex justify-between items-center border-b py-2">
                <span class="text-gray-600">Potongan</span>
                <span class="font-medium text-red-600">- Rp {{ number_format($salary->deductions, 0, ',', '.') }}</span>
            </div>

            {{-- Gaji Bersih (Net Pay) --}}
            <div class="flex justify-between items-center pt-4 mt-2">
                <span class="text-lg font-bold text-gray-800">Gaji Bersih (Net Pay)</span>
                <span class="text-lg font-bold text-blue-700">Rp {{ number_format($salary->net_pay, 0, ',', '.') }}</span>
            </div>
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex justify-end space-x-4 mt-8">
            <a href="{{ route('salaries.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg shadow transition duration-300">
                Kembali ke Laporan
            </a>
            {{-- Tombol Cetak (hanya contoh, butuh JS tambahan) --}}
            <button onclick="window.print()" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow transition duration-300">
                Cetak Slip
            </button>
        </div>
    </div>
</div>
@endsection
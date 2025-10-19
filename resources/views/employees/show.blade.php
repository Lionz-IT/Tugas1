@extends('master')

@section('title', 'Detail Karyawan')

@section('content')
<div class="container mx-auto max-w-2xl">
    <div class="bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Detail Karyawan</h1>

        <div class="space-y-4">
            {{-- Informasi Pribadi --}}
             <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-b pb-4">
                <div>
                    <label class="text-sm font-medium text-gray-600">Nama Karyawan</label>
                    <p class="text-lg font-semibold text-gray-900">{{ $employee->nama_karyawan }}</p>
                </div>
                 <div>
                    <label class="text-sm font-medium text-gray-600">Email</label>
                    <p class="text-lg font-semibold text-gray-900">{{ $employee->email }}</p>
                </div>
                 <div>
                    <label class="text-sm font-medium text-gray-600">Nomor Telepon</label>
                    <p class="text-lg font-semibold text-gray-900">{{ $employee->nomor_telepon ?? '-' }}</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-600">Tanggal Lahir</label>
                    <p class="text-lg font-semibold text-gray-900">
                        {{ $employee->tanggal_lahir ? \Carbon\Carbon::parse($employee->tanggal_lahir)->format('d F Y') : '-' }}
                    </p>
                </div>
            </div>

             <div class="border-b pb-4">
                <label class="text-sm font-medium text-gray-600">Alamat</label>
                <p class="text-lg font-semibold text-gray-900">{{ $employee->alamat ?? '-' }}</p>
            </div>

            {{-- Informasi Pekerjaan --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-b pb-4">
                 <div>
                    <label class="text-sm font-medium text-gray-600">Tanggal Masuk</label>
                    <p class="text-lg font-semibold text-gray-900">
                        {{ $employee->tanggal_masuk ? \Carbon\Carbon::parse($employee->tanggal_masuk)->format('d F Y') : '-' }}
                    </p>
                </div>
                 <div>
                    <label class="text-sm font-medium text-gray-600">Status</label>
                     <p class="text-lg font-semibold">
                        <span class="px-3 py-1 inline-flex text-base leading-5 font-semibold rounded-full 
                                    {{ $employee->status == 'aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ ucfirst($employee->status) }}
                        </span>
                    </p>
                </div>
                 <div>
                    <label class="text-sm font-medium text-gray-600">Departemen</label>
                    <p class="text-lg font-semibold text-gray-900">{{ $employee->department->nama_departemen ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-600">Jabatan</label>
                    <p class="text-lg font-semibold text-gray-900">{{ $employee->position->nama_jabatan ?? 'N/A' }}</p>
                </div>
                 <div>
                    <label class="text-sm font-medium text-gray-600">Gaji Pokok</label>
                    <p class="text-lg font-semibold text-gray-900">
                        Rp {{ number_format($employee->position->gaji_pokok ?? 0, 0, ',', '.') }}
                    </p>
                </div>
            </div>
            
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex justify-end space-x-4 mt-8">
            <a href="{{ route('employees.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg shadow transition duration-300">
                Kembali ke Daftar
            </a>
            <a href="{{ route('employees.edit', $employee->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-lg shadow transition duration-300">
                Edit
            </a>
        </div>
    </div>
</div>
@endsection
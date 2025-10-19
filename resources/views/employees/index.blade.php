@extends('master')

@section('title', 'Daftar Karyawan')

@section('content')
<div class="container mx-auto">
    
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Daftar Karyawan</h1>
        <a href="{{ route('employees.create') }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300">
            + Tambah Karyawan
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white shadow-lg rounded-lg overflow-x-auto"> {{-- Add overflow-x-auto for responsiveness --}}
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="py-3 px-4 text-left text-xs font-medium uppercase tracking-wider">#</th>
                    <th class="py-3 px-4 text-left text-xs font-medium uppercase tracking-wider">Nama</th>
                    <th class="py-3 px-4 text-left text-xs font-medium uppercase tracking-wider">Email</th>
                    <th class="py-3 px-4 text-left text-xs font-medium uppercase tracking-wider">Telepon</th>
                    <th class="py-3 px-4 text-left text-xs font-medium uppercase tracking-wider">Departemen</th>
                    <th class="py-3 px-4 text-left text-xs font-medium uppercase tracking-wider">Jabatan</th>
                    <th class="py-3 px-4 text-left text-xs font-medium uppercase tracking-wider">Tgl Masuk</th>
                    <th class="py-3 px-4 text-left text-xs font-medium uppercase tracking-wider">Status</th>
                    <th class="py-3 px-4 text-left text-xs font-medium uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($employees as $employee)
                    <tr class="hover:bg-gray-50">
                        <td class="py-4 px-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                        <td class="py-4 px-4 whitespace-nowrap font-medium text-gray-900">{{ $employee->nama_karyawan }}</td>
                        <td class="py-4 px-4 whitespace-nowrap text-sm text-gray-600">{{ $employee->email }}</td>
                        <td class="py-4 px-4 whitespace-nowrap text-sm text-gray-600">{{ $employee->nomor_telepon ?? '-' }}</td>
                        <td class="py-4 px-4 whitespace-nowrap text-sm text-gray-600">{{ $employee->department->nama_departemen ?? 'N/A' }}</td>
                        <td class="py-4 px-4 whitespace-nowrap text-sm text-gray-600">{{ $employee->position->nama_jabatan ?? 'N/A' }}</td>
                        <td class="py-4 px-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $employee->tanggal_masuk ? \Carbon\Carbon::parse($employee->tanggal_masuk)->format('d M Y') : '-' }}
                        </td>
                         <td class="py-4 px-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $employee->status == 'aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ ucfirst($employee->status) }}
                            </span>
                        </td>
                        <td class="py-4 px-4 whitespace-nowrap flex space-x-2">
                            <a href="{{ route('employees.show', $employee->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white text-sm py-1 px-3 rounded shadow">Detail</a>
                            <a href="{{ route('employees.edit', $employee->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white text-sm py-1 px-3 rounded shadow">Edit</a>
                            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus karyawan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-sm py-1 px-3 rounded shadow">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center py-6 text-gray-500"> {{-- Update colspan --}}
                            Belum ada data karyawan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="mt-6">
        {{ $employees->links() }}
    </div>
</div>
@endsection
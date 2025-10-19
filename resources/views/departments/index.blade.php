{{-- Mewarisi layout master --}}
@extends('master')

{{-- Mengatur judul halaman --}}
@section('title', 'Daftar Departemen')

{{-- Mengisi konten halaman --}}
@section('content')
<div class="container mx-auto">
    
    {{-- Judul dan Tombol Tambah --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Daftar Departemen</h1>
        <a href="{{ route('departments.create') }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300">
            + Tambah Departemen
        </a>
    </div>

    {{-- Pesan Sukses (Success Alert) --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    {{-- Pesan Gagal (Error Alert) --}}
    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    {{-- Tabel Departemen --}}
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th scope="col" class="py-3 px-6 text-left text-xs font-medium uppercase tracking-wider">#</th>
                    <th scope="col" class="py-3 px-6 text-left text-xs font-medium uppercase tracking-wider">Nama Departemen</th>
                    <th scope="col" class="py-3 px-6 text-left text-xs font-medium uppercase tracking-wider">Tgl Dibuat</th>
                    <th scope="col" class="py-3 px-6 text-left text-xs font-medium uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($departments as $department)
                    <tr class="hover:bg-gray-50">
                        <td class="py-4 px-6 whitespace-nowrap">{{ $loop->iteration }}</td>
                        <td class="py-4 px-6 whitespace-nowrap font-medium text-gray-900">{{ $department->nama_departemen }}</td>
                        <td class="py-4 px-6 whitespace-nowrap text-sm text-gray-500">{{ $department->created_at->format('d M Y') }}</td>
                        <td class="py-4 px-6 whitespace-nowrap flex space-x-2">
                            {{-- Tombol Edit --}}
                            <a href="{{ route('departments.edit', $department->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white text-sm py-1 px-3 rounded shadow">Edit</a>
                            
                            {{-- Tombol Hapus --}}
                            <form action="{{ route('departments.destroy', $department->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus departemen ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-sm py-1 px-3 rounded shadow">Hapus</button>
                            </form>
                        </td>
                    </tr>
                {{-- Bagian jika tidak ada data --}}
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-6 text-gray-500">
                            Belum ada data departemen.
                        </td>
                    </tr>
                @endforelse {{-- Penutup @forelse --}}
            </tbody>
        </table>
    </div> {{-- Penutup div tabel --}}
    
    {{-- Link Paginasi --}}
    <div class="mt-6">
        {{ $departments->links() }}
    </div>
</div> {{-- Penutup div container --}}

@endsection {{-- Penutup @section('content') --}}
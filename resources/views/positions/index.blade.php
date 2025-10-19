{{-- Mewarisi layout master --}}
@extends('master')

{{-- Mengatur judul halaman --}}
@section('title', 'Daftar Jabatan')

{{-- Mengisi konten halaman --}}
@section('content')
<div class="container mx-auto">
    
    {{-- Judul dan Tombol Tambah --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Daftar Jabatan</h1>
        <a href="{{ route('positions.create') }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300">
            + Tambah Jabatan
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

    {{-- Tabel Jabatan --}}
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th scope="col" class="py-3 px-6 text-left text-xs font-medium uppercase tracking-wider">#</th>
                    <th scope="col" class="py-3 px-6 text-left text-xs font-medium uppercase tracking-wider">Nama Jabatan</th>
                    <th scope="col" class="py-3 px-6 text-left text-xs font-medium uppercase tracking-wider">Gaji Pokok</th>
                    <th scope="col" class="py-3 px-6 text-left text-xs font-medium uppercase tracking-wider">Tgl Dibuat</th>
                    <th scope="col" class="py-3 px-6 text-left text-xs font-medium uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($positions as $position)
                    <tr class="hover:bg-gray-50">
                        <td class="py-4 px-6 whitespace-nowrap">{{ $loop->iteration }}</td>
                        <td class="py-4 px-6 whitespace-nowrap font-medium text-gray-900">{{ $position->nama_jabatan }}</td>
                        <td class="py-4 px-6 whitespace-nowrap text-sm text-gray-700">Rp {{ number_format($position->gaji_pokok, 0, ',', '.') }}</td>
                        <td class="py-4 px-6 whitespace-nowrap text-sm text-gray-500">{{ $position->created_at->format('d M Y') }}</td>
                        <td class="py-4 px-6 whitespace-nowrap flex space-x-2">
                            <a href="{{ route('positions.show', $position->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white text-sm py-1 px-3 rounded shadow">Detail</a>
                            <a href="{{ route('positions.edit', $position->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white text-sm py-1 px-3 rounded shadow">Edit</a>
                            
                            {{-- Tombol Hapus --}}
                            <form action="{{ route('positions.destroy', $position->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jabatan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-sm py-1 px-3 rounded shadow">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    {{-- Jika tidak ada data --}}
                    <tr>
                        <td colspan="5" class="text-center py-6 text-gray-500">
                            Belum ada data jabatan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    {{-- Link Paginasi --}}
    <div class="mt-6">
        {{ $positions->links() }}
    </div>
</div>
@endsection
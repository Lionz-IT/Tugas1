{{-- Mewarisi layout master --}}
@extends('master')

{{-- Mengatur judul halaman --}}
@section('title', 'Laporan Absensi')

{{-- Mengisi konten halaman --}}
@section('content')
<div class="container mx-auto">
    
    {{-- Judul dan Tombol Tambah --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Laporan Absensi</h1>
        <a href="{{ route('attendances.create') }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300">
            + Catat Absensi Manual
        </a>
    </div>

    {{-- Pesan Sukses (jika ada) --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    {{-- Tabel Laporan --}}
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th scope="col" class="py-3 px-6 text-left text-xs font-medium uppercase tracking-wider">#</th>
                    <th scope="col" class="py-3 px-6 text-left text-xs font-medium uppercase tracking-wider">Karyawan</th>
                    <th scope="col" class="py-3 px-6 text-left text-xs font-medium uppercase tracking-wider">Tanggal</th>
                    <th scope="col" class="py-3 px-6 text-left text-xs font-medium uppercase tracking-wider">Check In</th>
                    <th scope="col" class="py-3 px-6 text-left text-xs font-medium uppercase tracking-wider">Check Out</th>
                    <th scope="col" class="py-3 px-6 text-left text-xs font-medium uppercase tracking-wider">Status</th>
                    <th scope="col" class="py-3 px-6 text-left text-xs font-medium uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($attendances as $attendance)
                    <tr class="hover:bg-gray-50">
                        <td class="py-4 px-6">{{ $loop->iteration }}</td>
                        <td class="py-4 px-6 whitespace-nowrap">
                            {{-- Ambil nama dari relasi 'employee' --}}
                            {{ $attendance->employee->nama_karyawan ?? 'Karyawan Dihapus' }}
                        </td>
                        <td class="py-4 px-6 whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($attendance->date)->format('d M Y') }}
                        </td>
                        <td class="py-4 px-6 whitespace-nowrap">{{ $attendance->check_in }}</td>
                        <td class="py-4 px-6 whitespace-nowrap">{{ $attendance->check_out ?? '-' }}</td>
                        <td class="py-4 px-6 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $attendance->status == 'Hadir' ? 'bg-green-100 text-green-800' : 
                                           ($attendance->status == 'Terlambat' ? 'bg-yellow-100 text-yellow-800' : 
                                           'bg-red-100 text-red-800') }}">
                                {{ $attendance->status }}
                            </span>
                        </td>
                        <td class="py-4 px-6 whitespace-nowrap flex space-x-2">
                            <a href="{{ route('attendances.show', $attendance->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white text-sm py-1 px-3 rounded shadow">Detail</a>
                            <a href="{{ route('attendances.edit', $attendance->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white text-sm py-1 px-3 rounded shadow">Edit</a>
                            <form action="{{ route('attendances.destroy', $attendance->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-sm py-1 px-3 rounded shadow">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-6 text-gray-500">
                            Belum ada data absensi.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    {{-- Pagination Links --}}
    <div class="mt-6">
        {{ $attendances->links() }}
    </div>
</div>
@endsection
@extends('master')

@section('title', 'Laporan Gaji Karyawan')

@section('content')
<div class="container mx-auto">
    
    {{-- Judul dan Tombol Proses Gaji --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Laporan Gaji</h1>
        <a href="{{ route('salaries.create') }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300">
            + Proses Gaji Baru
        </a>
    </div>

    {{-- Pesan Sukses/Error --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
     @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    {{-- Tabel Laporan Gaji --}}
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th scope="col" class="py-3 px-6 text-left text-xs font-medium uppercase tracking-wider">#</th>
                    <th scope="col" class="py-3 px-6 text-left text-xs font-medium uppercase tracking-wider">Nama Karyawan</th>
                    <th scope="col" class="py-3 px-6 text-left text-xs font-medium uppercase tracking-wider">Tgl Pembayaran</th>
                    <th scope="col" class="py-3 px-6 text-left text-xs font-medium uppercase tracking-wider">Gaji Pokok</th>
                    <th scope="col" class="py-3 px-6 text-left text-xs font-medium uppercase tracking-wider">Bonus</th>
                    <th scope="col" class="py-3 px-6 text-left text-xs font-medium uppercase tracking-wider">Potongan</th>
                    <th scope="col" class="py-3 px-6 text-left text-xs font-medium uppercase tracking-wider">Gaji Bersih</th>
                    <th scope="col" class="py-3 px-6 text-left text-xs font-medium uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($salaries as $salary)
                    <tr class="hover:bg-gray-50">
                        <td class="py-4 px-6 whitespace-nowrap">{{ $loop->iteration }}</td>
                        <td class="py-4 px-6 whitespace-nowrap font-medium text-gray-900">
                            {{ $salary->employee->nama_karyawan ?? 'Karyawan Dihapus' }}
                        </td>
                        <td class="py-4 px-6 whitespace-nowrap text-sm text-gray-500">
                            {{ \Carbon\Carbon::parse($salary->payment_date)->format('d M Y') }}
                        </td>
                        <td class="py-4 px-6 whitespace-nowrap text-sm text-right text-gray-700">Rp {{ number_format($salary->base_salary, 0, ',', '.') }}</td>
                        <td class="py-4 px-6 whitespace-nowrap text-sm text-right text-green-600">Rp {{ number_format($salary->bonus, 0, ',', '.') }}</td>
                        <td class="py-4 px-6 whitespace-nowrap text-sm text-right text-red-600">Rp {{ number_format($salary->deductions, 0, ',', '.') }}</td>
                        <td class="py-4 px-6 whitespace-nowrap text-sm text-right font-semibold text-gray-900">Rp {{ number_format($salary->net_pay, 0, ',', '.') }}</td>
                        <td class="py-4 px-6 whitespace-nowrap flex space-x-2">
                             <a href="{{ route('salaries.show', $salary->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white text-sm py-1 px-3 rounded shadow">Detail</a>
                            {{-- Tombol Hapus --}}
                            <form action="{{ route('salaries.destroy', $salary->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus riwayat gaji ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-sm py-1 px-3 rounded shadow">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-6 text-gray-500">
                            Belum ada data riwayat gaji.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    {{-- Link Paginasi --}}
    <div class="mt-6">
        {{ $salaries->links() }}
    </div>
</div>
@endsection
@extends('master')

@section('title', 'Edit Data Absensi')

@section('content')
<div class="container mx-auto max-w-2xl">
    <div class="bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit Data Absensi</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Oops! Terjadi kesalahan:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('attendances.update', $attendance->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT') {{-- Penting untuk edit --}}

            <div>
                <label for="employee_id" class="block text-sm font-medium text-gray-700 mb-1">Karyawan</label>
                <select id="employee_id" name="employee_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    <option value="" disabled>Pilih Karyawan</option>
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}" 
                                {{ old('employee_id', $attendance->employee_id) == $employee->id ? 'selected' : '' }}>
                            {{ $employee->nama_karyawan }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                <input type="date" id="date" name="date" 
                       value="{{ old('date', $attendance->date) }}" 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="check_in" class="block text-sm font-medium text-gray-700 mb-1">Check In</label>
                    <input type="time" id="check_in" name="check_in" 
                           value="{{ old('check_in', $attendance->check_in) }}" 
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                </div>
                <div>
                    <label for="check_out" class="block text-sm font-medium text-gray-700 mb-1">Check Out (Opsional)</label>
                    <input type="time" id="check_out" name="check_out" 
                           value="{{ old('check_out', $attendance->check_out) }}" 
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
            </div>

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select id="status" name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    @php $statusOptions = ['Hadir', 'Terlambat', 'Izin', 'Sakit', 'Cuti']; @endphp
                    @foreach ($statusOptions as $status)
                        <option value="{{ $status }}" 
                                {{ old('status', $attendance->status) == $status ? 'selected' : '' }}>
                            {{ $status }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-end space-x-4 pt-4">
                <a href="{{ route('attendances.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg shadow transition duration-300">
                    Batal
                </a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow transition duration-300">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
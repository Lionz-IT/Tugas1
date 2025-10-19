@extends('master')

@section('title', 'Proses Gaji Karyawan')

@section('content')
<div class="container mx-auto max-w-2xl">
    <div class="bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Proses Gaji Baru</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Oops! Terjadi kesalahan:</strong>
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('salaries.store') }}" method="POST" class="space-y-6">
            @csrf
            
            {{-- Dropdown Karyawan --}}
            <div>
                <label for="employee_id" class="block text-sm font-medium text-gray-700 mb-1">Pilih Karyawan</label>
                <select id="employee_select" name="employee_id" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    <option value="" disabled selected>Pilih seorang karyawan...</option>
                    @foreach ($employees as $employee)
                        {{-- Simpan gaji pokok di data attribute --}}
                        <option value="{{ $employee->id }}" 
                                data-gaji_pokok="{{ $employee->position->gaji_pokok ?? 0 }}" 
                                {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                            {{ $employee->nama_karyawan }} ({{ $employee->position->nama_jabatan ?? 'N/A' }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="payment_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Pembayaran</label>
                <input type="date" id="payment_date" name="payment_date" 
                       value="{{ old('payment_date', date('Y-m-d')) }}" 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
            </div>

            {{-- Gaji Pokok (Readonly, diisi oleh JS) --}}
            <div>
                <label for="base_salary" class="block text-sm font-medium text-gray-700 mb-1">Gaji Pokok</label>
                <input type="number" id="base_salary" name="base_salary" 
                       value="{{ old('base_salary', 0) }}" 
                       class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 shadow-sm focus:outline-none focus:ring-0 focus:border-gray-300" readonly>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Bonus --}}
                <div>
                    <label for="bonus" class="block text-sm font-medium text-gray-700 mb-1">Bonus (Opsional)</label>
                    <input type="number" id="bonus" name="bonus" 
                           value="{{ old('bonus', 0) }}" min="0" 
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                {{-- Potongan --}}
                <div>
                    <label for="deductions" class="block text-sm font-medium text-gray-700 mb-1">Potongan (Opsional)</label>
                    <input type="number" id="deductions" name="deductions" 
                           value="{{ old('deductions', 0) }}" min="0"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
            </div>

            <hr class="my-4">
            
            {{-- Gaji Bersih (Readonly, diisi oleh JS) --}}
            <div>
                <label for="net_pay" class="block text-sm font-medium text-gray-700 mb-1">Gaji Bersih (Net Pay)</label>
                <input type="number" id="net_pay" name="net_pay" 
                       value="{{ old('net_pay', 0) }}" 
                       class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 shadow-sm focus:outline-none focus:ring-0 focus:border-gray-300 font-semibold text-lg" readonly>
            </div>

            {{-- Tombol Simpan dan Batal --}}
            <div class="flex justify-end space-x-4 pt-4">
                <a href="{{ route('salaries.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg shadow transition duration-300">
                    Batal
                </a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow transition duration-300">
                    Simpan dan Proses
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Script untuk hitung otomatis --}}
<script>
    // Ambil elemen-elemen yang dibutuhkan
    const employeeSelect = document.getElementById('employee_select');
    const baseSalaryInput = document.getElementById('base_salary');
    const bonusInput = document.getElementById('bonus');
    const deductionsInput = document.getElementById('deductions');
    const netPayInput = document.getElementById('net_pay');

    // Fungsi untuk menghitung total
    function calculateNetPay() {
        const base = parseFloat(baseSalaryInput.value) || 0;
        const bonus = parseFloat(bonusInput.value) || 0;
        const deductions = parseFloat(deductionsInput.value) || 0;
        const netPay = base + bonus - deductions;
        netPayInput.value = netPay >= 0 ? netPay : 0; // Pastikan tidak negatif
    }

    // Event listener saat KARYAWAN DIPILIH
    employeeSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const gajiPokok = selectedOption.getAttribute('data-gaji_pokok');
        baseSalaryInput.value = gajiPokok;
        calculateNetPay(); // Hitung ulang total
    });

    // Event listener saat input bonus atau potongan BERUBAH
    bonusInput.addEventListener('input', calculateNetPay);
    deductionsInput.addEventListener('input', calculateNetPay);
    
    // Hitung saat halaman pertama kali dimuat (jika ada old value)
    document.addEventListener('DOMContentLoaded', calculateNetPay); 
</script>
@endsection
<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use App\Models\Employee; 
use Illuminate\Http\Request;

class SalaryController extends Controller
{

    public function index()
    {
        $salaries = Salary::with('employee')->latest()->paginate(10);
        return view('salaries.index', compact('salaries'));
    }

    public function create()
    {
        $employees = Employee::with('position')->orderBy('nama_karyawan')->get();
        return view('salaries.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'payment_date' => 'required|date',
            'base_salary' => 'required|numeric|min:0',
            'bonus' => 'nullable|numeric|min:0',
            'deductions' => 'nullable|numeric|min:0',
            'net_pay' => 'required|numeric|min:0',
        ]);

        Salary::create($request->all());

        return redirect()->route('salaries.index')
                         ->with('success', 'Payroll berhasil diproses.');
    }

    public function show(Salary $salary)
    {
         return view('salaries.show', compact('salary'));
    }

    public function edit(Salary $salary)
    {
        return redirect()->route('salaries.index')
                         ->with('error', 'Mengedit riwayat gaji tidak diizinkan.');
    }

    public function update(Request $request, Salary $salary)
    {
        return redirect()->route('salaries.index')
                         ->with('error', 'Mengedit riwayat gaji tidak diizinkan.');
    }

    public function destroy(Salary $salary)
    {
        $salary->delete();
        
        return redirect()->route('salaries.index')
                         ->with('success', 'Riwayat gaji berhasil dihapus.');
    }
}
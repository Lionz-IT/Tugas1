<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;   
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with(['department', 'position'])->latest()->paginate(10);
        
        return view('employees.index', compact('employees'));
    }
    public function create()
    {
        $departments = Department::orderBy('nama_departemen')->get();
        $positions = Position::orderBy('nama_jabatan')->get();
        
        return view('employees.create', compact('departments', 'positions'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_karyawan' => 'required|string|max:100',
            'email' => 'required|email|unique:employees,email',
            'nomor_telepon' => 'nullable|string|max:15',
            'tanggal_lahir' => 'nullable|date',        
            'alamat' => 'nullable|string',             
            'tanggal_masuk' => 'required|date',         
            'status' => 'required|in:aktif,nonaktif',
            'department_id' => 'required|exists:departments,id', 
            'position_id' => 'required|exists:positions,id',   
        ]);

        Employee::create($request->all()); 

        return redirect()->route('employees.index')
                         ->with('success', 'Karyawan baru berhasil ditambahkan.');
    }

    public function show(Employee $employee) // Menggunakan Route Model Binding
    {
        return view('employees.show', compact('employee'));
    }
    public function edit(Employee $employee) // Menggunakan Route Model Binding
    {
        $departments = Department::orderBy('nama_departemen')->get();
        $positions = Position::orderBy('nama_jabatan')->get();

        return view('employees.edit', compact('employee', 'departments', 'positions'));
    }
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'nama_karyawan' => 'required|string|max:100',
            'email' => 'required|email|unique:employees,email,' . $employee->id, 
            'nomor_telepon' => 'nullable|string|max:15',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
            'tanggal_masuk' => 'required|date',
            'status' => 'required|in:aktif,nonaktif',
            'department_id' => 'required|exists:departments,id',
            'position_id' => 'required|exists:positions,id',
        ]);

        $employee->update($request->all());

        return redirect()->route('employees.index')
                         ->with('success', 'Data karyawan berhasil diperbarui.');
    }
    public function destroy(Employee $employee) // Menggunakan Route Model Binding
    {
        $employee->delete();
        
        return redirect()->route('employees.index')
                         ->with('success', 'Data karyawan berhasil dihapus.');
    }
}
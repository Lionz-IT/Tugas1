<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee; 
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::with('employee')->latest()->paginate(10);
        return view('attendances.index', compact('attendances'));
    }

    public function create()
    {
        $employees = Employee::orderBy('nama_karyawan')->get();
        return view('attendances.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'date' => 'required|date',
            'check_in' => 'required|date_format:H:i',
            'check_out' => 'nullable|date_format:H:i|after:check_in',
            'status' => 'required|string',
        ]);

        Attendance::create($request->all());

        return redirect()->route('attendances.index')
                         ->with('success', 'Catatan absensi berhasil disimpan.');
    }  

    public function show(Attendance $attendance)
    {
        return view('attendances.show', compact('attendance'));
    }

    public function edit(Attendance $attendance)
    {
        $employees = Employee::orderBy('nama_karyawan')->get();
        return view('attendances.edit', compact('attendance', 'employees'));
    }

    public function update(Request $request, Attendance $attendance)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'date' => 'required|date',
            'check_in' => 'required|date_format:H:i',
            'check_out' => 'nullable|date_format:H:i|after:check_in',
            'status' => 'required|string',
        ]);

        $attendance->update($request->all());

        return redirect()->route('attendances.index')
                         ->with('success', 'Catatan absensi berhasil diperbarui.');
    }

    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        
        return redirect()->route('attendances.index')
                         ->with('success', 'Catatan absensi berhasil dihapus.');
    }
}
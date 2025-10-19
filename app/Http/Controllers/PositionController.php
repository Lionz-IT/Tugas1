<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{

    public function index()
    {
        $positions = Position::latest()->paginate(10);
        return view('positions.index', compact('positions'));
    }

    public function create()
    {
        return view('positions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jabatan' => 'required|string|max:100|unique:positions',
            'gaji_pokok' => 'required|numeric|min:0',
        ]);

        Position::create($request->all());

        return redirect()->route('positions.index')
                         ->with('success', 'Jabatan baru berhasil ditambahkan.');
    }

    public function show(Position $position)
    {
        return redirect()->route('positions.edit', $position);
    }

    public function edit(Position $position)
    {
        return view('positions.edit', compact('position'));
    }

    public function update(Request $request, Position $position)
    {
        $request->validate([
            'nama_jabatan' => 'required|string|max:100|unique:positions,nama_jabatan,' . $position->id,
            'gaji_pokok' => 'required|numeric|min:0',
        ]);

        $position->update($request->all());

        return redirect()->route('positions.index')
                         ->with('success', 'Jabatan berhasil diperbarui.');
    }

    public function destroy(Position $position)
    {
        if ($position->employees()->count() > 0) {
            return redirect()->route('positions.index')
                             ->with('error', 'Gagal! Jabatan ini masih digunakan oleh karyawan.');
        }

        $position->delete();

        return redirect()->route('positions.index')
                         ->with('success', 'Jabatan berhasil dihapus.');
    }
}
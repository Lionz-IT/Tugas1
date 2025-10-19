<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_karyawan',
        'email',
        'nomor_telepon', // <-- Kolom baru
        'tanggal_lahir', // <-- Kolom baru
        'alamat',        // <-- Kolom baru
        'tanggal_masuk',
        'status',        // <-- Kolom baru
        'department_id', // Foreign Key
        'position_id',   // Foreign Key
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
    public function salaries()
    {
        return $this->hasMany(Salary::class);
    }
}
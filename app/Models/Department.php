<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi.
     */
    protected $fillable = [
        'nama_departemen',
    ];

    /**
     * Relasi: Satu Departemen memiliki BANYAK Karyawan.
     */
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
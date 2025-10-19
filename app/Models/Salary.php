<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'payment_date',
        'base_salary',
        'bonus',
        'deductions',
        'net_pay',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
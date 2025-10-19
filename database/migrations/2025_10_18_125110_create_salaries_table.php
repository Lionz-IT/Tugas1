<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            
            // Foreign key ke tabel 'employees' (gunakan 'employee_id')
            $table->foreignId('employee_id')
                  ->constrained('employees')
                  ->onDelete('cascade'); 

            // Kolom untuk detail gaji (sesuai rencana)
            $table->date('payment_date'); // Tanggal gaji ini dibayarkan
            $table->decimal('base_salary', 10, 2); // Gaji pokok saat itu
            $table->decimal('bonus', 10, 2)->default(0); // Bonus
            $table->decimal('deductions', 10, 2)->default(0); // Potongan
            $table->decimal('net_pay', 10, 2); // Total gaji bersih

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salaries');
    }
};
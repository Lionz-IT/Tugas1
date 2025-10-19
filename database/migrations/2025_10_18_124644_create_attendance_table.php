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
        // Ganti nama tabel menjadi plural: 'attendances'
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();

            // Gunakan foreignId() dan nama kolom 'employee_id'
            $table->foreignId('employee_id')
                  ->constrained('employees')
                  ->onDelete('cascade');

            // Gunakan nama kolom bahasa Inggris
            $table->date('date');
            $table->time('check_in');
            $table->time('check_out')->nullable();
            $table->string('status')->default('Hadir'); // Gunakan string

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Ganti nama tabel menjadi plural: 'attendances'
        Schema::dropIfExists('attendances');
    }
};
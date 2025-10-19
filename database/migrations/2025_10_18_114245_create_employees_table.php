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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            
            // Kolom data karyawan
            $table->string('nama_karyawan', 100); 
            $table->string('email')->unique(); // Email harus unik
            $table->string('nomor_telepon', 15)->nullable(); // Boleh kosong
            $table->date('tanggal_lahir')->nullable();      // Boleh kosong
            $table->text('alamat')->nullable();             // Boleh kosong
            $table->date('tanggal_masuk');                 // Wajib diisi
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif'); // Status karyawan
            
            // --- Foreign Keys (WAJIB ADA) ---
            $table->foreignId('department_id') 
                  ->constrained('departments')
                  ->onDelete('cascade'); // Jika departemen dihapus, karyawan ikut terhapus

            $table->foreignId('position_id')   
                  ->constrained('positions')
                  ->onDelete('cascade'); // Jika jabatan dihapus, karyawan ikut terhapus
            // ---------------------------------

            $table->timestamps(); // Membuat created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
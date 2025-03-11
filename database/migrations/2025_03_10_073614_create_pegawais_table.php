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
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id('id_pegawai');
            $table->string('nip')->unique();
            $table->string('nama');
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->foreignId('id_kelamin')->constrained('kelamin', 'id_jenKel');
            $table->text('alamat');
            $table->foreignId('id_agama')->constrained('agama', 'id_agama');
            $table->foreignId('id_unit')->constrained('unit_kerja', 'id_unitKerja');
            $table->string('tempat_tugas');
            $table->string('no_hp');
            $table->string('npwp')->nullable();
            $table->string('foto')->nullable(); // Tambahkan kolom foto
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai');
    }
};

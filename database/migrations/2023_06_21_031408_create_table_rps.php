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
        Schema::create('table_rps', function (Blueprint $table) {
            $table->id();
            $table->string('nomor');
            $table->dateTime('tanggal_berlaku');
            $table->dateTime('tanggal_disusun');
            $table->integer('id_matkul');
            $table->integer('id_pembuat');
            $table->string('revisi');
            $table->string('semester');
            $table->string('bobot_sks');
            $table->text('detail_penilaian');
            $table->text('gambaran_umum');
            $table->text('capaian');
            $table->text('prasyarat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_rps');
    }
};

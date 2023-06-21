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
        Schema::create('table_detail_rps', function (Blueprint $table) {
            $table->id();
            $table->integer('id_rps');
            $table->integer('minggu');
            $table->text('kemampuan_akhir');
            $table->text('indikator');
            $table->text('topik');
            $table->text('aktivitas_pembelajaran');
            $table->string('waktu');
            $table->string('penilaian');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_detail_rps');
    }
};

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
        Schema::create('table_uni_pembelajaran', function (Blueprint $table) {
            $table->id();
            $table->integer('id_rps');
            $table->text('kemampuan_akhir');
            $table->text('indikator');
            $table->text('bahan_kajian');
            $table->text('metode_pembelajaran');
            $table->string('waktu');
            $table->string('metode_penilaian');
            $table->string('bahan_ajar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_uni_pembelajaran');
    }
};

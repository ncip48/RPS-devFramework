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
        Schema::table('learning_plans', function (Blueprint $table) {
            $table->integer('id_teacher')->nullable()->after('id_template');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('learning_plans', function (Blueprint $table) {
            $table->dropColumn('id_teacher');
        });
    }
};

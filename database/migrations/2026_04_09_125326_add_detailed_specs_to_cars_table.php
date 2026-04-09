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
        Schema::table('cars', function (Blueprint $table) {
            $table->string('engine_capacity')->nullable();
            $table->string('fuel_policy')->nullable();
            $table->string('insurance_info')->nullable();
            $table->text('features')->nullable(); // JSON or comma-separated
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn(['engine_capacity', 'fuel_policy', 'insurance_info', 'features']);
        });
    }
};

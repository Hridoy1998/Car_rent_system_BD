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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('title');
            $table->string('brand');
            $table->string('model');
            $table->year('year');
            $table->enum('type', ['SUV', 'Sedan', 'Hatchback', 'Van', 'Other']);
            $table->enum('transmission', ['Manual', 'Auto']);
            $table->string('fuel_type');
            $table->decimal('price_per_day', 8, 2);
            $table->decimal('price_per_month', 8, 2);
            $table->string('location');
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};

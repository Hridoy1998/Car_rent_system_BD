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
        Schema::table('bookings', function (Blueprint $table) {
            $table->integer('start_odo')->nullable()->comment('Mileage at pick-up');
            $table->integer('renter_end_odo')->nullable()->comment('Mileage reported by customer');
            $table->integer('end_odo')->nullable()->comment('Mileage verified by owner');
            $table->string('end_fuel')->nullable()->comment('Fuel level at return');
            $table->text('inspection_notes')->nullable();
            $table->json('inspection_images')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['start_odo', 'renter_end_odo', 'end_odo', 'end_fuel', 'inspection_notes', 'inspection_images']);
        });
    }
};

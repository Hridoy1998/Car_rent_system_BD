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
            $table->decimal('security_deposit_amount', 10, 2)->default(0);
            $table->string('security_deposit_status')->default('none'); // none, held, deducted, released
            $table->timestamp('dispute_held_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['security_deposit_amount', 'security_deposit_status', 'dispute_held_at']);
        });
    }
};

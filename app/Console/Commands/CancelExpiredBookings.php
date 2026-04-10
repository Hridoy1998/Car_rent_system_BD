<?php

namespace App\Console\Commands;

use App\Models\Booking;
use Illuminate\Console\Command;

class CancelExpiredBookings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bookings:cancel-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically cancel pending bookings that hosts have not approved within 24 hours.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expiredCount = Booking::where('status', 'pending')
            ->where('created_at', '<=', now()->subHours(24))
            ->update(['status' => 'cancelled']);

        $this->info("Successfully cancelled {$expiredCount} expired missions.");
    }
}

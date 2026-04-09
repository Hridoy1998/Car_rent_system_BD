<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            [
                'key' => 'platform_commission',
                'value' => '10',
                'description' => 'Platform commission percentage deducted from host earnings per booking.',
            ],
            [
                'key' => 'security_deposit_requirement',
                'value' => 'enabled',
                'description' => 'Toggle mandatory security deposits for high-value asset categories.',
            ],
            [
                'key' => 'max_active_bookings_per_customer',
                'value' => '3',
                'description' => 'Constraint on simultaneous active bookings per non-verified customer identity.',
            ],
            [
                'key' => 'site_maintenance_mode',
                'value' => 'off',
                'description' => 'Global switch to toggle platform-wide read-only status for administrative maintenance.',
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CommissionRate;
use App\Models\PolicyCategory;

class CommissionRateSeeder extends Seeder
{
    public function run()
    {
        $categories = PolicyCategory::all()->keyBy('category_code');

        $defaults = [
            ['Motor', 'agent', 10.0000],
            ['Motor', 'broker', 5.0000],
            ['Motor', 'bancassurance', 8.0000],
            ['Motor', 'sfe', 12.0000],
            ['FIRE', 'agent', 12.0000],
            ['FIRE', 'broker', 6.0000],
            ['FIRE', 'bancassurance', 10.0000],
            ['FIRE', 'sfe', 15.0000],
            ['MARINE', 'agent', 10.0000],
            ['MARINE', 'broker', 5.0000],
            ['MARINE', 'bancassurance', 8.0000],
            ['MARINE', 'sfe', 12.0000],
            ['ENGINEERING', 'agent', 8.0000],
            ['ENGINEERING', 'broker', 4.0000],
            ['ENGINEERING', 'bancassurance', 6.0000],
            ['ENGINEERING', 'sfe', 10.0000],
            ['MISCELLANEOUS AND ACCIDENTS', 'agent', 12.0000],
            ['MISCELLANEOUS AND ACCIDENTS', 'broker', 6.0000],
            ['MISCELLANEOUS AND ACCIDENTS', 'bancassurance', 10.0000],
            ['MISCELLANEOUS AND ACCIDENTS', 'sfe', 15.0000],
            ['GOODS IN TRANSIT', 'agent', 10.0000],
            ['GOODS IN TRANSIT', 'broker', 5.0000],
            ['GOODS IN TRANSIT', 'bancassurance', 8.0000],
            ['GOODS IN TRANSIT', 'sfe', 12.0000],
            ['AVIATION', 'agent', 7.0000],
            ['AVIATION', 'broker', 3.5000],
            ['AVIATION', 'bancassurance', 5.0000],
            ['AVIATION', 'sfe', 9.0000],
            ['AGRICULTURE', 'agent', 10.0000],
            ['AGRICULTURE', 'broker', 5.0000],
            ['AGRICULTURE', 'bancassurance', 8.0000],
            ['AGRICULTURE', 'sfe', 12.0000],
        ];

        foreach ($defaults as [$catCode, $channel, $rate]) {
            $cat = $categories->get($catCode);
            if (!$cat) continue;

            CommissionRate::firstOrCreate(
                [
                    'policy_category_id' => $cat->id,
                    'channel_type' => $channel,
                    'rate_type' => 'percentage',
                ],
                [
                    'rate_value' => $rate,
                    'is_active' => true,
                ]
            );
        }

        $this->command->info('Seeded ' . count($defaults) . ' default commission rates across categories.');
    }
}

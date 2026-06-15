<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CommissionRate;
use App\Models\PolicyCategory;

class TiraCommissionRateSeeder extends Seeder
{
    public function run()
    {
        // TIRA Circular No. 029/2015 (Revised v02) - Maximum Commission Rates
        // Effective 1st January 2025
        $tiraClasses = [
            ['code' => 'FIRE',              'name' => 'Fire Insurance',               'max_rate' => 20.00, 'tanre' => 22.50],
            ['code' => 'FIRE_COMMERCIAL',    'name' => 'Fire Commercial',              'max_rate' => 20.00, 'tanre' => 22.50],
            ['code' => 'ENGINEERING',        'name' => 'Engineering Insurance',        'max_rate' => 20.00, 'tanre' => 22.50],
            ['code' => 'MOTOR',              'name' => 'Motor Insurance',              'max_rate' => 12.50, 'tanre' => 15.00],
            ['code' => 'PA_INDIVIDUAL',      'name' => 'Individual Personal Accident', 'max_rate' => 17.50, 'tanre' => 20.00],
            ['code' => 'PA_GROUP',           'name' => 'Group Personal Accident',      'max_rate' => 17.50, 'tanre' => 20.00],
            ['code' => 'AVIATION',           'name' => 'Aviation Insurance',           'max_rate' => 15.00, 'tanre' => 17.50],
            ['code' => 'MARINE',             'name' => 'Marine Insurance',             'max_rate' => 17.50, 'tanre' => 20.00],
            ['code' => 'HEALTH',             'name' => 'Health Insurance',             'max_rate' => 17.50, 'tanre' => 20.00],
            ['code' => 'LIABILITY',          'name' => 'Liability Insurance',          'max_rate' => 17.50, 'tanre' => 20.00],
            ['code' => 'PUBLIC_LIABILITY',   'name' => 'Public Liability Insurance',   'max_rate' => 17.50, 'tanre' => 20.00],
            ['code' => 'WCOMPENSATION',      "name' => "Workmen's Compensation",       'max_rate' => 17.50, 'tanre' => 20.00],
            ['code' => 'BOND',               'name' => 'Bond Insurance',               'max_rate' => 17.50, 'tanre' => 20.00],
            ['code' => 'THEFT',              'name' => 'Theft Insurance',              'max_rate' => 17.50, 'tanre' => 20.00],
            ['code' => 'PROF_INDEMNITY',     'name' => 'Professional Indemnity',       'max_rate' => 15.00, 'tanre' => 17.50],
            ['code' => 'MONEY',              'name' => 'Money Insurance',              'max_rate' => 15.00, 'tanre' => 17.50],
            ['code' => 'GOODS_IN_TRANSIT',   'name' => 'Goods in Transit',             'max_rate' => 15.00, 'tanre' => 17.50],
            ['code' => 'AGRICULTURE',        'name' => 'Agriculture Insurance',        'max_rate' => 17.50, 'tanre' => 20.00],
            ['code' => 'MISC',               'name' => 'Miscellaneous & Other General','max_rate' => 17.50, 'tanre' => 20.00],
            ['code' => 'LIFE_INDIVIDUAL',    'name' => 'Individual Life Assurance',    'max_rate' => 30.00, 'tanre' => 32.50],
            ['code' => 'LIFE_GROUP',         'name' => 'Group Life Assurance',         'max_rate' => 15.00, 'tanre' => 17.50],
            ['code' => 'ANNUITIES',          'name' => 'Annuities and Pensions',       'max_rate' => 30.00, 'tanre' => 32.50],
        ];

        $catMap = [];
        foreach ($tiraClasses as $cls) {
            $cat = PolicyCategory::updateOrCreate(
                ['category_code' => $cls['code']],
                [
                    'category_name' => $cls['name'],
                    'description' => "TIRA class: {$cls['name']} - Max commission {$cls['max_rate']}%",
                    'is_active' => true,
                ]
            );
            $catMap[$cls['code']] = $cat->id;
        }
        $this->command->info(count($tiraClasses) . ' TIRA categories ready.');

        // Seed maximum commission rates per channel
        // All channels capped at TIRA maximum (companies may pay lower)
        $channels = ['agent', 'broker', 'bancassurance', 'sfe'];
        $count = 0;
        foreach ($tiraClasses as $cls) {
            $categoryId = $catMap[$cls['code']];
            foreach ($channels as $channel) {
                CommissionRate::updateOrCreate(
                    [
                        'policy_category_id' => $categoryId,
                        'channel_type' => $channel,
                        'rate_type' => 'percentage',
                        'insurer_id' => null,
                        'insurance_product_id' => null,
                    ],
                    [
                        'rate_value' => $cls['max_rate'],
                        'is_active' => true,
                    ]
                );
                $count++;
            }

            // TanRe rate (mandatory cession)
            CommissionRate::updateOrCreate(
                [
                    'policy_category_id' => $categoryId,
                    'channel_type' => 'tanre',
                    'rate_type' => 'percentage',
                    'insurer_id' => null,
                    'insurance_product_id' => null,
                ],
                [
                    'rate_value' => $cls['tanre'],
                    'is_active' => true,
                ]
            );
            $count++;
        }

        $this->command->info("Seeded {$count} commission rates per TIRA Circular 029/2015 (Revised v02).");
        $this->command->warn('NOTE: These are MAXIMUM rates. Companies may pay lower per Section 4 of the Circular.');
    }
}

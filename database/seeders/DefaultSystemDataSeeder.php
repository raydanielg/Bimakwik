<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DefaultSystemDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['name' => 'super_admin', 'display_name' => 'Super Administrator', 'description' => 'Full system access', 'is_default' => false],
            ['name' => 'sub_admin', 'display_name' => 'Sub-Administrator', 'description' => 'Limited system access', 'is_default' => false],
            ['name' => 'insurer', 'display_name' => 'Insurance Company', 'description' => 'Insurance company access', 'is_default' => false],
            ['name' => 'broker', 'display_name' => 'Broker / Aggregator', 'description' => 'Broker and Aggregator access', 'is_default' => false],
            ['name' => 'agent', 'display_name' => 'Insurance Agent', 'description' => 'Agent access', 'is_default' => false],
            ['name' => 'sfe', 'display_name' => 'Sales Force (SFE)', 'description' => 'Sales Force access', 'is_default' => false],
            ['name' => 'bancassurance', 'display_name' => 'Bancassurance Agent', 'description' => 'Bank agent access', 'is_default' => false],
            ['name' => 'customer', 'display_name' => 'Customer', 'description' => 'Customer access', 'is_default' => true],
            ['name' => 'service_provider', 'display_name' => 'Service Provider', 'description' => 'Hospital, pharmacy, garage', 'is_default' => false],
            ['name' => 'regulator', 'display_name' => 'Regulator (TIRA)', 'description' => 'Regulator access', 'is_default' => false],
            ['name' => 'financing_partner', 'display_name' => 'Financing Partner', 'description' => 'Premium financing partner', 'is_default' => false],
            ['name' => 'developer', 'display_name' => 'Developer', 'description' => 'API developer access', 'is_default' => false],
        ];

        foreach ($roles as $role) {
            \Illuminate\Support\Facades\DB::table('roles')->updateOrInsert(
                ['name' => $role['name']],
                array_merge($role, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }
    }
}

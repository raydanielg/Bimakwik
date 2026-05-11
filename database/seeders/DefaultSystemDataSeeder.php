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
            ['name' => 'admin', 'display_name' => 'Administrator', 'description' => 'Platform administrator', 'is_default' => false],
            ['name' => 'sub_admin', 'display_name' => 'Sub-Administrator', 'description' => 'Limited system access', 'is_default' => false],
            ['name' => 'insurer', 'display_name' => 'Insurance Company (Insurer)', 'description' => 'Insurance company access', 'is_default' => false],
            ['name' => 'broker', 'display_name' => 'Broker', 'description' => 'Insurance broker access', 'is_default' => false],
            ['name' => 'aggregator', 'display_name' => 'Aggregator', 'description' => 'Aggregator and platform partner access', 'is_default' => false],
            ['name' => 'agent', 'display_name' => 'Agent', 'description' => 'General insurance agent access', 'is_default' => false],
            ['name' => 'sfe', 'display_name' => 'Sales Force Executive (SFE)', 'description' => 'Direct sales force access', 'is_default' => false],
            ['name' => 'bancassurance', 'display_name' => 'Bancassurance Agent', 'description' => 'Bank-based insurance agent access', 'is_default' => false],
            ['name' => 'customer', 'display_name' => 'Customer', 'description' => 'Customer access', 'is_default' => true],
            ['name' => 'service_provider', 'display_name' => 'Service Provider', 'description' => 'Hospital, Pharmacy, Garage, etc.', 'is_default' => false],
            ['name' => 'regulator', 'display_name' => 'Regulator', 'description' => 'Industry regulator (TIRA) access', 'is_default' => false],
            ['name' => 'financing_partner', 'display_name' => 'Premium Financing Partner', 'description' => 'Premium financing partner access', 'is_default' => false],
            ['name' => 'developer', 'display_name' => 'Developer / API Integrator', 'description' => 'API and developer portal access', 'is_default' => false],
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

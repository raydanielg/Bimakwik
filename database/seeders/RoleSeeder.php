<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['name' => 'Super Administrator', 'slug' => 'super-admin', 'description' => 'System wide access'],
            ['name' => 'Sub-Administrator', 'slug' => 'sub-admin', 'description' => 'Limited administrative access'],
            ['name' => 'Insurance Companies (Insurers)', 'slug' => 'insurer', 'description' => 'Manage policies and claims'],
            ['name' => 'Brokers / Aggregators', 'slug' => 'broker', 'description' => 'Intermediary between insurers and agents'],
            ['name' => 'Insurance Agents', 'slug' => 'agent', 'description' => 'Direct sales to customers'],
            ['name' => 'Sales Force Executives (SFEs)', 'slug' => 'sfe', 'description' => 'Field sales team'],
            ['name' => 'Bancassurance Agents', 'slug' => 'bancassurance', 'description' => 'Bank-based insurance sales'],
            ['name' => 'Customers', 'slug' => 'customer', 'description' => 'Policy holders and app users'],
            ['name' => 'Service Providers', 'slug' => 'service-provider', 'description' => 'Hospitals, Pharmacies, Garages, etc.'],
            ['name' => 'Regulator', 'slug' => 'regulator', 'description' => 'TIRA and other regulatory bodies'],
            ['name' => 'Premium Financing Partners', 'slug' => 'financing-partner', 'description' => 'Partners providing premium loans'],
            ['name' => 'Developers / API Integrators', 'slug' => 'developer', 'description' => 'External technical partners'],
        ];

        foreach ($roles as $roleData) {
            $role = \App\Models\Role::updateOrCreate(['slug' => $roleData['slug']], $roleData);

            // Create a test user for each role
            $user = \App\Models\User::updateOrCreate(
                ['email' => $roleData['slug'] . '@bimakwik.com'],
                [
                    'name' => $roleData['name'] . ' Test',
                    'password' => \Illuminate\Support\Facades\Hash::make('password'),
                    'email_verified_at' => now(),
                ]
            );

            // Assign role to user if not already assigned
            if (!$user->roles()->where('role_id', $role->id)->exists()) {
                $user->roles()->attach($role->id);
            }
        }
    }
}

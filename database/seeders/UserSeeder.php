<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['name' => 'Super Administrator', 'email' => 'super-admin@bimakwik.com', 'phone_number' => '0754111222', 'password' => Hash::make('password'), 'role' => 'super_admin'],
            ['name' => 'Administrator', 'email' => 'admin@bimakwik.com', 'phone_number' => '0754111221', 'password' => Hash::make('password'), 'role' => 'admin'],
            ['name' => 'Sub-Administrator', 'email' => 'sub-admin@bimakwik.com', 'phone_number' => '0754111223', 'password' => Hash::make('password'), 'role' => 'sub_admin'],
            ['name' => 'Insurance Company', 'email' => 'insurer@bimakwik.com', 'phone_number' => '0222110000', 'password' => Hash::make('password'), 'role' => 'insurer'],
            ['name' => 'Broker', 'email' => 'broker@bimakwik.com', 'phone_number' => '0784555666', 'password' => Hash::make('password'), 'role' => 'broker'],
            ['name' => 'Aggregator', 'email' => 'aggregator@bimakwik.com', 'phone_number' => '0784555777', 'password' => Hash::make('password'), 'role' => 'aggregator'],
            ['name' => 'Agent (SFE/Banca)', 'email' => 'agent@bimakwik.com', 'phone_number' => '0713888999', 'password' => Hash::make('password'), 'role' => 'agent'],
            ['name' => 'Customer (Mteja)', 'email' => 'customer@bimakwik.com', 'phone_number' => '0655444333', 'password' => Hash::make('password'), 'role' => 'customer'],
            ['name' => 'Service Provider', 'email' => 'service-provider@bimakwik.com', 'phone_number' => '0222700021', 'password' => Hash::make('password'), 'role' => 'service_provider'],
            ['name' => 'Regulator', 'email' => 'regulator@bimakwik.com', 'phone_number' => '0222116120', 'password' => Hash::make('password'), 'role' => 'regulator'],
            ['name' => 'Financing Partner', 'email' => 'financing-partner@bimakwik.com', 'phone_number' => '0752999000', 'password' => Hash::make('password'), 'role' => 'financing_partner'],
            ['name' => 'Developer', 'email' => 'developer@bimakwik.com', 'phone_number' => '0752888000', 'password' => Hash::make('password'), 'role' => 'developer'],
        ];

        foreach ($users as $userData) {
            $roleName = $userData['role'];
            unset($userData['role']);
            
            // Check if user already exists based on email
            $existingUser = DB::table('users')->where('email', $userData['email'])->first();
            
            if ($existingUser) {
                $userId = $existingUser->id;
                DB::table('users')->where('id', $userId)->update(array_merge($userData, [
                    'updated_at' => now(),
                ]));
            } else {
                $userId = DB::table('users')->insertGetId(array_merge($userData, [
                    'email_verified_at' => now(),
                    'account_status' => 'active',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]));
            }

            // Assign/Update role
            $role = DB::table('roles')->where('name', $roleName)->first();
            if ($role) {
                DB::table('role_user')->updateOrInsert(
                    ['user_id' => $userId, 'role_id' => $role->id],
                    ['updated_at' => now()]
                );
            }
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Branch;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            DefaultSystemDataSeeder::class,
            UserSeeder::class,
        ]);

        // Seed Branches
        $branches = [
            [
                'name' => 'Head Office',
                'location' => 'Dar es Salaam',
                'address' => 'Bima Complex, Posta mpya, Floor 4',
                'phone' => '+255 746 179 849',
                'email' => 'head-office@bimacoinsurance.co.tz',
            ],
            [
                'name' => 'Arusha Branch',
                'location' => 'Arusha',
                'address' => 'Clock Tower Square, Office No. 12',
                'phone' => '+255 712 345 678',
                'email' => 'arusha@bimacoinsurance.co.tz',
            ],
            [
                'name' => 'Mwanza Branch',
                'location' => 'Mwanza',
                'address' => 'Rock City Mall, 1st Floor',
                'phone' => '+255 789 456 123',
                'email' => 'mwanza@bimacoinsurance.co.tz',
            ],
        ];

        foreach ($branches as $branch) {
            Branch::updateOrCreate(
                ['name' => $branch['name']],
                $branch
            );
        }

        // Seed Products
        $products = [
            [
                'name' => 'Motor Insurance',
                'description' => 'Comprehensive coverage for your vehicles.',
                'icon' => 'bi-car-front',
            ],
            [
                'name' => 'Health Insurance',
                'description' => 'Medical coverage for individuals and families.',
                'icon' => 'bi-heart-pulse',
            ],
            [
                'name' => 'Travel Insurance',
                'description' => 'Safety for your journeys worldwide.',
                'icon' => 'bi-airplane',
            ],
            [
                'name' => 'Life Insurance',
                'description' => 'Secure the future of your loved ones.',
                'icon' => 'bi-person-check',
            ],
        ];

        foreach ($products as $product) {
            $slug = Str::slug($product['name']);

            Product::updateOrCreate(
                ['slug' => $slug],
                [
                    'name' => $product['name'],
                    'slug' => $slug,
                    'description' => $product['description'],
                    'icon' => $product['icon'],
                ]
            );
        }
    }
}

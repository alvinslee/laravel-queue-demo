<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\InventoryItem;
use Faker\Factory as Faker;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $categories = [
            'Electronics',
            'Accessories',
            'Office Supplies',
            'Furniture',
            'Software',
            'Networking',
            'Storage',
            'Peripherals',
            'Components',
            'Gaming'
        ];

        $brands = [
            'TechCorp',
            'DigitalPro',
            'InnovateTech',
            'SmartSystems',
            'FutureGear',
            'EliteTech',
            'ProTech',
            'GlobalTech',
            'SmartSolutions',
            'TechElite'
        ];

        // Generate 100 random items
        for ($i = 0; $i < 100; $i++) {
            $category = $faker->randomElement($categories);
            $brand = $faker->randomElement($brands);
            $quantity = $faker->numberBetween(0, 100);
            
            InventoryItem::create([
                'name' => $faker->words(3, true),
                'sku' => strtoupper(substr($category, 0, 2)) . '-' . str_pad($i + 1, 4, '0', STR_PAD_LEFT),
                'description' => $faker->paragraph(),
                'quantity' => $quantity,
                'price' => $faker->randomFloat(2, 10, 2000),
                'category' => $category,
                'metadata' => [
                    'brand' => $brand,
                    'warranty' => $faker->numberBetween(1, 5) . ' years',
                    'color' => $faker->colorName(),
                    'weight' => $faker->numberBetween(0, 20) . ' kg',
                    'last_restocked' => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d')
                ]
            ]);
        }
    }
}

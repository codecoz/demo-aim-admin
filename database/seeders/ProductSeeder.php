<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        // Categories for more realistic product names
        $categories = [
            'Electronics' => [
                'Laptop', 'Smartphone', 'Tablet', 'Smartwatch', 'Headphones',
                'Speaker', 'Camera', 'Monitor', 'Keyboard', 'Mouse'
            ],
            'Fashion' => [
                'T-shirt', 'Jeans', 'Dress', 'Shoes', 'Watch',
                'Bag', 'Sunglasses', 'Hat', 'Jacket', 'Scarf'
            ],
            'Home' => [
                'Chair', 'Table', 'Lamp', 'Rug', 'Mirror',
                'Clock', 'Vase', 'Pillow', 'Blanket', 'Plant'
            ]
        ];

        // Brands for more realistic product names
        $brands = [
            'TechPro', 'SmartLife', 'EcoStyle', 'LuxeCraft', 'NextGen',
            'PrimePick', 'EliteWare', 'InnovatePro', 'MaxQuality', 'TopChoice'
        ];

        // Generate 10,000 products
        for ($i = 0; $i < 10000; $i++) {
            // Pick random category and item
            $category = $faker->randomElement(array_keys($categories));
            $item = $faker->randomElement($categories[$category]);
            $brand = $faker->randomElement($brands);

            // Generate product name with brand and model number
            $productName = $brand . ' ' . $item . ' ' . $faker->bothify('?##??');

            // Price ranges based on category
            $priceRanges = [
                'Electronics' => [99.99, 2999.99],
                'Fashion' => [19.99, 499.99],
                'Home' => [29.99, 899.99]
            ];

            // Create product
            Product::create([
                'name' => $productName,
                'description' => $faker->paragraphs(2, true),
                'price' => $faker->randomFloat(2, $priceRanges[$category][0], $priceRanges[$category][1]),
                'stock' => $faker->numberBetween(0, 1000),
                'status' => $faker->boolean(80) // 80% chance of being active
            ]);

            // Show progress
            if ($i % 1000 == 0) {
                echo "Seeded $i products...\n";
            }
        }

        echo "Completed seeding 10,000 products!\n";
    }
}

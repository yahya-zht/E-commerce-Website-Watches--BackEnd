<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = DB::table('categories')->pluck('id')->toArray();
        $products = DB::table('products')->pluck('id')->toArray();

        // Adjust the number of records you want to seed
        $numberOfRecords = 10;

        for ($i = 0; $i < $numberOfRecords; $i++) {
            DB::table('category_product')->insert([
                'Category_id' => $this->getRandomElement($categories),
                'Product_id' => $this->getRandomElement($products),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
     private function getRandomElement(array $array)
    {
        return $array[array_rand($array)];
    }
}


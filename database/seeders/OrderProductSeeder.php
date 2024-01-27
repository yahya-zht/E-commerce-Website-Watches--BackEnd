<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = DB::table('orders')->pluck('id')->toArray();
        $products = DB::table('products')->pluck('id')->toArray();

        // Adjust the number of records you want to seed
        $numberOfRecords = 10;

        for ($i = 0; $i < $numberOfRecords; $i++) {
            DB::table('order_product')->insert([
                'Order_id' => $this->getRandomElement($orders),
                'Product_id' => $this->getRandomElement($products),
                'Quantity' => rand(1, 5), // Adjust as needed
                'Total_Price' => rand(500, 1000), // Adjust as needed
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

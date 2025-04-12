<?php

namespace Modules\Product\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Setting\Entities\Unit;
use Modules\Product\Entities\Category;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;

class ProductDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $categories = [];
        $faker = Faker::create();
        for ($i = 1; $i <= 5; $i++) {
        $categories[] = [
            'category_code' => 'CA_' . $i,
            'category_name' => 'Category Name' . $i,
            'created_at' => now(),
            'updated_at' => now(),
             ];  
        }
        DB::table('categories')->insert($categories);


        $products = [];
        for ($i = 1; $i <= 50; $i++) {
        $products[] = [
            'product_name' => $faker->word(),
            'product_code' => $faker->unique()->numberBetween(10000, 99999),
            'product_barcode_symbology' => $faker->randomElement(['C128', 'C39', 'UPCA', 'UPCE', 'EAN13' ]),
            'product_quantity' => $faker->numberBetween(1, 100),
            'product_cost' => $faker->numberBetween(1, 10000),
            'product_price' => $faker->numberBetween(1, 10000),
            'product_unit' => 'PC',
            'product_stock_alert' => 5,
            'product_note' => $faker->sentence(10),
            'category_id' => $faker->randomElement([1, 2, 3, 4, 5]),
            'created_at' => now(),
            'updated_at' => now(),
             ]; 
        }
        DB::table('products')->insert($products);

        Unit::create([
            'name' => 'Piece',
            'short_name' => 'PC',
            'operator' => '*',
            'operation_value' => 1
        ]);
    }
}

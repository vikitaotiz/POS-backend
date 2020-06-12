<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
	        'name' => 'Ugali',
	        'description' => 'ugali',
	        'buying_price' => 10,
	        'selling_price' => 15,
	        'category_id' => 3,
	        'item_type' => 'non_drink',
	        'user_id' => 1,
	        'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('products')->insert([
	        'name' => 'Bacon',
	        'description' => 'bacon',
	        'buying_price' => 11,
	        'selling_price' => 13,
	        'category_id' => 4,
	        'item_type' => 'non_drink',
	        'user_id' => 1,
	        'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('products')->insert([
	        'name' => 'Eggs',
	        'description' => 'eggs',
	        'buying_price' => 10,
	        'selling_price' => 12,
	        'category_id' => 1,
	        'item_type' => 'non_drink',
	        'user_id' => 1,
	        'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('products')->insert([
	        'name' => 'Bread',
	        'description' => 'bread',
	        'buying_price' => 8,
	        'selling_price' => 10,
	        'category_id' => 1,
	        'item_type' => 'non_drink',
	        'user_id' => 1,
	        'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('products')->insert([
	        'name' => 'Rice',
	        'description' => 'rice',
	        'buying_price' => 15,
	        'selling_price' => 17,
	        'category_id' => 2,
	        'item_type' => 'non_drink',
	        'user_id' => 1,
	        'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('products')->insert([
	        'name' => 'Chicken',
	        'description' => 'chicken',
	        'buying_price' => 16,
	        'selling_price' => 18,
	        'category_id' => 2,
	        'item_type' => 'non_drink',
	        'user_id' => 1,
	        'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('products')->insert([
	        'name' => 'Beef',
	        'description' => 'beef',
	        'buying_price' => 17,
	        'selling_price' => 19,
	        'category_id' => 3,
	        'item_type' => 'non_drink',
	        'user_id' => 1,
	        'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('products')->insert([
	        'name' => 'Wine',
	        'description' => 'wine',
	        'buying_price' => 20,
	        'selling_price' => 23,
	        'category_id' => 3,
	        'item_type' => 'drink',
	        'user_id' => 1,
	        'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('products')->insert([
	        'name' => 'Cocktail',
	        'description' => 'cocktail',
	        'buying_price' => 19,
	        'selling_price' => 21,
	        'category_id' => 2,
	        'item_type' => 'drink',
	        'user_id' => 1,
	        'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('products')->insert([
	        'name' => 'Soda',
	        'description' => 'soda',
	        'buying_price' => 18,
	        'selling_price' => 20,
	        'category_id' => 4,
	        'item_type' => 'drink',
	        'user_id' => 1,
	        'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}

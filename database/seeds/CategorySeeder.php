<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
	        'name' => 'Breakfast',
	        'user_id' => 1,
	        'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('categories')->insert([
	        'name' => 'Lunch',
	        'user_id' => 1,
	        'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('categories')->insert([
	        'name' => 'Dinner',
	        'user_id' => 1,
	        'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('categories')->insert([
	        'name' => 'Appetizers',
	        'user_id' => 1,
	        'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}

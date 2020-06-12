<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tables')->insert([
	        'name' => 'Table One',
	        'user_id' => 1,
	        'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('tables')->insert([
	        'name' => 'Table Two',
	        'user_id' => 1,
	        'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('tables')->insert([
	        'name' => 'Table Three',
	        'user_id' => 1,
	        'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('tables')->insert([
	        'name' => 'Table Four',
	        'user_id' => 1,
	        'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('tables')->insert([
	        'name' => 'Table Five',
	        'user_id' => 1,
	        'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}

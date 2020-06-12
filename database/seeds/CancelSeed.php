<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CancelSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cancels')->insert([
	        'description' => 'Duplicate Order',
	        'user_id' => 1,
	        'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('cancels')->insert([
	        'description' => 'Customer Cancel',
	        'user_id' => 1,
	        'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}

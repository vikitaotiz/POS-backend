<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([
            'name' => 'Administration',
            'description' => 'This is the administration department.',
            'creator_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('departments')->insert([
            'name' => 'All Users',
            'description' => 'This is the general department for all users by default.',
            'creator_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}

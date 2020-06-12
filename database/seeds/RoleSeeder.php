<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'Administrator',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

         DB::table('roles')->insert([
            'name' => 'User',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}

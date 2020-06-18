<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
	        'name' => 'Pos Admin',
	        'email' => 'posadmin@email.com',
	        'role_id' => 1,
            'department_id' => 1,
            'pin' => 2173,
	        'pwd_clr' => 'posAdmin#29',
	        'email_verified_at' => now(),
	        'password' => bcrypt('posAdmin#29'),
	        'remember_token' => Str::random(10),
	        'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('users')->insert([
            'name' => 'Test User',
            'email' => 'test@email.com',
            'role_id' => 2,
            'department_id' => 2,
            'pin' => 2025,
            'pwd_clr' => 'posUser#19',
            'email_verified_at' => now(),
            'password' => bcrypt('posUser#19'),
            'remember_token' => Str::random(10),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}

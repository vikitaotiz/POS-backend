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
            'pin' => 1123,
	        'pwd_clr' => 'password',
	        'email_verified_at' => now(),
	        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
	        'remember_token' => Str::random(10),
	        'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('users')->insert([
            'name' => 'Test User',
            'email' => 'test@email.com',
            'role_id' => 2,
            'department_id' => 2,
            'pin' => 1125,
            'pwd_clr' => 'password',
            'email_verified_at' => now(),
            'password' => '123456',
            'remember_token' => Str::random(10),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}

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
	        'email_verified_at' => now(),
	        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
	        'remember_token' => Str::random(10),
	        'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
			'name' => "Admin Transisi",
			'email' => "admin@transisi.id",
			'email_verified_at' => now(),
			'password' => bcrypt('transisi'),
			'remember_token' => Str::random(10)
		];
		DB::table('users')->insert($data);
    }
}

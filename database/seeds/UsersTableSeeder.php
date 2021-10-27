<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => 'admin',
            'last_name' => 'demo',
            'phone' => '8758496525',
            'address' => 'Rajkot',
            'zip' => '36002',
            'role_id' => 1,
            'email' => 'admin@gmail.com',
            'password' => bcrypt('secret'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}

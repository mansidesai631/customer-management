<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
                'id' => '1',
                'name' => 'admin', //different fieldnames
            ]);

        DB::table('roles')->insert([
                'id' => '2',
                'name' => 'customer', //different fieldnames
            ]);
    }
}

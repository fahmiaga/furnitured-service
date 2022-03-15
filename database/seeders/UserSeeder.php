<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

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
            'first_name' => 'Rania',
            'last_name' => 'Hulaevi',
            'email' => 'levi@gmail.com',
            'password' => bcrypt('12345'),
            'phone' => '085275002732',
            'is_admin' => 1
        ]);
    }
}

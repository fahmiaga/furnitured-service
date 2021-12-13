<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::factory(5)->create();

        Category::create([
            'category_name' => 'Table',
        ]);
        Category::create([
            'category_name' => 'Chair',
        ]);
        Category::create([
            'category_name' => 'Desk',
        ]);

        Product::factory(20)->create();

        User::create([
            'first_name' => 'Rania',
            'last_name' => 'Hulaevi',
            'phone' => '085275128585',
            'email' => 'levi@gmail.com',
            'password' => bcrypt('12345')
        ]);
    }
}

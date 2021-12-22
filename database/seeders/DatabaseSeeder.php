<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Recipient;
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

        Recipient::create([
            'user_id' => 6,
            'recipient' => 'Alul',
            'address' => 'Jl. Bunga Matahari No. 07 ,Tangerang',
            'phone' => '085275128585',
            'province_id' => 34,
            'city_id' => 278,
            'district' => 'cisauk',
            'sub_district' => 'padengangan',
            'zip_code' => '18654',
        ]);
        Recipient::create([
            'user_id' => 6,
            'recipient' => 'Levi',
            'address' => 'Komp. setia budi blok A No.89 , Batam',
            'phone' => '085275128585',
            'province_id' => 17,
            'city_id' => 48,
            'district' => 'Kota Batam',
            'sub_district' => 'Batam',
            'zip_code' => '18654',
        ]);

        $this->call(LocationSeeder::class);
    }
}

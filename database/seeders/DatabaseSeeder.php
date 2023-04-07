<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Image;
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

        // Product::factory(20)->create();

        User::create([
            'first_name' => 'Rania',
            'last_name' => 'Hulaevi',
            'phone' => '085275128585',
            'email' => 'levi@gmail.com',
            'password' => bcrypt('12345'),
            'is_admin' => 1
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

        Product::create([
            'id' => 1,
            'name' => 'Brown Big Chest',
            'price' => 4889617,
            'description' => 'Qui voluptatem repudiandae repudiandae amet laborum. Est eveniet a ea neque sint deleniti. Sed ipsam deleniti est eveniet. Molestiae ut voluptates ut et veritatis cumque quod. Laboriosam excepturi maiores consequatur molestias atque qui.',
            'quantity' => 5,
            'weight' => 3,
            'category_id' => 1,
        ]);

        Image::create([
            'product_id' => 1,
            'image_name' => 'posts-image/wao161ogrqqayqmvhnud',
            'url' => 'https://res.cloudinary.com/dqsbhrjjx/image/upload/v1647588120/posts-image/wao161ogrqqayqmvhnud.jpg'
        ]);
        Image::create([
            'product_id' => 1,
            'image_name' => 'posts-image/lbycmwt9ksfspth4r6xp',
            'url' => 'https://res.cloudinary.com/dqsbhrjjx/image/upload/v1647588119/posts-image/lbycmwt9ksfspth4r6xp.jpg'
        ]);
        Image::create([
            'product_id' => 1,
            'image_name' => 'posts-image/vgl2sumrn60wrdgsfsit',
            'url' => 'https://res.cloudinary.com/dqsbhrjjx/image/upload/v1647588119/posts-image/vgl2sumrn60wrdgsfsit.jpg'
        ]);

        Product::create([
            'id' => 2,
            'name' => 'White Drawer',
            'price' => 400000,
            'description' => 'Qui voluptatem repudiandae repudiandae amet laborum. Est eveniet a ea neque sint deleniti. Sed ipsam deleniti est eveniet. Molestiae ut voluptates ut et veritatis cumque quod. Laboriosam excepturi maiores consequatur molestias atque qui.',
            'quantity' => 5,
            'weight' => 3,
            'category_id' => 1,
        ]);

        Image::create([
            'product_id' => 2,
            'image_name' => 'posts-image/f8udnixgrhsx5utvzweb',
            'url' => 'https://res.cloudinary.com/dqsbhrjjx/image/upload/v1647587999/posts-image/f8udnixgrhsx5utvzweb.jpg'
        ]);
        Image::create([
            'product_id' => 2,
            'image_name' => 'posts-image/wgbiclkwrv82sempe14e',
            'url' => 'https://res.cloudinary.com/dqsbhrjjx/image/upload/v1647587999/posts-image/wgbiclkwrv82sempe14e.jpg'
        ]);

        Product::create([
            'id' => 3,
            'name' => 'Modern Wardrobe',
            'price' => 4889617,
            'description' => 'Qui voluptatem repudiandae repudiandae amet laborum. Est eveniet a ea neque sint deleniti. Sed ipsam deleniti est eveniet. Molestiae ut voluptates ut et veritatis cumque quod. Laboriosam excepturi maiores consequatur molestias atque qui.',
            'quantity' => 5,
            'weight' => 3,
            'category_id' => 2,
        ]);

        Image::create([
            'product_id' => 3,
            'image_name' => 'posts-image/x3dxreypfr6eh8mjfxuo',
            'url' => 'https://res.cloudinary.com/dqsbhrjjx/image/upload/v1647502046/posts-image/x3dxreypfr6eh8mjfxuo.jpg'
        ]);
        Image::create([
            'product_id' => 3,
            'image_name' => 'posts-image/jfntjf2idiuhpqmu5g0i',
            'url' => 'https://res.cloudinary.com/dqsbhrjjx/image/upload/v1647502046/posts-image/jfntjf2idiuhpqmu5g0i.jpg'
        ]);

        Product::create([
            'id' => 4,
            'name' => 'Bamboo Chair',
            'price' => 4889617,
            'description' => 'Qui voluptatem repudiandae repudiandae amet laborum. Est eveniet a ea neque sint deleniti. Sed ipsam deleniti est eveniet. Molestiae ut voluptates ut et veritatis cumque quod. Laboriosam excepturi maiores consequatur molestias atque qui.',
            'quantity' => 5,
            'weight' => 3,
            'category_id' => 3,
        ]);

        Image::create([
            'product_id' => 4,
            'image_name' => 'posts-image/lmegzlplllraoxh46ou1',
            'url' => 'https://res.cloudinary.com/dqsbhrjjx/image/upload/v1647501923/posts-image/lmegzlplllraoxh46ou1.jpg'
        ]);
        Image::create([
            'product_id' => 4,
            'image_name' => 'posts-image/fgsh5qvnosqer982mf8d',
            'url' => 'https://res.cloudinary.com/dqsbhrjjx/image/upload/v1647501923/posts-image/fgsh5qvnosqer982mf8d.jpg'
        ]);
        Image::create([
            'product_id' => 4,
            'image_name' => 'posts-image/feva3lovxn6mwxwgukwj',
            'url' => 'https://res.cloudinary.com/dqsbhrjjx/image/upload/v1647501923/posts-image/feva3lovxn6mwxwgukwj.jpg'
        ]);

        Product::create([
            'id' => 5,
            'name' => 'Living Chair',
            'price' => 4889617,
            'description' => 'Qui voluptatem repudiandae repudiandae amet laborum. Est eveniet a ea neque sint deleniti. Sed ipsam deleniti est eveniet. Molestiae ut voluptates ut et veritatis cumque quod. Laboriosam excepturi maiores consequatur molestias atque qui.',
            'quantity' => 5,
            'weight' => 3,
            'category_id' => 3,
        ]);

        Image::create([
            'product_id' => 5,
            'image_name' => 'posts-image/yofykpbich9mpvvluztt',
            'url' => 'https://res.cloudinary.com/dqsbhrjjx/image/upload/v1647485092/posts-image/yofykpbich9mpvvluztt.png'
        ]);
        Image::create([
            'product_id' => 5,
            'image_name' => 'posts-image/qp6iehchr6d9ir4q3a8i',
            'url' => 'https://res.cloudinary.com/dqsbhrjjx/image/upload/v1647485091/posts-image/qp6iehchr6d9ir4q3a8i.png'
        ]);


        $this->call(LocationSeeder::class);
    }
}

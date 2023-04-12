<?php

namespace Database\Seeders;

use App\Models\Products;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => Str::random(10),
                'description' => Str::random(10),
                'price' => '20',
                'user_id' => 1,
                'image' => 'product1.jpeg'
            ],
            [
                'name' => Str::random(10),
                'description' => Str::random(10),
                'price' => '20',
                'user_id' => 1,
                'image' => 'product1.jpeg'
            ]
        ];

        Products::insert($data);
    }
}

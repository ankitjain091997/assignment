<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // we are inserting dummy data into the database for testing
        $data = array(
            array(
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'SuperAdmin',
            ),
            array(
                'name' => 'User',
                'email' => 'user@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'user',
            ),
            array(
                'name' => 'User1',
                'email' => 'user1@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'user',
            ),
        );

        User::insert($data);
    }
}

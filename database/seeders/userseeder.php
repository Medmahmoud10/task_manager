<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class userseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $users = [
            [
                'username' => 'johndoe',
                'password' => Hash::make('password123'),
            ],
            [
                'username' => 'janesmith',
                'password' => Hash::make('password123'),
            ],
            [
                'username' => 'robertj',
                'password' => Hash::make('password123'),
            ],
            [
                'username' => 'sarahw',
                'password' => Hash::make('password123'),
            ],
            [
                'username' => 'michaelb',
                'password' => Hash::make('password123'),
            ],
            [
                'username' => 'emilyd',
                'password' => Hash::make('password123'),
            ],
            [
                'username' => 'davidw',
                'password' => Hash::make('password123'),
            ],
            [
                'username' => 'lisat',
                'password' => Hash::make('password123'),
            ],
            [
                'username' => 'jamesa',
                'password' => Hash::make('password123'),
            ],
            [
                'username' => 'jenniferm',
                'password' => Hash::make('password123'),
            ],
        ];

        DB::table('users')->insert($users);
    }
}

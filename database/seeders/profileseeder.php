<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $profiles = [
            [
                'user_id' => 1,  // Make sure this exists in your users table
                'name' => 'John Doe',
                'email' => 'john.doe@example.com',
                'phone' => 22331233,
                'address' => '123 Main Street, Jakarta',
                'date_of_birth' => '15/05/1990',
                'bio' => 'Software developer with 5 years of experience in web applications',
            ],
            [
                'user_id' => 2,
                'name' => 'Jane Smith',
                'email' => 'jane.smith@example.com',
                'phone' => 121233,
                'address' => '456 Oak Avenue, Bandung',
                'date_of_birth' => '22/11/1985',
                'bio' => 'Digital marketing specialist and content creator',
            ],
            [
                'user_id' => 3,
                'name' => 'Robert Johnson',
                'email' => 'robert.j@example.com',
                'phone' => 454322,
                'address' => '789 Pine Road, Surabaya',
                'date_of_birth' => '03/07/1992',
                'bio' => 'Financial analyst with expertise in market trends',
            ],
            [
                'user_id' => 4,
                'name' => 'Sarah Williams',
                'email' => 'sarah.w@example.com',
                'phone' => 1234566,
                'address' => '321 Elm Boulevard, Medan',
                'date_of_birth' => '30/01/1988',
                'bio' => 'Graphic designer passionate about UX/UI',
            ],
            [
                'user_id' => 5,
                'name' => 'Michael Brown',
                'email' => 'michael.b@example.com',
                'phone' => 109283,
                'address' => '654 Maple Lane, Yogyakarta',
                'date_of_birth' => '12/09/1995',
                'bio' => 'Student pursuing degree in computer science',
            ],
            [
                'user_id' => 6,
                'name' => 'Emily Davis',
                'email' => 'emily.d@example.com',
                'phone' => 122122,
                'address' => '987 Cedar Street, Bali',
                'date_of_birth' => '25/04/1993',
                'bio' => 'Hotel manager with 7 years in hospitality industry',
            ],
            [
                'user_id' => 7,
                'name' => 'David Wilson',
                'email' => 'david.w@example.com',
                'phone' => 12345,
                'address' => '159 Birch Avenue, Makassar',
                'date_of_birth' => '08/12/1980',
                'bio' => 'Senior project manager at construction firm',
            ],
            [
                'user_id' => 8,
                'name' => 'Lisa Taylor',
                'email' => 'lisa.t@example.com',
                'phone' => 909090,
                'address' => '753 Spruce Drive, Semarang',
                'date_of_birth' => '19/07/1987',
                'bio' => 'HR professional specializing in talent acquisition',
            ],
            [
                'user_id' => 9,
                'name' => 'James Anderson',
                'email' => 'james.a@example.com',
                'phone' => 65656,
                'address' => '246 Willow Way, Palembang',
                'date_of_birth' => '05/03/1991',
                'bio' => 'Freelance photographer and videographer',
            ],
            [
                'user_id' => 10,
                'name' => 'Jennifer Martinez',
                'email' => 'jennifer.m@example.com',
                'phone' => 445533,
                'address' => '864 Aspen Court, Malang',
                'date_of_birth' => '14/10/1984',
                'bio' => 'Nutritionist and wellness coach',
            ]
        ];
        // Filter out profiles where user_id does not exist in users table
        $profiles = array_filter($profiles, function ($profile) {
            return DB::table('users')->where('id', $profile['user_id'])->exists();
        });
        $profiles = array_values($profiles); // Reindex array after filtering
        // Insert profiles into the 'profiles' table
        DB::table('profiles')->insert($profiles);
    }
}

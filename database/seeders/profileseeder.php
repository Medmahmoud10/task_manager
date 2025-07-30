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
        'id' => 1,
        'user_id' => 1,
        'name' => 'John Doe',
        'address' => '123 Main Street, Jakarta',
        'avatar' => 'avatar1.png',
        'birthdate' => '1990-05-15',
        'bio' => 'Software developer with 5 years of experience in web applications',
        'created_at' => '2022-01-10 08:15:00',
        'updated_at' => '2022-06-15 14:30:00',
    ],
    [
        'id' => 2,
        'user_id' => 2,
        'name' => 'Jane Smith',
        'address' => '456 Oak Avenue, Bandung',
        'avatar' => 'avatar2.png',
        'birthdate' => '1992-08-20',
        'bio' => 'UX Designer passionate about creating intuitive user experiences',
        'created_at' => '2022-02-15 10:20:00',
        'updated_at' => '2022-07-22 09:45:00',
    ],
    [
        'id' => 3,
        'user_id' => 3,
        'name' => 'Michael Johnson',
        'address' => '789 Pine Road, Surabaya',
        'avatar' => 'avatar3.png',
        'birthdate' => '1988-03-10',
        'bio' => 'Senior project manager in the construction industry',
        'created_at' => '2022-03-05 14:00:00',
        'updated_at' => '2022-08-30 16:20:00',
    ],
    [
        'id' => 4,
        'user_id' => 4,
        'name' => 'Sarah Williams',
        'address' => '321 Elm Street, Yogyakarta',
        'avatar' => 'avatar4.png',
        'birthdate' => '1991-11-25',
        'bio' => 'Marketing specialist with focus on digital campaigns',
        'created_at' => '2022-04-12 09:30:00',
        'updated_at' => '2022-09-18 11:10:00',
    ],
    [
        'id' => 5,
        'user_id' => 5,
        'name' => 'David Brown',
        'address' => '654 Maple Drive, Bali',
        'avatar' => 'avatar5.png',
        'birthdate' => '1985-07-08',
        'bio' => 'Financial analyst and investment consultant',
        'created_at' => '2022-05-20 13:45:00',
        'updated_at' => '2022-10-05 15:30:00',
    ],
    [
        'id' => 6,
        'user_id' => 6,
        'name' => 'Emily Davis',
        'address' => '987 Cedar Lane, Medan',
        'avatar' => 'avatar6.png',
        'birthdate' => '1993-04-17',
        'bio' => 'Elementary school teacher and children\'s book author',
        'created_at' => '2022-06-08 11:00:00',
        'updated_at' => '2022-11-12 10:15:00',
    ],
    [
        'id' => 7,
        'user_id' => 7,
        'name' => 'Robert Wilson',
        'address' => '159 Birch Boulevard, Makassar',
        'avatar' => 'avatar7.png',
        'birthdate' => '1987-09-30',
        'bio' => 'Architect specializing in sustainable design',
        'created_at' => '2022-07-14 16:20:00',
        'updated_at' => '2022-12-03 14:50:00',
    ],
    [
        'id' => 8,
        'user_id' => 8,
        'name' => 'Lisa Taylor',
        'address' => '753 Walnut Court, Semarang',
        'avatar' => 'avatar8.png',
        'birthdate' => '1994-01-12',
        'bio' => 'Freelance graphic designer and illustrator',
        'created_at' => '2022-08-25 10:45:00',
        'updated_at' => '2023-01-10 12:30:00',
    ],
    [
        'id' => 9,
        'user_id' => 9,
        'name' => 'Thomas Anderson',
        'address' => '357 Spruce Way, Palembang',
        'avatar' => 'avatar9.png',
        'birthdate' => '1989-06-22',
        'bio' => 'Mechanical engineer and robotics enthusiast',
        'created_at' => '2022-09-03 14:10:00',
        'updated_at' => '2023-02-15 09:25:00',
    ],
    [
        'id' => 10,
        'user_id' => 10,
        'name' => 'Amanda Martinez',
        'address' => '852 Redwood Avenue, Balikpapan',
        'avatar' => 'avatar10.png',
        'birthdate' => '1995-12-05',
        'bio' => 'Medical doctor specializing in pediatric care',
        'created_at' => '2022-10-17 08:30:00',
        'updated_at' => '2023-03-08 13:40:00',
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
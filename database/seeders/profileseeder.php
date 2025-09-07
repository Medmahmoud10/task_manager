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
        
        'user_id' => 1,
        'name' => 'John Doe',
        'avatar' => 'avatar1.png',
        'bio' => 'Software developer with 5 years of experience in web applications',
        'created_at' => '2022-01-10 08:15:00',
        'updated_at' => '2022-06-15 14:30:00',
    ],
    [
        
        'user_id' => 2,
        'name' => 'Jane Smith',
        'avatar' => 'avatar2.png',
        'bio' => 'UX Designer passionate about creating intuitive user experiences',
        'created_at' => '2022-02-15 10:20:00',
        'updated_at' => '2022-07-22 09:45:00',
    ],
    [
        
        'user_id' => 3,
        'name' => 'Michael Johnson',
        'avatar' => 'avatar3.png',
        'bio' => 'Senior project manager in the construction industry',
        'created_at' => '2022-03-05 14:00:00',
        'updated_at' => '2022-08-30 16:20:00',
    ],
    [
        
        'user_id' => 4,
        'name' => 'Sarah Williams',
        'avatar' => 'avatar4.png',
        'bio' => 'Marketing specialist with focus on digital campaigns',
        'created_at' => '2022-04-12 09:30:00',
        'updated_at' => '2022-09-18 11:10:00',
    ],
    [
        
        'user_id' => 5,
        'name' => 'David Brown',
        'avatar' => 'avatar5.png',
        'bio' => 'Financial analyst and investment consultant',
        'created_at' => '2022-05-20 13:45:00',
        'updated_at' => '2022-10-05 15:30:00',
    ],
    [
        
        'user_id' => 6,
        'name' => 'Emily Davis',
        'avatar' => 'avatar6.png',
        'bio' => 'Elementary school teacher and children\'s book author',
        'created_at' => '2022-06-08 11:00:00',
        'updated_at' => '2022-11-12 10:15:00',
    ],
    [
        
        'user_id' => 7,
        'name' => 'Robert Wilson',
        'avatar' => 'avatar7.png',
        'bio' => 'Architect specializing in sustainable design',
        'created_at' => '2022-07-14 16:20:00',
        'updated_at' => '2022-12-03 14:50:00',
    ],
    [
        
        'user_id' => 8,
        'name' => 'Lisa Taylor',
        'avatar' => 'avatar8.png',
        'bio' => 'Freelance graphic designer and illustrator',
        'created_at' => '2022-08-25 10:45:00',
        'updated_at' => '2023-01-10 12:30:00',
    ],
    [
        
        'user_id' => 9,
        'name' => 'Thomas Anderson',
        'avatar' => 'avatar9.png',
        'bio' => 'Mechanical engineer and robotics enthusiast',
        'created_at' => '2022-09-03 14:10:00',
        'updated_at' => '2023-02-15 09:25:00',
    ],
    [
        
        'user_id' => 10,
        'name' => 'Amanda Martinez',
        'avatar' => 'avatar10.png',
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
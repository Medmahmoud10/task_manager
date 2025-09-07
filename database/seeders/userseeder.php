<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'username' => 'johndoe',
                'password' => Hash::make('password123'),
                'email' => 'john.doe@example.com',
                'first_name' => 'John',
                'last_name' => 'Doe',
                'phone' => '1234567890',
                'address' => '123 Main St, Anytown, USA',
                'date_of_birth' => '1990-01-01',
                'bio' => 'A brief bio about John Doe.',
                'role_id' => 1,
            ],
            [
                'username' => 'michael_s',
                'password' => Hash::make('mypass789'),
                'email' => 'michael.smith@example.com', 
                'first_name' => 'Michael',
                'last_name' => 'Smith',
                'phone' => '3456789012',
                'address' => '789 Pine Rd, Nowhere, USA',
                'date_of_birth' => '1985-11-22',
                'bio' => 'Loves hiking and photography.',
                'role_id' => 2,
            ],
            [
                'username' => 'sarahj',
                'password' => Hash::make('sarahpass123'),
                'email' => 'sarah.johnson@example.com',
                'first_name' => 'Sarah',
                'last_name' => 'Johnson',
                'phone' => '4567890123',
                'address' => '321 Elm St, Anycity, USA',
                'date_of_birth' => '1988-07-30',
                'bio' => 'Marketing professional and food blogger.',
                'role_id' => 2,
            ],
            [
                'username' => 'david_wilson',
                'password' => Hash::make('davidpass456'),
                'email' => 'david.wilson@example.com',
                'first_name' => 'David',
                'last_name' => 'Wilson',
                'phone' => '5678901234',
                'address' => '654 Maple Dr, Yourtown, USA',
                'date_of_birth' => '1993-03-10',
                'bio' => 'Financial analyst and chess enthusiast.',
                'role_id' => 2,
            ],
            [
                'username' => 'emily_adams',
                'password' => Hash::make('emilypass789'),
                'email' => 'emily.adams@example.com',
                'first_name' => 'Emily',
                'last_name' => 'Adams',
                'phone' => '6789012345',
                'address' => '987 Cedar Ln, Theircity, USA',
                'date_of_birth' => '1991-09-18',
                'bio' => 'Teacher and children\'s book author.',
                'role_id' => 2,
            ],
            [
                'username' => 'robert_brown',
                'password' => Hash::make('robertpass123'),
                'email' => 'robert.brown@example.com',
                'first_name' => 'Robert',
                'last_name' => 'Brown',
                'phone' => '7890123456',
                'address' => '159 Birch Blvd, Ourcity, USA',
                'date_of_birth' => '1987-12-05',
                'bio' => 'Architect and urban planner.',
                'role_id' => 2,
            ],
            [
                'username' => 'lisa_taylor',
                'password' => Hash::make('lisapass456'),
                'email' => 'lisa.taylor@example.com',
                'first_name' => 'Lisa',
                'last_name' => 'Taylor',
                'phone' => '8901234567',
                'address' => '753 Walnut Ct, Thiscity, USA',
                'date_of_birth' => '1994-06-25',
                'bio' => 'Graphic designer and illustrator.',
                'role_id' => 2,
            ],
            [
                'username' => 'thomas_clark',
                'password' => Hash::make('thomaspass789'),
                'email' => 'thomas.clark@example.com',
                'first_name' => 'Thomas',
                'last_name' => 'Clark',
                'phone' => '9012345678',
                'address' => '357 Spruce Way, Thatcity, USA',
                'date_of_birth' => '1989-04-12',
                'bio' => 'Engineer and amateur astronomer.',
                'role_id' => 2,
            ],
            [
                'username' => 'amanda_lee',
                'password' => Hash::make('amandapass123'),
                'email' => 'amanda.lee@example.com',
                'first_name' => 'Amanda',
                'last_name' => 'Lee',
                'phone' => '0123456789',
                'address' => '852 Redwood Ave, Theircity, USA',
                'date_of_birth' => '1995-08-08',
                'bio' => 'Doctor and travel enthusiast.',
                'role_id' => 2,
            ]
        ];

        foreach ($users as $userData) {
            // Use updateOrCreate to handle existing users
            User::updateOrCreate(
                ['email' => $userData['email']], // Unique identifier
                array_merge($userData, [
                    'created_at' => now(),
                    'updated_at' => now()
                ])
            );
        }

        echo "✅ UserSeeder completed successfully! (Can run multiple times)\n";
    }
}
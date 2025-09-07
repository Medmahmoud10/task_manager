<?php

namespace Database\Seeders;

use App\Models\categories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class categorieseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Backend',
            'Frontend',
            'Fullstack', 
            'Mobile',
            'DevOps',
            'Data Science',
            'UI/UX Design',
            'Cybersecurity',
            'Electronics',
            'Books',
            'Clothing',
            'Home & Kitchen',
            'Sports & Outdoors',
        ];
        foreach ($categories as $categorie) {
            categories::create(['name' => $categorie]);
        }
    }
}

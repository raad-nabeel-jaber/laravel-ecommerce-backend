<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\About;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $aboutData = [
            'title' => 'Why Fruitkha',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur',
            'image' => 'about1.jpg'
        ];

        About::create($aboutData);
    }
}

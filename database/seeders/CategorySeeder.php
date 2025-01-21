<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Laptop'],
            ['name' => 'Phone'],
            ['name' => 'AirPods'],
            ['name' => 'Tablet'],
            ['name' => 'Smartwatch'],
            ['name' => 'Desktop'],
            ['name' => 'Gaming Console'],
            ['name' => 'Headphones'],
            ['name' => 'Camera'],
            ['name' => 'Speakers'],
            ['name' => 'Monitor'],
            ['name' => 'Keyboard'],
            ['name' => 'Mouse'],
            ['name' => 'Charger'],
            ['name' => 'Power Bank'],
            ['name' => 'Projector'],
            ['name' => 'Drone'],
            ['name' => 'VR Headset'],
            ['name' => 'Router'],
            ['name' => 'Smart Home Device'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}

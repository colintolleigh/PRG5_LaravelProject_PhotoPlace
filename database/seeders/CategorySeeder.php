<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Street' => 'Everyday life captured in public places.',
            'Landscape' => 'Mountains, forests, coastlines and wide open views.',
            'Night' => 'Photos taken after dark, from neon streets to starry skies.',
            'Nature' => 'Plants, animals and the natural world.',
            'Architecture' => 'Buildings, bridges and city skylines.',
            'Travel' => 'Moments from trips around the world.',
        ];

        foreach ($categories as $name => $description) {
            Category::create(['name' => $name, 'description' => $description]);
        }
    }
}

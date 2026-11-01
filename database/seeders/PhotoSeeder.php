<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PhotoSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('username', 'demo')->firstOrFail();

        $photos = [
            [
                'title' => 'Street Photo Rotterdam',
                'description' => 'Took a Black and White photo in Rotterdam.',
                'image_path' => 'photos/street-photo-rotterdam.jpg',
                'location' => 'Rotterdam, The Netherlands',
                'camera' => 'Fujifilm X100VI',
                'lens' => 'Built in Fujifilm lens',
                'focal_length' => '35mm',
                'aperture' => '2.8',
                'shutter_speed' => '1/125',
                'iso' => 250,
                'taken_at' => '2025-08-11',
            ],
            [
                'title' => 'Golden Hour in Kyoto',
                'description' => 'A peaceful street in Kyoto illuminated by the warm light of the setting sun.',
                'image_path' => 'photos/kyoto-golden-hour.jpg',
                'location' => 'Kyoto, Japan',
                'camera' => 'Fujifilm X-E5',
                'lens' => 'XF 35mm F2 R WR',
                'focal_length' => '35mm',
                'aperture' => 'f/2',
                'shutter_speed' => '1/250',
                'iso' => 200,
                'taken_at' => '2026-04-12',
            ],
            [
                'title' => 'Tokyo After Dark',
                'description' => 'Colorful neon signs reflecting on a wet street in Shinjuku.',
                'image_path' => 'photos/tokyo-after-dark.jpg',
                'location' => 'Shinjuku, Tokyo, Japan',
                'camera' => 'Sony A7 IV',
                'lens' => 'FE 24-70mm F2.8 GM',
                'focal_length' => '35mm',
                'aperture' => 'f/2.8',
                'shutter_speed' => '1/125',
                'iso' => 1600,
                'taken_at' => '2026-04-15',
            ],
            [
                'title' => 'Mountain Reflections',
                'description' => 'A crystal-clear alpine lake reflecting the surrounding mountains.',
                'image_path' => 'photos/mountain-reflections.jpg',
                'location' => 'Nagano, Japan',
                'camera' => 'Fujifilm X-T5',
                'lens' => 'XF 16-80mm F4 R OIS WR',
                'focal_length' => '23mm',
                'aperture' => 'f/8',
                'shutter_speed' => '1/125',
                'iso' => 160,
                'taken_at' => '2026-04-20',
            ],
            [
                'title' => 'Rotterdam Blue Hour',
                'description' => 'Modern architecture and city lights during the blue hour.',
                'image_path' => 'photos/rotterdam-blue-hour.jpg',
                'location' => 'Rotterdam, Netherlands',
                'camera' => 'Fujifilm X-E5',
                'lens' => 'XF 23mm F2 R WR',
                'focal_length' => '23mm',
                'aperture' => 'f/4',
                'shutter_speed' => '2',
                'iso' => 400,
                'taken_at' => '2026-05-08',
            ],
            [
                'title' => 'Misty Forest Trail',
                'description' => 'A narrow trail disappearing into a misty forest early in the morning.',
                'image_path' => 'photos/misty-forest.jpg',
                'location' => 'Veluwe, Netherlands',
                'camera' => 'Canon EOS R6',
                'lens' => 'RF 24-105mm F4 L IS USM',
                'focal_length' => '50mm',
                'aperture' => 'f/4',
                'shutter_speed' => '1/100',
                'iso' => 800,
                'taken_at' => '2026-05-15',
            ],
            [
                'title' => 'Coastal Serenity',
                'description' => 'Soft waves washing over the shore under an overcast sky.',
                'image_path' => 'photos/coastal-serenity.jpg',
                'location' => 'Scheveningen, Netherlands',
                'camera' => 'Nikon Z6 II',
                'lens' => 'NIKKOR Z 24-70mm f/4 S',
                'focal_length' => '35mm',
                'aperture' => 'f/8',
                'shutter_speed' => '1/500',
                'iso' => 100,
                'taken_at' => '2026-06-02',
            ],
            [
                'title' => 'Autumn in the City',
                'description' => 'Golden autumn leaves surrounding a quiet city street.',
                'image_path' => 'photos/autumn-city.jpg',
                'location' => 'Amsterdam, Netherlands',
                'camera' => 'Fujifilm X-T5',
                'lens' => 'XF 33mm F1.4 R LM WR',
                'focal_length' => '33mm',
                'aperture' => 'f/2',
                'shutter_speed' => '1/320',
                'iso' => 320,
                'taken_at' => '2025-10-18',
            ],
            [
                'title' => 'Starry Night Sky',
                'description' => 'A long exposure photograph capturing stars above a remote landscape.',
                'image_path' => 'photos/starry-night.jpg',
                'location' => 'Lofoten, Norway',
                'camera' => 'Sony A7 III',
                'lens' => 'FE 20mm F1.8 G',
                'focal_length' => '20mm',
                'aperture' => 'f/1.8',
                'shutter_speed' => '15',
                'iso' => 3200,
                'taken_at' => '2025-08-21',
            ],
            [
                'title' => 'Morning Coffee',
                'description' => 'A cozy coffee shop interior with soft natural light falling across a table.',
                'image_path' => 'photos/morning-coffee.jpg',
                'location' => 'Utrecht, Netherlands',
                'camera' => 'Fujifilm X-E5',
                'lens' => 'XF 35mm F2 R WR',
                'focal_length' => '35mm',
                'aperture' => 'f/2',
                'shutter_speed' => '1/160',
                'iso' => 640,
                'taken_at' => '2026-07-11',
            ],
            [
                'title' => 'Ocean Sunset Silhouette',
                'description' => 'A dramatic sunset with a silhouetted figure standing near the water.',
                'image_path' => 'photos/ocean-sunset.jpg',
                'location' => 'Algarve, Portugal',
                'camera' => 'Canon EOS R5',
                'lens' => 'RF 70-200mm F2.8 L IS USM',
                'focal_length' => '135mm',
                'aperture' => 'f/4',
                'shutter_speed' => '1/500',
                'iso' => 200,
                'taken_at' => '2026-08-03',
            ],
        ];

        foreach ($photos as $photo) {
            $user->photos()->create($photo);
        }
    }
}

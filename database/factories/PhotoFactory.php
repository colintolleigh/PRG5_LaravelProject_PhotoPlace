<?php

namespace Database\Factories;

use App\Models\Photo;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Photo>
 */
class PhotoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => fake()->sentence(3),
            'description' => fake()->sentence(),
            'image_path' => 'photos/'.fake()->slug(2).'.jpg',
            'location' => fake()->city().', '.fake()->country(),
            'camera' => 'Fujifilm X-T5',
            'lens' => 'XF 23mm f/1.4',
            'focal_length' => '23mm',
            'aperture' => 'f/2.8',
            'shutter_speed' => '1/250',
            'iso' => fake()->randomElement([100, 200, 400, 800, 1600]),
            'taken_at' => fake()->date(),
            'is_visible' => true,
        ];
    }

    /**
     * Indicate that the photo is hidden from the public overview.
     */
    public function hidden(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_visible' => false,
        ]);
    }
}

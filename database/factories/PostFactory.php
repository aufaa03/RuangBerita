<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence(4); // Membuat judul dari 4 kata

        return [
            'user_id' => User::factory(), // Membuat user baru untuk setiap post
            'category_id' => Category::inRandomOrder()->first()->id, // Memilih ID kategori secara acak
            'title' => $title,
            'slug' => Str::slug($title, '-'),
            'body' => fake()->paragraphs(10, true), // Membuat 10 paragraf teks
        ];
    }
}
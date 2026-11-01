<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => rtrim(fake()->text(40), '.'),
            'publisher' => substr(fake()->company(), 0, 40),
            'edition' => mt_rand(1, 6),
            'price' => mt_rand(10, 100),
            'publication_year' => fake()->date('Y'),
        ];
    }
}

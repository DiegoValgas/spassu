<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Subject;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Book::factory()
            ->hasAttached(Author::factory()->count(mt_rand(1, 4)))
            ->hasAttached(Subject::factory()->count(mt_rand(1, 4)))
            ->count(20)
            ->create();
    }
}

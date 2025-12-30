<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('authors')->truncate();
        Author::factory()->createMany([
            [
                'id' => 1,
                'name' => Factory::create()->name,
            ],
            [
                'id' => 2,
                'name' => Factory::create()->name,
            ],
            [
                'id' => 3,
                'name' => Factory::create()->name,
            ],
            [
                'id' => 4,
                'name' => Factory::create()->name,
            ],
            [
                'id' => 5,
                'name' => Factory::create()->name,
            ],
        ]);

        DB::table('books')->truncate();
        Book::factory()->createMany([
            [
                'id' => 1,
                'title' => 'Book#1',
                'rating' => 1,
            ],
            [
                'id' => 2,
                'title' => 'Book#2',
                'rating' => 5,
            ],
            [
                'id' => 3,
                'title' => 'Book#3',
                'rating' => 13,
            ],
            [
                'id' => 4,
                'title' => 'Book#4',
                'rating' => 21
            ],
        ]);

        DB::table('authors_books_pivot')->truncate();
        DB::table('authors_books_pivot')->insert([
            [
                'author_id' => 1,
                'book_id' => 1,
            ],
            [
                'author_id' => 2,
                'book_id' => 2,
            ],
            [
                'author_id' => 3,
                'book_id' => 3,
            ],
            [
                'author_id' => 4,
                'book_id' => 4,
            ],
            [
                'author_id' => 5,
                'book_id' => 4,
            ]
        ]);

        DB::table('users')->truncate();
        User::factory(10)->create();
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}

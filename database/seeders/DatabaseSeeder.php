<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author;
use App\Models\Category;
use App\Models\Book;
use App\Models\Rating;


class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Author::factory(1000)->create();
        Category::factory(3000)->create();
        Book::factory(100000)->create();
        Rating::factory(500000)->create();
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Rating;
class RatingSeeder extends Seeder
{
    public function run()
    {
        $books = Book::all();

        foreach ($books as $book) {
            Rating::create([
                'book_id' => $book->id,
                'rating' => rand(1, 10),
            ]);
        }
    }
}

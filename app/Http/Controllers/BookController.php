<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;
use App\Models\Rating;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    // List of books with filter
    public function index(Request $request)
    {
        $listShow = $request->get('list_show', 10);
        $search = $request->get('search');

        $query = Book::select([
                'books.id',
                'books.name as book_name',
                'categories.name as category_name',
                'authors.name as author_name',
                DB::raw('ROUND(AVG(ratings.rating), 2) as average_rating'),
                DB::raw('COUNT(ratings.id) as voter')
            ])
            ->join('authors', 'books.author_id', '=', 'authors.id')
            ->join('categories', 'books.category_id', '=', 'categories.id')
            ->leftJoin('ratings', 'books.id', '=', 'ratings.book_id')
            ->groupBy('books.id', 'books.name', 'categories.name', 'authors.name');

        // Apply search filter
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('books.name', 'like', "%$search%")
                  ->orWhere('authors.name', 'like', "%$search%");
            });
        }

        $books = $query->orderByDesc('average_rating')
                      ->orderByDesc('voter')
                      ->limit($listShow)
                      ->get();

        return view('books.index', compact('books', 'listShow', 'search'));
    }

    // Top 10 authors by vote count (only ratings > 5)
    public function topAuthors()
    {
        $authors = Author::select([
                'authors.id',
                'authors.name',
                DB::raw('COUNT(ratings.id) as voter_count')
            ])
            ->join('books', 'authors.id', '=', 'books.author_id')
            ->join('ratings', 'books.id', '=', 'ratings.book_id')
            ->where('ratings.rating', '>', 5)
            ->groupBy('authors.id', 'authors.name')
            ->orderByDesc('voter_count')
            ->limit(10)
            ->get();

        return view('authors.top', compact('authors'));
    }

    // Form input rating
    public function createRating()
    {
        $authors = Author::select('id', 'name')->orderBy('name')->get();

        return view('ratings.create', compact('authors'));
    }

    // Get books by author (AJAX)
    public function getBooksByAuthor($authorId)
    {
        $books = Book::where('author_id', $authorId)
                    ->select('id', 'name')
                    ->orderBy('name')
                    ->get();

        return response()->json($books);
    }

    // Store rating
    public function storeRating(Request $request)
    {
        $request->validate([
            'author_id' => 'required|exists:authors,id',
            'book_id' => 'required|exists:books,id',
            'rating' => 'required|integer|min:1|max:10',
        ]);

        // Verify book belongs to author
        $book = Book::where('id', $request->book_id)
                   ->where('author_id', $request->author_id)
                   ->first();

        if (!$book) {
            return back()->withErrors(['book_id' => 'Selected book does not belong to selected author']);
        }

        Rating::create([
            'book_id' => $request->book_id,
            'rating' => $request->rating,
        ]);

        return redirect()->route('books.index')->with('success', 'Rating successfully added');
    }
}

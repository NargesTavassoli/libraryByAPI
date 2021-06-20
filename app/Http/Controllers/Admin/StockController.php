<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Models\Stock;
use Illuminate\Http\Request;


class StockController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function validation()
    {
        $books = Book::where('is_valid', 0)->simplePaginate(4);
        $books = BookResource::collection($books);

        return response($books, 201);

    }

    public function stock(Request $request, $bookId)
    {
        $stock = Stock::where('book_id', $bookId);
       if (! $stock->exists()) {
           $stock = new Stock();
           $stock->create([
               'book_id' => $bookId,
               'number' => $request->stock,
           ]);
       }
       else
       {
           $stock->update([
               'number' => $request->stock,
           ]);
       }

        $book = Book::find($bookId);
        $book->update([
            'is_valid' => 1
        ]);

        return response($book, 201);
    }
}

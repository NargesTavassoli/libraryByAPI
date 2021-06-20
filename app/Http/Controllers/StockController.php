<?php

namespace App\Http\Controllers;

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
        $books = Book::where('validation', '=', 0)->simplePaginate(4);
        $stock = Stock::all();

        return view('book.validation', compact('books', 'stock'));

    }

    public function stock(Request $request, $id)
    {
        $stock = Stock::findOrFail($id);
       if (! $stock->exists()) {
           $stock = new Stock();
           $stock->create([
               'book_id' => $id,
               'number' => $request->stock,
           ]);
       }
       else
       {
           $stock->update([
               'number' => $request->stock,
           ]);
       }

        $book = Book::find($id);
        $book->update([
            'validation' => 1
        ]);

        return redirect()->back();
    }
}

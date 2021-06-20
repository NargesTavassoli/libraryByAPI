<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\createBookRequest;
use App\Http\Requests\Book\updateBookRequest;
use App\Http\Resources\BookResource;
use App\Http\Resources\LogResource;
use App\Models\ActivityLog;
use App\Models\Book;
use App\Models\Rating;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\Models\Activity;

class BookController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        Activity::all();
    }

    public function index()
    {
        $books = Book::where('is_valid', 1)->orderBy('created_at', 'DESC')->simplePaginate(4);
        $books = BookResource::collection($books);
        return response($books);

    }

    public function create(createBookRequest $request)
    {
        $book = new Book();

        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $filename = rand(1111111, 99999999) . $image->getClientOriginalName();
            $image->storeAs('images', $filename, 'public');
        } else {
            $filename = null;
        }

        $book->create([
            'title' => $request->title,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'year' => $request->year,
            'price' => $request->price,
            'user_id' => \Auth::user()->id,
            'image' => $filename,
            'is_valid' => true,
        ]);
        $book = Book::where([
            'title' => $request->title,
            'author' => $request->author,
        ])->first();
        $stock = new Stock();
        $stock->create([
            'book_id' => $book->id,
            'number' => $request->stock,
        ]);
        return response($book, 201);
    }

    public function edit(updateBookRequest $request, $id)
    {

        $data = $request->only([
            'title',
            'author',
            'publisher',
            'year',
            'price',
        ]);
        $book = Book::findOrFail($id);
        $stock = $book->stock;

        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $filename = rand(1111111, 99999999) . $image->getClientOriginalName();
            $image->storeAs('images', $filename, 'public');
            $book->update(['image' => $filename]);
        }
        $book->update($data);

        if ($request->has('stock')) {
            $stock->update([
                'number' => $request->stock,
            ]);
        }

        return response($book, 202);
    }

    public function delete($id)
    {
        $book = Book::findOrFail($id);
        Storage::disk('public')->delete('/images/' . $book->image);
        $book->delete();
        return response(null, 204);
    }

    public function history()
    {
        $logs = ActivityLog::query()->orderBy('created_at', 'DESC')->get();
        $logs = LogResource::collection($logs);
        return $logs;
    }

}

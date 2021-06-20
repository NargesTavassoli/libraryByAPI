<?php

namespace App\Http\Controllers;

use App\Http\Requests\Book\createBookRequest;
use App\Http\Requests\Book\updateBookRequest;
use App\Http\Resources\BookResource;
use App\Http\Resources\LogResource;
use App\Models\ActivityLog;
use App\Models\Book;
use App\Models\Rating;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\Models\Activity;

class BookController extends Controller
{

    public function __construct()
    {
        Activity::all();
    }

    public function index()
    {

        $books = Book::where('is_valid', 1)->get();
        $books = BookResource::collection($books);
        return $books;
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

        ]);
        return response($book, 201);
    }

    public function edit(updateBookRequest $request, $bookId)
    {
        $data = $request->only([
            'title',
            'author',
            'publisher',
            'year',
            'price',
        ]);

        $book = Book::findOrFail($bookId);
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $filename = rand(1111111, 99999999) . $image->getClientOriginalName();
            $image->storeAs('images', $filename, 'public');
            $book->update(['image' => $filename]);
        }
        $book->update($data);
        return response($book, 202);
    }

    public function delete(Request $request, $bookId)
    {
        $book = Book::findOrFail($bookId);

        if (Auth::user()->id === $book->user_id)
        {
            Storage::disk('public')->delete('/images/' . $book->image);
            $book->delete();
            return response(null, 204);
        }

        return response('به این بخش دسترسی ندارید', 403);
    }

    public function history($userId)
    {
        $logs = ActivityLog::where('causer_id', $userId)->orderBy('created_at', 'DESC')->get();
        $logs = LogResource::collection($logs);
        return $logs;
    }

    public function rating(Request $request, $book_id)
    {
            $user_id = \Auth::user()->id;
            $rate = Rating::where('user_id', $user_id)->where('book_id', $book_id);
            if ($rate->exists()) {
                $rate->update([
                    'rate' => $request->rate,
                ]);
            } else {
                $rate = new Rating;
                $rate->create([
                    'book_id' => $book_id,
                    'user_id' => $user_id,
                    'rate' => $request->rate,
                ]);
            }
        return response('امتیاز ثبت شد', 201);


    }

}

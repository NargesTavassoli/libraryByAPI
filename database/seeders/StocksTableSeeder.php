<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Stock;
use Illuminate\Database\Seeder;

class StocksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Stock::query()->truncate();
        $bookIds = Book::pluck('id')->toArray();

        foreach ($bookIds as $bookId){
            Stock::factory()->create([
                'book_id'=> $bookId
            ]);
        }
    }
}

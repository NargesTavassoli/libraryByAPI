<?php namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Book::query()->truncate();

        $userIds = User::all()->pluck('id')->toArray();
        for ($i=0 ; $i<=20 ; $i++ ){
            Book::factory()->create([
                'user_id' => Arr::random($userIds)
            ]);
        }
    }

}

<?php namespace Database\Seeders;

use App\Models\Book;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RatingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rating::query()->truncate();

        $userIds = User::pluck('id')->toArray();
        $bookIds = Book::pluck('id')->toArray();

        foreach ($bookIds as $bookId){
            shuffle($userIds);
            $randomUserIds = array_slice($userIds, '0', random_int(1, 4));

            foreach ($randomUserIds as $userId){
                Rating::factory()->create([
                    'book_id' => $bookId,
                    'user_id' => $userId,
                ]);
            }
        }
    }
}

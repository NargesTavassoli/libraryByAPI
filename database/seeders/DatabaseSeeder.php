<?php namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        User::query()->truncate();
        User::factory(10)->create();

        $this->call(UsersTableSeeder::class);
        $this->call(BooksTableSeeder::class);
        $this->call(StocksTableSeeder::class);
        $this->call(RatingsTableSeeder::class);

         Schema::enableForeignKeyConstraints();
    }
}

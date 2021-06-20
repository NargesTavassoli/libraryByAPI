<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->uuid('book_id');
            $table->uuid('user_id');
            $table->unique(['book_id', 'user_id']);
            $table->tinyInteger('rate');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('book_id')
                ->references('id')
                ->on('books')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ratings', function (Blueprint $table){
            $table->dropForeign(['book_id']);
        });
        Schema::dropIfExists('ratings');
    }
}

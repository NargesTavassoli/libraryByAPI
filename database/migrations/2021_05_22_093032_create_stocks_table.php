<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->uuid('book_id')->unique();
            $table->unsignedInteger('number');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('book_id')
                ->references('id')
                ->on('books')
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
        Schema::table('stocks', function (Blueprint $table){
           $table->dropForeign(['book_id']);
        });
        Schema::dropIfExists('stocks');
    }
}

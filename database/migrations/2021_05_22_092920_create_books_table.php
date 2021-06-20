<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->string('title');
            $table->string('author');
            $table->string('publisher');
            $table->smallInteger('year');
            $table->unsignedInteger('price');
            $table->string('image')->nullable();
            $table->boolean('is_valid')->default(false);
            $table->softDeletes();
            $table->timestamps();


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
        Schema::table('books', function (Blueprint $table){
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('books');
    }
}

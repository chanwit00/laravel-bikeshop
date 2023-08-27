<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 10);
            $table->string('name', 100);
            $table->integer('typebook_id')->unsigned();
            $table->float('price')->nullable();
            $table->integer('stock_qty')->nullable();
            $table->string('image_url', 200)->nullable();
            $table->timestamps();
            // foreign key
            $table->foreign('typebook_id')->references('id')->on('typebook');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book');
    }
}

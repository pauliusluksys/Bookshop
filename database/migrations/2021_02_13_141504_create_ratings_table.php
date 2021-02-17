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
           $table->integer('rating');
           $table->text('comment');
           $table->integer('status');
           $table->timestamps();
           $table->foreignId('user_id')->constrained()->onUpdate('cascade')
           ->onDelete('cascade');
           $table->foreignId('book_id')->constrained()->onUpdate('cascade')
           ->onDelete('cascade');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ratings');
    }
}

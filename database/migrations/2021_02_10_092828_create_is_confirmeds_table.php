<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIsConfirmedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('is_confirmeds', function (Blueprint $table) {
            $table->id();
            $table->string('message')->nullable();
            $table->timestamps();
            $table->foreignId("is_confirmed_type_id");
            $table->foreignId("book_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('is_confirmeds');
    }
}

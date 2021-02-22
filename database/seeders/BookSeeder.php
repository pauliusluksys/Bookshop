<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;
use App\Models\Genre;
use App\Models\Book;
use App\Models\Confirmation;
use Illuminate\Support\Collection;
class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	
        

        Book::factory()->has(Confirmation::factory()->count(1))->count(100)->create()->each(
            function($book){
                $genres=Genre::all()->random(rand(1,2));
                $authors=Author::all()->random(rand(1,3));
                $book->authors()->attach($authors);
                $book->genres()->attach($genres);



            }

        );

            //has(Confirmation::factory()->count(1))->hasAttached($genres->random(rand(1,2)))->hasAttached($authors->random(rand(1,3)))->count(51)->create();

         
    }
}

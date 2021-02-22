<?php

namespace Database\Seeders;
use Database\Seeders\GenresSeeder;
use Illuminate\Database\Seeder;
use App\Models\Book;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {



    	$this->call([
    		UserSeeder::class,
    		GenreSeeder::class,
    		AuthorSeeder::class,
    		BookSeeder::class,

    	]);


       
       	//$imageUrl=$faker->imageUrl(640, 480);

          // $books =\App\Models\Book::factory()->count(30)->create()->each(function ($book) {
          //   // Seed the relation with one address
          //   $isConfirmed = \App\Models\Book::factory()->make();
          //   $book->isConfirmed()->save($isConfirmed);
          //   });
         


    }
}

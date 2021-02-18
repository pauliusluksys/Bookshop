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
        GenresSeeder::class]);


       DB::table('users')->insert([
            'name' => "admin",
            'email' => "admin@gmail.com",
            'password' => Hash::make('password'),
            'role' =>'admin',
        ]);
       DB::table('users')->insert([
            'name' => "user",
            'email' => "user@gmail.com",
            'password' => Hash::make('password'),
            'role' =>'regular',
        ]);
       	//$imageUrl=$faker->imageUrl(640, 480);

          // $books =\App\Models\Book::factory()->count(30)->create()->each(function ($book) {
          //   // Seed the relation with one address
          //   $isConfirmed = \App\Models\Book::factory()->make();
          //   $book->isConfirmed()->save($isConfirmed);
          //   });
         $genres=\App\Models\Genre::all();
         $book=\App\Models\Book::factory()->has(\App\Models\Confirmation::factory()->count(1))->hasAttached($genres)->count(51)->create();

         $author=\App\Models\Author::factory()->count(20)->create();


         foreach(Book::all() as $book){
         	$author=\App\Models\Author::inRandomOrder()->take(1)->pluck('id');
         	$book->authors()->attach($author);
         	//$book->addMediaFromUrl($url)->toMediaCollection('books');
         }


    }
}

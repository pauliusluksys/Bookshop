<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       DB::table('users')->insert([
            'name' => "admin",
            'email' => "admin@gmail.com",
            'password' => Hash::make('password'),
        ]);
       DB::table('users')->insert([
            'name' => "user",
            'email' => "user@gmail.com",
            'password' => Hash::make('password'),
        ]);
       DB::table('is_confirmed_types')->insert([
            'name' => "Admin is yet to confirm",
            
        ]);
        DB::table('is_confirmed_types')->insert([
            'name' => "Admin has accepted",
            
        ]);
         DB::table('is_confirmed_types')->insert([
            'name' => "Admin has denied",
            
        ]);


          // $books =\App\Models\Book::factory()->count(30)->create()->each(function ($book) {
          //   // Seed the relation with one address
          //   $isConfirmed = \App\Models\Book::factory()->make();
          //   $book->isConfirmed()->save($isConfirmed);
          //   });

         $book=\App\Models\Book::factory()->has(\App\Models\IsConfirmed::factory()->count(1))->count(51)->create();

         $author=\App\Models\Author::factory()->count(20)->create();


         foreach(Book::all() as $book){
         	$author=\App\Models\Author::inRandomOrder()->take(1)->pluck('id');
         	$book->author()->attach($author);
         }


    }
}

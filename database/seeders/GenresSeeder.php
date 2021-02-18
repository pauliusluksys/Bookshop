<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;
use Illuminate\Support\Facades\DB;
class GenresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genres')->insert([
            'name' => 'Fiction',
            
        ]);
        DB::table('genres')->insert([
            'name' => 'Romance',
            
        ]);
        DB::table('genres')->insert([
            'name' => 'Detective and Mystery',
            
        ]);
    }
}

<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\IsConfirmed;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title,
            'description' => $this->faker->text,
            'author_id' => 1,
            'user_id' => 2,
            
        ];
    }
}

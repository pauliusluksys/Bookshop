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
            'title' => $this->faker->realText(100,2),
            'description' => $this->faker->text,
            'user_id' => 2,
            'price' => $this->faker->randomFloat(2, 1, 100),
            'discount' => $this->faker->randomNumber(2, false),
        ];
    }
}

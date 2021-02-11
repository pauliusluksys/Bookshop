<?php

namespace Database\Factories;

use App\Models\IsConfirmed;
use Illuminate\Database\Eloquent\Factories\Factory;

class IsConfirmedFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = IsConfirmed::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'is_confirmed_type_id' => 1,
        ];
    }
}

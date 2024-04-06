<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DishFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'price' => $this->faker->randomFloat(2,0, 100),
            'proteins' => $this->faker->randomFloat(2,0, 100),
            'fats' => $this->faker->randomFloat(2,0, 100),
            'carbohydrates' => $this->faker->randomFloat(2,0, 100),
            'callories' => $this->faker->randomFloat(2,0, 100),
        ];
    }
}

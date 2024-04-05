<?php

namespace Database\Factories;

use App\Models\Kindergarten;
use Illuminate\Database\Eloquent\Factories\Factory;

class GroupFactory extends Factory
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
            'kindergarten_id' => Kindergarten::factory()->create()
        ];
    }
}

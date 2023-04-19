<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TagsFactory extends Factory
{
    public function definition(): array
    {
        return [
            'tag' => $this->faker->word
        ];
    }
}

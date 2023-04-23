<?php

namespace Database\Factories;

use Faker\Generator as FakerGenerator;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagsFactory extends Factory
{
    public function definition(): array
    {
        return [
            'tag' => $this->generateWordWithMinLength($this->faker, 2),
        ];
    }

    private function generateWordWithMinLength(FakerGenerator $faker, int $minLength): string
    {
        do {
            $word = $faker->word;
        } while (strlen($word) < $minLength);

        return $word;
    }
}

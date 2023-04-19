<?php

namespace Database\Factories;

use App\Models\News;
use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    protected $model = News::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'body' => $this->faker->paragraphs(3, true),
            'isActive' => $this->faker->boolean,
            'created_at' => $this->faker->dateTimeBetween('-2 months', 'now'),
            'image_file_path' => null
        ];
    }
}

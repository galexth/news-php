<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'author' => $this->faker->name,
            'title' => $this->faker->sentence,
            'url' => $this->faker->url . rand(),
            'image_url' => $this->faker->imageUrl,
            'description' => $this->faker->text(200),
            'content' => $this->faker->text(500),
            'published_at' => $this->faker->dateTimeBetween('-1 month'),
        ];
    }
}

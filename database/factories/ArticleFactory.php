<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition()
    {
        $title = $this->faker->sentence(6);
        $body = $this->faker->paragraph(10);
        $image = $this->faker->imageUrl(800, 600, 'sports');
        $slug = Str::slug($title, '-');

        return [
            'category_id' => Category::factory(),
            'title' => $title,
            'body' => $body,
            'image' => $image,
            'slug' => $slug,
        ];
    }
}

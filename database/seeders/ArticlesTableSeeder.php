<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article;

class ArticlesTableSeeder extends Seeder
{
    public function run()
    {
        $articles = [
            [
                'category_id' => 1,
                'title' => 'Article 1',
                'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sodales dui in erat convallis, in rutrum eros tempor. Etiam lacinia fringilla nibh, non sagittis turpis iaculis ac.',
                'image' => 'article1.jpg'
            ],
            [
                'category_id' => 2,
                'title' => 'Article 2',
                'body' => 'Pellentesque accumsan massa quis nulla porttitor sagittis. Duis vel ante vitae sapien dignissim tristique. Duis euismod libero sit amet tellus rhoncus, vel molestie turpis facilisis. ',
                'image' => 'article2.jpg'
            ],
            [
                'category_id' => 3,
                'title' => 'Article 3',
                'body' => 'Nam a quam vel est rutrum porttitor. Aliquam eget fringilla justo. Praesent ut elit sit amet elit lobortis bibendum. Morbi auctor enim ut mi dictum, ac eleifend felis tincidunt. ',
                'image' => 'article3.jpg'
            ]
        ];

        Article::insert($articles);
    }
}


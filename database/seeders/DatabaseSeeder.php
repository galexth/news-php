<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Source;
use Database\Factories\ArticleFactory;
use Database\Factories\SourceFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Source::truncate();
        Article::truncate();

        SourceFactory::new()->count(20)
            ->has(ArticleFactory::new()->count(50))
            ->create();
    }
}

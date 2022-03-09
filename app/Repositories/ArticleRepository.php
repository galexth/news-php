<?php

namespace App\Repositories;

use App\Models\Article;
use App\Models\Source;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Carbon;

class ArticleRepository implements ArticleRepositoryInterface
{
    public function getAll(array $criteria = [], array $with = [], int $page = 1, int $perPage = 20): Paginator
    {
        $query = Article::query()->with($with);

        if (isset($criteria['source'])) {
            $query->ofSource($criteria['source']);
        }

        if (isset($criteria['date'])) {
            $query->whereDate(
                'published_at',
                Carbon::parse($criteria['date'])->toDateString()
            );
        }

        if (isset($criteria['title'])) {
            $query->where('title', 'like', "%{$criteria['title']}%");
        }

        return $query->simplePaginate($perPage, page: $page);
    }

    public function firstOrCreate(array $attributes): Article
    {
        if (isset($attributes['source'])) {
            $attributes['source']['id'] ??= strtolower($attributes['source']['name']);
        }

        $source = Source::firstOrCreate(
            ['external_id' => $attributes['source']['id'],],
            ['name' => $attributes['source']['name'],]
        );

        $attributes['published_at'] = Carbon::parse($attributes['publishedAt']);

        $article = $source->articles()->firstOrCreate(['url' => $attributes['url']], $attributes);

        return $article;
    }
}

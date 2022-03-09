<?php

namespace App\Repositories;

use App\Models\Article;
use App\Models\Source;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class ArticleRepository implements ArticleRepositoryInterface
{
    public function getAll(array $criteria = [], array $with = [], int $page = 1, int $perPage = 20): Paginator
    {
        $query = Article::query()->with($with);

        if (isset($criteria['source'])) {
            $query->ofSource($criteria['source']);
        }

        if (isset($criteria['date'])) {
            $query->whereDate('published_at', Carbon::parse($criteria['date']));
        }

        if (isset($criteria['query_used'])) {
            $query->where('query_used', strtolower($criteria['query_used']));
        }

        if (isset($criteria['q'])) {
            $query->where(function (Builder $q) use ($criteria) {
                $q->where('title', 'like', "%{$criteria['q']}%")
                    ->orWhere('content', 'like', "%{$criteria['q']}%");
            });
        }

        return $query->simplePaginate($perPage, page: $page);
    }

    public function firstOrCreate(array $attributes): Article
    {
        if (isset($attributes['source'])) {
            $attributes['source']['id'] ??= Str::slug($attributes['source']['name'], '_');
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

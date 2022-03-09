<?php

namespace App\Repositories;

use App\Models\Article;
use Illuminate\Contracts\Pagination\Paginator;

interface ArticleRepositoryInterface
{
    public function firstOrCreate(array $attributes): Article;

    public function getAll(array $criteria = [], array $with = [], int $page = 1, int $perPage = 20): Paginator;
}

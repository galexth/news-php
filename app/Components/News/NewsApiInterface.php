<?php

namespace App\Components\News;

interface NewsApiInterface
{
    public function fetchAll(string $q, int $page = 1, int $size = 100, string $from = null): Response;
}

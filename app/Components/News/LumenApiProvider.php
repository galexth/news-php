<?php

namespace App\Components\News;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class LumenApiProvider implements NewsApiInterface
{
    protected string $baseUri = 'https://newsapi.org/v2';

    public function fetchAll(string $q, int $page = 1, int $size = 100, string $from = null): Response
    {
        $params = [
            'apiKey' => config('news.api_key'),
            'q' => $q,
            'page' => $page,
            'pageSize' => $size,
            'sortBy' => 'publishedAt',
            'language' => 'en',
        ];

        if ($from) {
            $params['from'] = Carbon::parse($from)->toIso8601String();
        }

        $res = Http::baseUrl($this->baseUri)->get('everything', $params);

        if ($res->failed()) {
            throw $res->toException();
        }

        $json = $res->json();

        return new Response($json['articles'], $page, $size, $json['totalResults']);
    }
}

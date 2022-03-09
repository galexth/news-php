<?php

namespace App\Jobs;

use App\Components\News\NewsApiInterface;
use App\Repositories\ArticleRepositoryInterface;

class ParseArticles extends Job
{
    private string $query;

    public function __construct(string $query)
    {
        $this->query = $query;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(NewsApiInterface $parser, ArticleRepositoryInterface $repo)
    {
        $res = $parser->fetchAll($this->query, 1, 1);

        $data = array_merge($res->getCollection()->first(), ['query_used' => $this->query]);

        $repo->firstOrCreate($data);
    }
}

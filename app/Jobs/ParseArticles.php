<?php

namespace App\Jobs;

use App\Components\News\NewsApiInterface;
use App\Repositories\ArticleRepositoryInterface;

class ParseArticles extends Job
{
    private string $topic;

    public function __construct(string $topic)
    {
        $this->topic = $topic;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(NewsApiInterface $parser, ArticleRepositoryInterface $repo)
    {
        $res = $parser->fetchAll($this->topic, 1, 1);

        $repo->firstOrCreate($res->getCollection()->first());
    }
}

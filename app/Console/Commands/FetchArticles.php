<?php

namespace App\Console\Commands;

use App\Components\News\NewsApiInterface;
use App\Repositories\ArticleRepositoryInterface;
use Illuminate\Console\Command;

class FetchArticles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'articles:fetch {q} {--page=1} {--size=100}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetches news';

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(NewsApiInterface $parser, ArticleRepositoryInterface $repo)
    {
        $q = $this->argument('q');
        $page = (int) $this->option('page');
        $size = (int) $this->option('size');

        $res = $parser->fetchAll($q, $page, $size);

        $res->getCollection()->each(fn($item) => $repo->firstOrCreate($item));
    }
}

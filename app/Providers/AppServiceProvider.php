<?php

namespace App\Providers;

use App\Components\News\LumenApiProvider;
use App\Components\News\NewsApiInterface;
use App\Repositories\ArticleRepository;
use App\Repositories\ArticleRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(NewsApiInterface::class, LumenApiProvider::class);
        $this->app->bind(ArticleRepositoryInterface::class, ArticleRepository::class);
    }
}

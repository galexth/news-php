<?php

namespace App\Console;

use App\Console\Commands\FetchArticles;
use App\Jobs\ParseArticles;
use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        FetchArticles::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->job(new ParseArticles('Bitcoin'))->everyMinute();
        $schedule->job(new ParseArticles('Litecoin'))->everyMinute();
        $schedule->job(new ParseArticles('Ripple'))->everyMinute();
        $schedule->job(new ParseArticles('Dash'))->everyMinute();
        $schedule->job(new ParseArticles('Ethereum'))->everyMinute();

    }
}

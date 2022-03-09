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
        $schedule->job(new ParseArticles('bitcoin'))->everyMinute();
        $schedule->job(new ParseArticles('litecoin'))->everyMinute();
        $schedule->job(new ParseArticles('ripple'))->everyMinute();
        $schedule->job(new ParseArticles('dash'))->everyMinute();
        $schedule->job(new ParseArticles('ethereum'))->everyMinute();

    }
}

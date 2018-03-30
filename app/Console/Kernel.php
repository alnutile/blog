<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\Search\CreateIndex;
use App\Console\Commands\Search\DeleteIndex;
use App\Console\Commands\IndexPostsWithElasticSearch;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\PasswordReset::class,
        Commands\CanaryBuildCommand::class,
        CreateIndex::class,
        IndexPostsWithElasticSearch::class,
        DeleteIndex::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('canary-build')->daily();
    }
    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}

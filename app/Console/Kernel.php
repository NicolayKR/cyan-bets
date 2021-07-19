<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\UpdateXmlDb;
use App\Console\Commands\UpdateXmlCrmFile;
use App\Console\Commands\UpdateStatistic;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('update:dbxml')->everyThirtyMinutes()->timezone("Europe/Moscow");
        $schedule->command('update:crmfile')->everyThirtyMinutes()->timezone("Europe/Moscow");
        $schedule->command('update:statistic_shows')->dailyAt('8:00')->timezone("Europe/Moscow");//Накопительная (запускать в 8 утра) 
        $schedule->command('update:statistic')->everyThirtyMinutes()->timezone("Europe/Moscow");
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

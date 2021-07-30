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
        $schedule->command('update:dbxml')->everyMinute()->timezone("Europe/Moscow");
        $schedule->command('update:crmfile')->everyMinute()->timezone("Europe/Moscow");
        $schedule->command('update:statistic_shows')->everyMinute()->timezone("Europe/Moscow");//Накопительная (запускать в 8 утра) 
        $schedule->command('update:statistic')->everyMinute()->timezone("Europe/Moscow");
        $schedule->command('update:balance')->everyMinute()->timezone("Europe/Moscow");
        $schedule->command('update:errors')->everyMinute()->timezone("Europe/Moscow");
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

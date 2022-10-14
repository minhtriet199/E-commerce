<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('command:daily')->withoutOverlapping()->dailyAt('23:50');
        $schedule->command('command:monthly')->withoutOverlapping()->monthly();
        $schedule->command('backup:clean')->daily()->at('00:00');
        $schedule->command('backup:run')->daily()->at('00:00');
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

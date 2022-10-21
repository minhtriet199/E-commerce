<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    // How to use this php artisan ('add 1 command line below here') in termnal
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('command:daily')->withoutOverlapping()->dailyAt('23:50'); // Insert today revenue
        $schedule->command('command:monthly')->withoutOverlapping()->monthly(); // Insert this Month revenue
        $schedule->command('command:DeleteNoti')->withoutOverlapping()->daily(); // Delete old notification
        $schedule->command('backup:clean')->withoutOverlapping()->daily()->at('00:00'); // Delete old backup database file
        $schedule->command('backup:run')->withoutOverlapping()->daily()->at('00:00'); // Backup data base
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

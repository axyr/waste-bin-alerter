<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        $logfile = storage_path('logs/laravel-scheduled-' . now()->format('Y-m-d') . '.log');
        $schedule->command('event:alert')->daily()->between('18:00', '20:00')->everyMinute()->appendOutputTo($logfile);
    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

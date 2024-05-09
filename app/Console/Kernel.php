<?php

namespace App\Console;

use App\Models\Cashier;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    protected function schedule(Schedule $schedule): void
    {
        // $schedule->call(function () {
        //     $oneHourAgo = now()->subMinute();

        //     Cashier::where('status', Cashier::UPLOAD_YOUR_PROOF_PAYMET)
        //         ->where('created_at', '<=', $oneHourAgo)
        //         ->delete();
        // })->everyMinute();
        $schedule->call(function () {
            $threeHoursAgo = now()->subHours(3);

            Cashier::where('status', Cashier::UPLOAD_YOUR_PROOF_PAYMET)
                ->where('created_at', '<=', $threeHoursAgo)
                ->delete();
        })->everyThreeHours();
    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

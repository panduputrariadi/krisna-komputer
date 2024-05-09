<?php

namespace App\Jobs;

use App\Models\Cashier;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ChangeStatusJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $cashier;
    public function __construct(Cashier $cashier)
    {
        $this->cashier = $cashier;
    }

    /**
     * Execute the job.
     */
    public function handle(Cashier $cashier): void
    {
        $upload = $this->cashier;
        $upload->status = Cashier::CHECKING;
        $upload->save();
    }
}

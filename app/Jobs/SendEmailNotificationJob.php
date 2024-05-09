<?php

namespace App\Jobs;

use App\Models\Cashier;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use App\Mail\sendNotificationToCheckingCustomerPayment;

class SendEmailNotificationJob implements ShouldQueue
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
    public function handle(): void
    {
        $adminEmail = 'put.rariadi1144@gmail.com';
        $user = auth()->user();
        $cashier = $this->cashier;

        Mail::to($adminEmail)->send(new sendNotificationToCheckingCustomerPayment($user, $cashier));
    }
}

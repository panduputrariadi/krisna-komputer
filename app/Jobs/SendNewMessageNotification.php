<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Mail\NewMessageNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendNewMessageNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $adminEmail;
    protected $message;

    public function __construct($user, $adminEmail, $message)
    {
        $this->user = $user;
        $this->adminEmail = $adminEmail;
        $this->message = $message;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        Mail::to($this->adminEmail)->send(new NewMessageNotification($this->user, $this->message));
    }
}

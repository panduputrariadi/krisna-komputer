<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Mail\NewMessageNotification;
use App\Models\Message;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class MessagesEmailNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $message;
    public $user;

    public function __construct($user, $message)
    {
        $this->user = $user;
        $this->message = $message;
    }



    public function handle(): void
    {
        $adminEmail = 'put.rariadi1144@gmail.com';

        $user = auth()->user();
        Mail::to($adminEmail)->send(new NewMessageNotification($user, $this->message));
    }
}

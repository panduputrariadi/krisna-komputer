<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewMessageNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $customMessage;

    public function __construct(User $user, Message $message)
    {
        $this->user = $user;
        $this->customMessage = $message;
    }


    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Message Notification',
        );
    }


    public function content(): Content
    {
        return new Content(
            view: 'emails.NewMessageNotificationToAdmin',
        );
    }

    public function attachments(): array
    {
        return [];
    }

    public function build()
    {
        return $this->from($this->user->email, $this->user->name)
                    ->view('emails.NewMessageNotificationToAdmin');
    }
}

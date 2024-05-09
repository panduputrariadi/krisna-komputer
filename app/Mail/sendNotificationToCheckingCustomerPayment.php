<?php

namespace App\Mail;

use App\Models\Cashier;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class sendNotificationToCheckingCustomerPayment extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $payment;


    public function __construct(User $user, Cashier $payment)
    {
        $this->user = $user;
        $this->payment = $payment;
    }


    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Cek Pembayaran Pelanggan',
        );
    }


    public function content(): Content
    {
        return new Content(
            view: 'emails.NewCartNotificationToAdmin',
        );
    }

    public function attachments(): array
    {
        return [];
    }

    public function build()
    {
        return $this->from($this->user->email, $this->user->name)
                    ->view('emails.NewCartNotificationToAdmin');
    }
}

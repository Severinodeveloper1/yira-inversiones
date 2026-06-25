<?php

namespace App\Mail;

use App\Models\Quote;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class QuoteConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Quote $quote) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '✅ Recibimos tu mensaje — ' . config('app.name'),
        );
    }

    public function content(): Content
    {
        return new Content(view: 'emails.quote_confirmation');
    }

    public function attachments(): array { return []; }
}

<?php

namespace App\Mail;

use App\Models\Quote;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class QuoteReceivedAdminMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Quote $quote) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '📩 Nueva Consulta/Cotización — ' . $this->quote->name,
        );
    }

    public function content(): Content
    {
        return new Content(view: 'emails.quote_admin');
    }

    public function attachments(): array { return []; }
}

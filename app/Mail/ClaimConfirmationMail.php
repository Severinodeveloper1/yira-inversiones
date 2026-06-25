<?php

namespace App\Mail;

use App\Models\Claim;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ClaimConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Claim $claim) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '📋 Reclamación Registrada ' . $this->claim->claim_number . ' — ' . config('app.name'),
        );
    }

    public function content(): Content
    {
        return new Content(view: 'emails.claim_confirmation');
    }

    public function attachments(): array { return []; }
}

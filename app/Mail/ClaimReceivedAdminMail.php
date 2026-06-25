<?php

namespace App\Mail;

use App\Models\Claim;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ClaimReceivedAdminMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Claim $claim) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '⚠️ Nueva Reclamación ' . $this->claim->claim_number . ' — ' . $this->claim->fullname,
        );
    }

    public function content(): Content
    {
        return new Content(view: 'emails.claim_admin');
    }

    public function attachments(): array { return []; }
}

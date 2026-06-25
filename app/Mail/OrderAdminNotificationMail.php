<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderAdminNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Order $order)
    {
        $this->order->loadMissing('items');
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '🛒 Nuevo Pedido ' . $this->order->order_number . ' — ' . $this->order->billing_name,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.order_admin_notification',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}

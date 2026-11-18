<?php

namespace App\Mail;

use App\Models\Message;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

/**
 * Tells the site owner about a message sent through the contact form. Replying goes
 * straight to the visitor.
 */
class NewContactMessage extends Mailable
{
    public function __construct(public Message $contact, public string $siteName) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            replyTo: [new Address($this->contact->email, $this->contact->name)],
            subject: "Pesan baru dari {$this->contact->name} – {$this->siteName}",
        );
    }

    public function content(): Content
    {
        return new Content(text: 'mail.contact-message', with: ['adminUrl' => route('messages.index')]);
    }
}

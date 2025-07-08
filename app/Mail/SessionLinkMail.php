<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SessionLinkMail extends Mailable
{
    use Queueable, SerializesModels;

    public $doctorName;
    public $patientName;
    public $meetLink;

    /**
     * Create a new message instance.
     */
    public function __construct($doctorName, $patientName, $meetLink)
    {
        $this->doctorName = $doctorName;
        $this->patientName = $patientName;
        $this->meetLink = $meetLink;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Online Session Details'
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.session_link', // Make sure this view exists
        );
    }

    /**
     * No attachments.
     */
    public function attachments(): array
    {
        return [];
    }
}

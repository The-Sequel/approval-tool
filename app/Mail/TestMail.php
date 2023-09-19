<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $oldProjectStatus;
    public $newProjectStatus;
    public $oldProjectPrio;
    public $newProjectPrio;

    public $name;

    /**
     * Create a new message instance.
     */
    public function __construct($oldProjectStatus, $newProjectStatus, $name)
    {
        $this->oldProjectStatus = $oldProjectStatus;
        $this->newProjectStatus = $newProjectStatus;
        // $this->oldProjectPrio = $oldProjectPrio;
        // $this->newProjectPrio = $newProjectPrio;
        $this->name = $name;

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Test Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.testmail',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}

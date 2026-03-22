<?php

namespace App\Mail;

use App\Models\BriefingSubmission;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BriefingSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public BriefingSubmission $submission) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Novo Briefing: ' . $this->submission->empresa . ' — ' . now()->format('d/m/Y'),
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mail.briefing-submitted',
            with: ['submission' => $this->submission],
        );
    }
}
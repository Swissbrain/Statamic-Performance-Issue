<?php

namespace App\Mail;

use App\Models\Auth\User;
use App\Models\Quote;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Statamic\Facades\GlobalSet;

class QuoteMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Quote $quote)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Ihre Offerten Anfrage #' . $this->quote->makaris_quote_number,
        );
    }

    public function content(): Content
    {
        $statamicGlobalConfig = GlobalSet::find('company')->inCurrentSite();
        return new Content(
            markdown: 'emails.quote',
            with: [
                'email' => $statamicGlobalConfig->get('email'),
                'phone_number' => $statamicGlobalConfig->get('phone_number'),
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}

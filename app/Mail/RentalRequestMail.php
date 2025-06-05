<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Queue\SerializesModels;

class RentalRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(private array $data)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            bcc: ['log@swissbrain.ch', 'msc@kafi.ch'],
            subject: 'Mietanfrage - ' . config('app.name'),
        );
    }

    public function content(): Content
    {
        $replaces = [
            '{vorname}' => $this->data['firstname'],
            '{nachname}' => $this->data['lastname'],
            '{anfragedaten}' => $this->getRequestData(),
            '{morger}' => config('app.name'),
        ];
        return new Content(
            markdown: 'mails.rental-request',
            with: [
                'data' => $this->data,
                'replaces' => $replaces,
            ]
        );
    }

    public function getRequestData(): string
    {
        $data = [
            '**Art der Anfrage:** ' . ($this->data['request_type'] == 'contact' ? 'Telefonischer Kontaktaufnahme' : 'Reservation'),
            '',
            '**Firma / Verein:** ' . $this->data['company'],
            '',
            '**Firmenzusatz:** ' . $this->data['additional'],
            '',
            '**Vorname:** ' .  $this->data['firstname'],
            '',
            '**Nachname:** ' .  $this->data['lastname'],
            '',
            '**Strasse / Nr.:** ' .  $this->data['street'],
            '',
            '**PLZ:** ' .  $this->data['zip_code'],
            '',
            '**Ort:** ' .  $this->data['city'],
            '',
            '**E-Mail:** ' .  $this->data['email'],
            '',
            '**Telefon:** ' .  $this->data['phone'],
            '',
            '**Anlass beginnt am:** ' .  \Carbon\Carbon::parse($this->data['event_start'])->format('d.m.Y'),
            '',
            '**Anlass endet am:** ' .  \Carbon\Carbon::parse($this->data['event_end'])->format('d.m.Y'),
            '',
            '**Tageszeit:** ' . match($this->data['time_of_day']) {
                'morning' => 'Morgen',
                'noon' => 'Mittag',
                'evening' => 'Abend',
                'whole_day' => 'Ganzer Tag',
                default => '',
            },
            '',
            '**Anzahl geladene Gäste:** ' . $this->data['guest_count'],
            '',
            '**Anzahl geladene Gäste:** ' . $this->data['event_place'],
            '',
            '**Beschreibung des Anlasses:** ' . $this->data['description'],
        ];

        return implode("\n", $data);
    }
}

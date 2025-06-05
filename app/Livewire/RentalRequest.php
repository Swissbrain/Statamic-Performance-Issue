<?php

namespace App\Livewire;

use App\Mail\RentalRequestMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Livewire\Component;

class RentalRequest extends Component
{
    public $request_type;
    public $event_start;
    public $event_end;
    public $time_of_day;
    public $guest_count;
    public $company;
    public $additional;
    public $firstname;
    public $lastname;
    public $street;
    public $zip_code;
    public $city;
    public $email;
    public $phone;
    public $description;
    public $event_place;
    public $birthday; // honeypot
    public $successText;

    public $sendSuccessfully = false;


    /*
    |--------------------------------------------------------------------------
    | Hooks
    |--------------------------------------------------------------------------
    */

    public function render(): View
    {
        app()->setLocale('de');
        return view('livewire.rental-request');
    }

    public function rules(): array
    {
        return [
            'request_type' => 'required|string|in:reservation,contact',
            'event_start' => 'date|required|before_or_equal:event_end|after_or_equal:today',
            'event_end' => 'date|required|after_or_equal:event_start|after_or_equal:today',
            'time_of_day' => 'required|string|',
            'guest_count' => 'integer|required|gt:0',
            'event_place' => 'required|string',
            'company' => 'nullable|string',
            'additional' => 'nullable|string',
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'street' => 'required|string',
            'zip_code' => 'integer|required|between:1000,9999',
            'city' => 'required|string',
            'email' => 'email|required',
            'phone' => 'required|string',
            'description' => 'required|string',
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'request_type' => 'Art der Anfrage',
            'event_start' => 'Anlass Startdatum',
            'event_end' => 'Anlass Enddatum',
            'time_of_day' => 'Tageszeit',
            'guest_count' => 'Anzahl Gäste',
            'event_place' => 'Anlass Ort',
            'company' => 'Firma / Verein',
            'additional' => 'Firmenzusatz',
            'firstname' => 'Vorname',
            'lastname' => 'Nachname',
            'street' => 'Strasse',
            'zip_code' => 'PLZ',
            'city' => 'Ort',
            'email' => 'E-Mail',
            'phone' => 'Telefon',
            'description' => 'Anlass Beschreibung',
        ];
    }

    public function submit(): void
    {
        if ($this->birthday) {
            return;
        }

        $validated = $this->validate();

       $this->createSubmission($validated);
       $this->sendEmail($validated);

        $this->sendSuccessfully = true;
    }

    /*
    |--------------------------------------------------------------------------
    | Internals
    |--------------------------------------------------------------------------
    */

    private function createSubmission($data): void
    {
        $form = \Statamic\Facades\Form::find('rental_request');
        $submission = $form->makeSubmission();
        $submission->data($data);
        $submission->id(\DB::table('statamic_form_submissions')->latest()->first()?->id + 1);
        $submission->save();
    }

    private function sendEmail($data): void
    {
        Mail::to($data['email'])->send(new RentalRequestMail($data));
    }
}

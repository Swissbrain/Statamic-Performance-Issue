@component('mail::message')
    <p>Grüezi {{ $quote->first_name }} {{ $quote->last_name }}</p>
    <p>Herzlichen Dank für Ihre Offert-Anfrage für die Jura Maschine {{ $quote->juraMachine()->name }}.</p>
    <p></p>
    <p>Wir bearbeiten Sie schnellstmöglich und melden uns in Kürze bei Ihnen.</p>
    @component('mail::button', ['url' => $quote->publicLink(). '?ref=mail'])
        Offerten-Anfrage anschauen
    @endcomponent
    <p>Bis dahin senden wir Ihnen koffeinstarke Grüsse<br></p>
    <p>{{ config('app.name') }}<br><a href="tel:{{ $phone_number }}">{{ $phone_number }}</a> / <a href="mailto:{{ $email }}">{{ $email }}</a></p>
@endcomponent
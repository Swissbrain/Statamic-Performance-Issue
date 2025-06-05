<x-mail::message>
@php
$mails = \Statamic\Facades\GlobalSet::findByHandle('mails');
$bardContent = $mails->inCurrentSite()->get('mail_request_email_content');
@endphp
<x-markdown-from-bard :bard-content="$bardContent" :replaces="$replaces" />
</x-mail::message>
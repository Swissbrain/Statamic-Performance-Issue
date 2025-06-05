@props(['value'])

@if(trim(strtolower($value)) === 'ja')
    <flux:icon.check class="text-green-600 inline" />
@elseif(trim(strtolower($value)) === 'nein')
    <flux:icon.x-mark class="text-red-600 inline" />
@else
    {{ $value }}
@endif
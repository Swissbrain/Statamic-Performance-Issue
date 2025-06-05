@extends('layouts.site')

@section('content')
    @livewire('quote-configurator', ['juraMachineId' => $juraMachine->id, 'quote' => $quote])
@endsection
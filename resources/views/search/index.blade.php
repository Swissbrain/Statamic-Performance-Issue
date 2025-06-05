@extends('layouts.site')

@section('content')
    <x-section container class="my-12">
        <div class="space-y-12">
            <h1 @class([
                'text-2xl uppercase text-center',
                "after:content-[''] after:block after:border-b-2 after:w-[75px] after:pt-1 after:border-primary",
                'after:mx-auto',
            ])>{{ config('app.name') }} durchsuchen</h1>

            <form action="{{ route('search.index') }}" class="my-6 max-w-xl mx-auto">
                <flux:input.group>
                    <flux:input type="text" name="q" placeholder="Suchen..." :value="Statamic::modify(request()->input('q'))->strip_tags()" autofocus clearable />
                    <flux:button type="submit" icon="magnifying-glass" variant="primary">Suchen</flux:button>
                </flux:input.group>
            </form>

            @if(request()->input('q'))
                <statamic:search:results
                        index="default"
                        as="results"
                >
                    <div class="space-y-6">
                        @forelse ($results as $result)
                            <a href="{{ $result->url }}" class="block hover:bg-primary/5 p-3 rounded-lg">
                                <h2 class="font-semibold text-lg mb-1">{{ $result->title }}</h2>
                                <p class="opacity-80">
                                    @if(in_array($result->getSearchable()?->collection?->handle, ['jura_professional', 'jura_household']))
                                        {{ Statamic::modify($result->description['wysiwyg'])->safe_truncate(200)->strip_tags() }}
                                    @else
                                        {{ Statamic::modify($result->description)->safe_truncate(200)->strip_tags() }}
                                    @endif
                                </p>
                                <p class="mt-3 text-gray-400 text-xs">{{ url($result->url) }}</p>
                            </a>
                        @empty
                            <div class="text-center">
                            <flux:icon.question-mark-circle class="size-24 text-primary/30 mx-auto mb-6" />
                            <div>Kein Ergebnis gefunden mit: <b>{{ request()->get('q') }}</b></div>
                            </div>
                        @endforelse
                    </div>
                </statamic:search:results>
            @endif
        </div>
    </x-section>
@endsection
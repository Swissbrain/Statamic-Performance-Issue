@foreach (Statamic::tag('nav:bottom')->params(['include_home' => true])->sort('order')->fetch() as $entry)
    <div class="flex flex-col justify-start">
        <p class="text-2xl font-bold">
            {{ $entry['title']->value() }}
        </p>
        <ul class="flex flex-col gap-2">
            @foreach ($entry['children'] as $child)
                <li>
                    <a href="{{ $child['url']->value() }}" class="hover:underline">
                        {{ $child['title']->value() }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endforeach

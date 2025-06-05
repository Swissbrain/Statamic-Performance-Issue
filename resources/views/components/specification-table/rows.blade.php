@props(['items' => []])

@foreach($items as $item)
    <flux:rows>
        @foreach($item['cells'] as $cell)
            @if($loop->first)
                <flux:column>
                    <x-specification-table.cell :value="$cell" />
                </flux:column>
            @else
                <flux:cell :align="$loop->last ? 'end' : 'center'">
                    <x-specification-table.cell :value="$cell" />
                </flux:cell>
            @endif
        @endforeach
    </flux:rows>
@endforeach
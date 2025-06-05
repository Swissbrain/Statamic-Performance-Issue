<x-section :block="$block" :container="true" :show-border="$blocks->show_space_bordering">
    <div class="flex flex-wrap gap-12 w-full">
        @foreach($columns as $column)
            <div @class([
                'w-full',
                match($column->column_size->value()) {
                    '1/2' => 'md:w-1/2-gap-12',
                    '1/3' => 'md:w-1/3-gap-12',
                    '2/3' => 'md:w-2/3-gap-12',
                    '1/4' => 'md:w-1/4-gap-12',
                    '2/4' => 'md:w-2/4-gap-12',
                    '3/4' => 'md:w-3/4-gap-12',
                    default => 'md:w-1/2-gap-12',
                },
                'my-auto' => $column->column_vertical_align->value() == 'center',
                'mt-auto' => $column->column_vertical_align->value() == 'bottom',
            ])>
                <x-dynamic.sub-content-bulider :blocks="$column" :column-count="count($columns->value())" :page="$blocks" />
            </div>
        @endforeach
    </div>
</x-section>

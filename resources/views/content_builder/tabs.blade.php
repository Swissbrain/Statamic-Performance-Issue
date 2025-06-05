<x-section :block="$block" :container="true" :show-border="$blocks->show_space_bordering">
    <flux:tab.group>
        <flux:tabs>
            @foreach($tabs as $index => $tab)
                <flux:tab name="tab-{{ $index }}">
                    {{ $tab->tab_title }}
                </flux:tab>
            @endforeach
        </flux:tabs>

        @foreach($tabs as $index => $tab)
            <flux:tab.panel name="tab-{{ $index }}">
                <x-dynamic.sub-content-bulider override="tab_content_builder" :blocks="$tab" override="tab_content_builder" :page="$blocks" />
            </flux:tab.panel>
        @endforeach
    </flux:tab.group>
</x-section>
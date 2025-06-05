<script>
import HasInputOptions from '../../../../vendor/statamic/cms/resources/js/components/fieldtypes/HasInputOptions.js'
import Fuse from 'fuse.js'
export default {
    mixins: [Fieldtype, HasInputOptions],
    template: `<div>
       <div class="flex">
            <v-select :options="options"
                      :searchable="true"
                      :filter="fuseSearch"
                      :disabled="isDisabled"
                      @input="vueSelectUpdated"
                      class="flex-1"
                      append-to-body
                      :get-option-label="(option) => getOptionLabel(option)"
                      :value="value">

                <template #option="{ name, image, number, price }">
                    <div class="flex justify-between">
                        <div class="flex gap-3 items-center">
                            <div v-if="image" class="w-12 h-12 bg-center bg-no-repeat" v-bind:style="{ backgroundImage: 'url(' + image + ')', backgroundSize: 'contain'}"></div>
                            <div v-else class="w-12 aspect-square"></div>
                            <div>
                                <div v-text="name" class=""></div>
                                <div v-text="number" class="font-semibold text-gray-600 text-xs"></div>
                            </div>
                        </div>
                        <div v-text="price" class="text-gray-600"></div>
                    </div>
                </template>
            </v-select>
        </div>
</div>`,
    computed: {
        options() {
            return this.meta.articles;
        },
        isDisabled() {
            return this.config.disable_editing === true && this.meta.entry_id !== null
        },
    },
    methods: {
        getOptionLabel(option) {
            if (option.number) {
                return option.number + ' | ' + option.name;
            }

            let _option = this.options.filter((item) => item.number === option)[0];

            if (_option.number) {
                return _option.number + ' | ' + _option.name;
            }

            return '';
        },
        vueSelectUpdated(value) {
            if (value.number) {
                this.update(value.number)
            } else {
                this.update(null);
            }
        },
        fuseSearch(options, search) {
            const fuse = new Fuse(options, {
                keys: ['name', 'number'],
                shouldSort: true,
            })
            return search.length
                ? fuse.search(search).map(({ item }) => item)
                : fuse.list
        },
    }
};
</script>
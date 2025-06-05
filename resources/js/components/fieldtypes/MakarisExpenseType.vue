<script>
import Fuse from 'fuse.js'
export default {
    mixins: [Fieldtype],
    template: `<div>
        <div class="flex">
            <v-select :options="options"
                      :searchable="true"
                      :filter="fuseSearch"
                      @input="vueSelectUpdated"
                      class="flex-1"
                      append-to-body
                      :get-option-label="(option) => getOptionLabel(option)"
                      :value="value">

                <template #option="{ id, name, title, description, price }">
                    <div class="flex gap-3 items-center justify-between">
                        <div>
                            <div v-text="name + ' | ' + title" class=""></div>
                            <div v-text="description" class="font-semibold text-gray-600 text-xs"></div>
                        </div>
                        <div v-text="price" class="text-gray-600"></div>
                    </div>
                </template>
            </v-select>
        </div>
</div>`,
    computed: {
        options() {
            return this.meta.expenseTypes;
        },
    },
    methods: {
        getOptionLabel(option) {
            if (option.id) {
                return option.id + ' | ' + option.title;
            }

            let _option = this.options.filter((item) => item.id === option)[0];

            if (_option.id) {
                return _option.name + ' | ' + _option.title;
            }

            return '';
        },
        vueSelectUpdated(value) {
            if (value.id) {
                this.update(value.id);
            } else {
                this.update(null);
            }
        },
        fuseSearch(options, search) {
            const fuse = new Fuse(options, {
                keys: ['id', 'title', 'description'],
                shouldSort: true,
            })
            return search.length
                ? fuse.search(search).map(({ item }) => item)
                : fuse.list
        },
    }
};
</script>
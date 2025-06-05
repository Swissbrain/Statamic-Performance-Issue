<script>
import HasInputOptions from '../../../../vendor/statamic/cms/resources/js/components/fieldtypes/HasInputOptions.js'
import Fuse from 'fuse.js'
export default {
    mixins: [Fieldtype, HasInputOptions],
    template: `<div>
       <div class="flex gap-6 flex-wrap">
           <a v-for="imageUrl in images" v-bind:href="imageUrl" target="_blank" class="block" style="max-width: 100px">
               <img v-bind:src="imageUrl" alt="">
           </a>
       </div>
</div>`,
    computed: {
        images() {
            return this.meta.images;
        },
    },
};
</script>
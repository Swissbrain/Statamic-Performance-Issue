<script>
export default {
    mixins: [Fieldtype],
    template: `<div class="">
        <img v-if="data.image" v-bind:src="data.image" v-bind:alt="data.name" class="mb-3 mx-auto " v-bind:style="{ maxHeight: '10rem' }" />
        <div v-text="data.name" class="text-2xl font-semibold mb-6 text-center"></div>
        <div class="text-sm flex space-y-3 flex-wrap">
            <div class="flex justify-between w-full">
                <div class="font-semibold">Produkt-Nr.</div>
                <div v-text="data.number"></div>
            </div>
            <div class="flex justify-between w-full">
                <div class="font-semibold">Preis</div>
                <div><span v-text="data.price"></span> CHF</div>
            </div>
            <div class="flex justify-between w-full">
                <div class="font-semibold">Vertriebskanal</div>
                <div v-text="data.distribution_channel" class="uppercase"></div>
            </div>
        </div>
        <a v-bind:href="data.makaris_link" class="mt-6 btn w-full" target="_blank">In makaris öffnen <svg-icon name="light/external-link" class="ml-2 h-3" /></a>
        <a v-if="data.distribution_channel === 'B2C'" v-bind:href="data.shop_link" class="mt-3 btn w-full" target="_blank">Im Shop öffnen <svg-icon name="light/external-link" class="ml-2 h-3" /></a>
</div>`,
    computed: {
        data: function() {
            return this.meta;
        }
    }
}
</script>
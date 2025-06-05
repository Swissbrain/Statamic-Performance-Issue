<script>
import Fuse from 'fuse.js'
export default {
    mixins: [Fieldtype],
    template: `<div class="help-block" style="margin-top: -24px;">{{ meta.description }}</div>`,
}
</script>
/**
 * When extending the control panel, be sure to uncomment the necessary code for your build process:
 * https://statamic.dev/extending/control-panel
 */

/** Example Fieldtype

import ExampleFieldtype from './components/fieldtypes/ExampleFieldtype.vue';

Statamic.booting(() => {
    Statamic.$components.register('example-fieldtype', ExampleFieldtype);
});

*/

import MakarisProduct from "./components/fieldtypes/MakarisProduct.vue";
import MakarisProductInfo from "./components/fieldtypes/MakarisProductInfo.vue";
import MakarisExpenseType from "./components/fieldtypes/MakarisExpenseType.vue";
import MakarisActivity from "./components/fieldtypes/MakarisActivity.vue";
import GridAlignment from "./components/fieldtypes/GridAlignment.vue";
import BackendText from "./components/fieldtypes/BackendText.vue";
import MakarisProductImagePreview from "./components/fieldtypes/MakarisProductImagePreview.vue";

Statamic.booting(() => {
    Statamic.$components.register('makaris_product-fieldtype', MakarisProduct);
    Statamic.$components.register('makaris_product_info-fieldtype', MakarisProductInfo);
    Statamic.$components.register('makaris_expense_type-fieldtype', MakarisExpenseType);
    Statamic.$components.register('makaris_activity-fieldtype', MakarisActivity);
    Statamic.$components.register('grid_alignment-fieldtype', GridAlignment);
    Statamic.$components.register('backend_text-fieldtype', BackendText);
    Statamic.$components.register('makaris_product_image_preview-fieldtype', MakarisProductImagePreview);
});

Statamic.$conditions.add('isEditing', ({ root }) => {
    return root.id !== null && root.id !== undefined && root.id > 0;
});

Statamic.$conditions.add('isCreating', ({ root }) => {
    return root.id === null || root.id === undefined;
});

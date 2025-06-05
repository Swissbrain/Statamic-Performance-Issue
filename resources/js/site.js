/*
|--------------------------------------------------------------------------
| Import CSS
|--------------------------------------------------------------------------
 */
import 'swiper/css/bundle';

/*
|--------------------------------------------------------------------------
| Import JS
|--------------------------------------------------------------------------
 */
import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';
import Swiper from "swiper";
import {Autoplay, EffectFade, Navigation, Pagination} from 'swiper/modules';
import pureParallax from './pureParallax/pureParallax.min.js';

/*
|--------------------------------------------------------------------------
| Initialize JS
|--------------------------------------------------------------------------
 */
Swiper.use([Autoplay, Navigation, Pagination, EffectFade]);
window.Swiper = Swiper;

pureParallax({});


/*
|--------------------------------------------------------------------------
| Import Alpine Plugins
|--------------------------------------------------------------------------
 */
import anchor from '@alpinejs/anchor'
import collapse from '@alpinejs/collapse'
import focus from '@alpinejs/focus'
import morph from '@alpinejs/morph'
import persist from '@alpinejs/persist'
import precognition from 'laravel-precognition-alpine';
/*
|--------------------------------------------------------------------------
| Initialize Alpine Plugins
|--------------------------------------------------------------------------
 */
Alpine.plugin([anchor, collapse, precognition, focus, morph]);

Livewire.start();

/*
|--------------------------------------------------------------------------
| Import Fancybox
|--------------------------------------------------------------------------
 */
import { Fancybox } from "@fancyapps/ui";
import "@fancyapps/ui/dist/fancybox/fancybox.css";

Fancybox.bind("[data-fancybox]", {
    //
});
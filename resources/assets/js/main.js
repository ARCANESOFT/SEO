/**
 * Register Vue components...
 */

import SeoLengthCounter from './components/SeoLengthCounter.vue';

const SeoPlugins = {
    install(Vue, options) {
        Vue.component(SeoLengthCounter.name, SeoLengthCounter);
    }
};

export default SeoPlugins;

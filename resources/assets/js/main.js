/**
 * Register Vue components...
 */

import SeoLengthCounter from './components/SeoLengthCounter.vue';
import SeoKeywordTags from './components/SeoKeywordTags.vue';

const SeoPlugins = {
    install(Vue, options) {
        Vue.component(SeoLengthCounter.name, SeoLengthCounter);
        Vue.component(SeoKeywordTags.name, SeoKeywordTags);
    }
};

export default SeoPlugins;

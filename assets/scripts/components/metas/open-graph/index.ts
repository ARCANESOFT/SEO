import { defineComponent, PropType } from 'vue'

type OpenGraphMetaType = {
    //
}

export default defineComponent({
    name: 'v-seo-metas-open-graph',
    props: {
        value: {
            type: Object as PropType<OpenGraphMetaType>,
            default: () => ({}),
        },
    },
    setup() {
        //

        return {
            //
        }
    },
    template: `
        <div class="row row-cols-1 g-3">
            <div class="col">
            </div>
        </div>
    `,
})

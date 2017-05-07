<script>
    export default {
        name: 'seo-keyword-tags',

        props: {
            name: {
                type: String,
                required: true
            },

            selected: {
                type: Array,
                'default': []
            },

            placeholder: {
                type: String,
                'default': 'Add keywords'
            }
        },

        data() {
            return {
                //
            };
        },

        mounted() {
            $(`select[name="${this.name}"]`).select2({
                tags: true,
                createTag: function (params) {
                    return {
                        id: params.term,
                        text: params.term,
                        newOption: true
                    }
                }
            });
        }
    }
</script>

<template>
    <select :name="name"
            class="form-control"
            multiple="multiple"
            :data-placeholder="placeholder">
        <option v-for="value in selected" :value="value" selected>{{ value }}</option>
    </select>
</template>

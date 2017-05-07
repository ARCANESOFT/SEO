<script>
    export default {
        name: 'seo-length-counter',

        props: {
            'type': {
                type: String,
                'default': 'text'
            },

            'name': {
                type: String,
                required: true
            },

            'value': {
                type: String,
                required: true
            },

            'inputClass': {
                type: String,
                'default': 'form-control'
            },

            'placeholder': {
                type: String,
                'default': ''
            },

            'min': {
                type: Number,
                'default': 50 // Min: title = 50, description = 150
            },

            'max': {
                type: Number,
                'default': 60 // Max: title = 60, description = 160
            }
        },

        data() {
            return {
                content: ''
            }
        },

        created() {
            this.content = this.value;
        },

        computed: {
            contentLength() {
                return this.content.length;
            },

            counterClass() {
                return {
                    'label-danger': this.isDanger(),
                    'label-success': this.isSuccess(),
                    'label-warning': this.isWarning()
                };
            },

            progressClass() {
                return {
                    'progress-bar-danger': this.isDanger(),
                    'progress-bar-success': this.isSuccess(),
                    'progress-bar-warning': this.isWarning()
                }
            },

            progressWidth() {
                let width = Math.round((this.contentLength / this.max) * 100);

                return width > 100 ? 100 : width;
            }
        },

        methods: {
            isWarning() {
                return this.contentLength < this.min;
            },

            isSuccess() {
                return this.contentLength >= this.min && this.contentLength <= this.max;
            },

            isDanger() {
                return this.contentLength > this.max;
            }
        }
    }
</script>

<template>
    <div class="seo-input-group">
        <input v-if="type == 'text'"
               type="text"
               v-model="content"
               :name="name"
               :placeholder="placeholder"
               :class="inputClass">

        <textarea v-if="type == 'textarea'"
                  v-model="content"
                  :name="name"
                  :placeholder="placeholder"
                  :class="inputClass"></textarea>

        <div class="progress progress-sm">
            <div role="progressbar"
                 class="progress-bar"
                 aria-valuemin="0"
                 style="font-size: 9px; line-height: 10px;"
                 :aria-valuenow="contentLength"
                 :aria-valuemax="max"
                 :class="progressClass"
                 :style="`width: ${progressWidth}%`">
                {{ contentLength }}
            </div>
        </div>
    </div>
</template>

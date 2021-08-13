<template>
    <modal :show="show" :max-width="maxWidth" :closeable="closeable" @close="close">
        <div class="px-6 py-4" style="background-color: #192231">
            <div class="text-lg text-white text-opacity-90">
                <slot name="title">
                </slot>
            </div>

            <div class="mt-4 text-white text-opacity-50">
                <slot name="content">
                </slot>
            </div>
        </div>

        <div class="px-6 py-4 bg-gray-900 text-right">
            <slot name="footer">
            </slot>
        </div>
    </modal>
</template>

<script>
    import Modal from './Modal'

    export default {
        emits: ['close'],

        components: {
            Modal,
        },

        props: {
            show: {
                default: false
            },
            maxWidth: {
                default: '2xl'
            },
            closeable: {
                default: true
            },
        },

        methods: {
            close() {
                this.$emit('close')
            },
        }
    }
</script>

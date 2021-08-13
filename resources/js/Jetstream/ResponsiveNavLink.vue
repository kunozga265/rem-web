<template>
    <div>
        <button :class="classes" class="w-full text-left" v-if="as == 'button'">
            <slot></slot>
        </button>

        <inertia-link :href="href" :class="classes" v-else>
            <slot></slot>
        </inertia-link>
    </div>
</template>

<script>
    export default {
        props: ['active', 'href', 'as'],

        computed: {
            classes() {
                return this.active
                            ? 'block pl-3 pr-4 py-2 border-l-4 border-indigo-400 text-base font-medium text-white text-opacity-90 focus:outline-none  focus:border-indigo-700 transition'
                            : 'block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-white hover:text-opacity-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:border-gray-300 transition'
            }
        }
    }
</script>

<template>
    <div class="py-4 border-t border-gray-700">
        <div v-if="event.status==2" class="float-right hidden sm:block">
            <button class="px-4 py-2 rounded text-xs text-white text-opacity-90 font-bold bg-indigo-500 hover:bg-indigo-400 transition" @click="causesDialog=true">Causes</button>
            <button class="ml-2 px-4 py-2 rounded text-xs text-white text-opacity-90 font-bold bg-indigo-500 hover:bg-indigo-400 transition" @click="solutionsDialog=true">Solutions</button>
        </div>
        <p v-if="event.status==0" class="text-xl text-red-500 font-bold">OFF</p>
        <p v-else-if="event.status==1" class="text-xl text-green-500 font-bold">Normal</p>
        <div v-else>
            <span class="text-xl text-yellow-500 font-bold">Fault</span>
            <span class="ml-1 text-xs text-yellow-500 font-black ">- {{event.error.code}}</span>
            <p class="text-sm text-white text-opacity-70">{{event.error.name}}</p>
        </div>
        <div class="text-xs text-white text-opacity-50">
            <p>{{event.start_time}} - {{event.end_time}}</p>
        </div>
        <div v-if="event.status==2" class="mt-4 block sm:hidden">
            <button class="px-4 py-2 rounded text-xs text-white text-opacity-90 font-bold bg-indigo-500 hover:bg-indigo-400 transition" @click="causesDialog=true">Causes</button>
            <button class="ml-2 px-4 py-2 rounded text-xs text-white text-opacity-90 font-bold bg-indigo-500 hover:bg-indigo-400 transition" @click="solutionsDialog=true">Solutions</button>
        </div>

        <modal :show="causesDialog" @close="closeModal" v-if="event.error != null">
            <template #title>
                Possible Causes
            </template>

            <template #content>
                <ul class="list-disc px-6">
                    <div v-html="event.error.causes"></div>
                </ul>

            </template>

            <template #footer>
                <button class="px-4 py-2 rounded text-xs text-white text-opacity-90 font-bold bg-indigo-500 hover:bg-indigo-400 transition" @click="closeModal">Cancel</button>
            </template>
        </modal>

        <modal :show="solutionsDialog" @close="closeModal" v-if="event.error != null">
            <template #title>
                Solutions
            </template>

            <template #content>
                <ul class="list-disc px-6">
                    <div v-html="event.error.solution"></div>
                </ul>

            </template>

            <template #footer>
                <button class="px-4 py-2 rounded text-xs text-white text-opacity-90 font-bold bg-indigo-500 hover:bg-indigo-400 transition" @click="closeModal">Cancel</button>
            </template>
        </modal>
    </div>
</template>

<script>
import modal from '@/Jetstream/DialogModal'
import secondaryButton from '@/Jetstream/SecondaryButton'

export default {
    name: "event",
    props:["event"],
    data:()=>({
        causesDialog:false,
        solutionsDialog:false,
    }),

    components:{
        modal,
        secondaryButton
    },
    methods:{
        closeModal(){
            this.causesDialog=false
            this.solutionsDialog=false
        }
    }
}
</script>

<style scoped>

</style>

<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-8 md:py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class=" ">
<!--                    <welcome />-->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="overflow-hidden shadow-xl sm:rounded-lg md:col-span-3" style="background-color: #192231; min-height:524px">
                            <div class="p-10 md:p-16">
                                <p class="text-3xl md:text-4xl text-white text-opacity-90  font-bold">The Polytechnic Lift</p>
                                <p class="text-base md:text-lg text-white text-opacity-50">Ginnery Corner, Blantyre</p>
                                <div class=" mt-2" v-if="status!=null">
                                    <p v-if="status==0" class="p-2 text-base text-center text-red-100 font-bold bg-red-500 rounded "  style="width: 120px">OFF</p>
                                    <p v-else-if="status==1" class="p-2  text-base text-center  text-green-100 font-bold bg-green-500 rounded " style="width: 120px">Normal</p>
                                    <p v-else class="p-2  text-base text-center text-yellow-100 font-bold bg-yellow-500 rounded " style="width: 120px">Fault</p>
                                </div>

                            </div>
                            <g-map-map
                                class="w-full h-96 md:h-full"
                                map-type-id="terrain"
                                :center="center"
                                :zoom="15"
                            >
                                <g-map-cluster>
                                    <g-map-marker :position="center"
                                    ></g-map-marker>
                                </g-map-cluster>
                            </g-map-map>
                        </div>
                        <div class="p-6">
                            <p class="pb-4 text-white text-opacity-50 text-xl <!--border-b border-gray-700-->">Recent Events</p>
                            <div class="mb-6" v-if="events.length>0">
                                <div
                                    v-for="event in events"
                                     :key="event.id"
                                >
                                    <div class="py-4 border-t border-gray-700">
                                        <p v-if="event.status==0" class="text-xl text-red-500 font-bold">OFF</p>
                                        <p v-else-if="event.status==1" class="text-xl text-green-500 font-bold">Normal</p>
                                        <div v-else>
                                            <span class="text-xl text-yellow-500 font-bold">Fault</span>
                                            <span class="ml-1 text-xs text-yellow-500 font-black ">- {{event.fault.code}}</span>
                                            <p class="text-sm text-white text-opacity-70">{{event.fault.name}}</p>
                                        </div>
                                        <div class="text-xs text-white text-opacity-50">
                                            <p>{{event.start_time}} - {{event.end_time}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <inertia-link :href="route('events')">
                              <span class="px-4 py-2 rounded text-xs text-white text-opacity-90 font-bold bg-indigo-500 hover:bg-indigo-400 transition">View All</span>
                            </inertia-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'

    export default {
        props:['statusInfo','eventsData'],
        data:()=>({
            status:null,
            events:[],
            center:{
                lat:-15.801473,
                lng:35.027394
            }
        }),
        created() {
            this.status=this.statusInfo
            this.events=this.eventsData.data

            Echo.channel('events').listen('ActivityEvent',(data)=>{
                this.status=data.event.status

                let tempArray=[]
                tempArray.push(data.event)

                if (this.events.length>0){
                    this.events[0].end_time=data.event.start_time
                }

                for(let index in this.events){
                    tempArray.push(this.events[index])
                }

                this.events=tempArray.slice(0,7)
            })
        },

        components: {
            AppLayout,
        },
    }
</script>

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
                        <div class="overflow-hidden shadow-xl sm:rounded-lg md:col-span-3" style="background-color: #192231">
                            <div class="p-10 md:p-16">
                                <p class="text-3xl md:text-4xl text-white text-opacity-90  font-bold">The Polytechnic Lift</p>
                                <p class="text-base md:text-lg text-white text-opacity-50">Ginnery Corner, Blantyre</p>
                                <div class=" mt-2" >
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
                            <div class="mb-6">
                                <div v-for="event in events"
                                     :key="event.id"
                                >
                                    <div class="py-4 border-t border-gray-700">
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
                                    </div>
                                </div>
                            </div>

                            <inertia-link :href="route('events')">
                              <span class="px-4 py-2 rounded text-xs text-white text-opacity-90 font-bold bg-indigo-500 hover:bg-indigo-400 transition">View All</span>
                            </inertia-link>
                        </div>
                    </div>



<!--                    <div id="chart" class="p-6 bg-gray-50 border-t border-gray-200">-->
<!--&lt;!&ndash;                        <apexchart type="rangeBar" height="350" :options="chartOptions" :series="series"></apexchart>&ndash;&gt;-->
<!--                    </div>-->
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Welcome from '@/Jetstream/Welcome'


    import VueApexCharts from 'vue3-apexcharts'
    //import {GoogleMap,Marker} from 'vue3-google-map'


    export default {
        props:['latest_event','eventsData','normal_series','off_series','fault_series'],
        data:()=>({
            status:null,
            events:[],
            series:[],
            chartOptions: {

                chart: {
                    height: 350,
                    type: 'rangeBar',
                    zoom:{enabled:true},
                    toolbar:{show:false}
                },
                plotOptions: {
                    bar: {
                        horizontal: true,
                        barHeight: '50%',
                        rangeBarGroupRows: true
                    }
                },
                colors: [
                    "#34D399", "#F87171", "#FBBF24", "#1B998B", "#FF4560", "#775DD0",
                    "#3F51B5", "#546E7A", "#D4526E", "#8D5B4C", "#F86624",
                    "#008FFB", "#2E294E", "#F46036", "#E2C044"
                ],
                fill: {
                    type: 'solid'
                },
                xaxis: {
                    type: 'datetime',
                    tickPlacement:'on'
                },
                yaxis:{
                  show:false
                },
                legend: {
                    position: 'bottom'
                    // show:false
                },
                tooltip: {
                    x:{
                        label:false,
                        format:'dd/MMM/yy HH:mm'
                    }
                    // custom: function(opts) {
                    //     const fromYear = new Date(opts.y1).getFullYear()
                    //     const toYear = new Date(opts.y2).getFullYear()
                    //     const values = opts.ctx.rangeBar.getTooltipValues(opts)
                    //
                    //     return (
                    //         fromYear
                    //     )
                    // }
                }
            },
            center:{
                lat:-15.801473,
                lng:35.027394
            }
        }),
        created() {
            this.status=this.latest_event.status
            this.events=this.eventsData.data

            // this.series=[
            //     // ON Data
            //     {
            //         name: 'NORMAL',
            //         data: this.normal_series
            //     },
            //     // OFF Data
            //     {
            //         name: 'OFF',
            //         data: this.off_series
            //     },
            //     // FAULT Data
            //     {
            //         name: 'FAULT',
            //         data: this.fault_series
            //     }
            // ]

            Echo.channel('events').listen('ActivityEvent',(data)=>{
                console.log(data)
                this.status=data.event.status

                var tempArray=[]
                tempArray.push(data.event)
                this.events[0].end_time=data.event.start_time
                for(let index in this.events){
                    tempArray.push(this.events[index])
                }
                this.events=tempArray.slice(0,7)
            })
        },

        components: {
            AppLayout,
            Welcome,
            apexchart: VueApexCharts,
            //GoogleMap,
            // Marker
        },
        methods:{
            click(){
                console.log("Clicked")
            }
        }

    }
</script>

<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl leading-tight">
                Events
            </h2>
        </template>

        <div class="py-8 md:py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="">
                        <div class="px-6 py-10 sm:px-8 md:p-12 overflow-hidden shadow-xl sm:rounded-lg " style="background-color: #192231">
                            <!--<div id="chart" class="">
                                <apexchart type="rangeBar" height="350" :options="chartOptions" :series="series"></apexchart>
                            </div>-->
                            <div class="pb-4">
                                <span class="pr-1 text-sm text-white text-opacity-70 font-bold">
                                    Filter:
                                </span>
                                <span class="px-1">
                                    <input type="checkbox" v-model="options.off" id="off" class="text-indigo-500"/>
                                    <label for="off" class="px-2 text-sm text-white text-opacity-50 font-bold">OFF</label>
                                </span>

                                <span class="px-1">
                                    <input type="checkbox" v-model="options.normal" id="normal" class="text-indigo-500"/>
                                    <label for="normal" class="px-2 text-sm text-white text-opacity-50 font-bold">Normal</label>
                                </span>

                                <span class="px-1">
                                    <input type="checkbox" v-model="options.fault" id="fault" class="text-indigo-500"/>
                                    <label for="fault" class="px-2 text-sm text-white text-opacity-50 font-bold">Fault</label>
                                </span>

                            </div>
                            <event v-for="event in filteredEvents"
                                   :key="event.id"
                                   :event="event"
                            >

                            </event>
                        </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    // import VueApexCharts from 'vue3-apexcharts'
    import Event from "@/components/Event";

    export default {
        props:['eventsData'],
        data:()=>({
            events:[],
            options:{
                off:true,
                normal:true,
                fault:true,
            },

            /*series:[],
            chartOptions: {

                chart: {
                    height: 350,
                    type: 'rangeBar',
                    zoom:{enabled:true},
                    toolbar:{show:true}
                },
                plotOptions: {
                    bar: {
                        horizontal: true,
                        barHeight: '50%',
                        rangeBarGroupRows: true
                    }
                },
                colors: [
                    "#F87171", "#34D399", "#FBBF24", "#1B998B", "#FF4560", "#775DD0",
                    "#3F51B5", "#546E7A", "#D4526E", "#8D5B4C", "#F86624",
                    "#008FFB", "#2E294E", "#F46036", "#E2C044"
                ],
                fill: {
                    type: 'solid'
                },
                xaxis: {
                    type: 'datetime',
                    tickPlacement:'on',
                    labels: {
                        style:
                            {
                                colors: "rgba(255,255,255,.5)",
                                fontWeight:400
                            }
                    },
                    axisBorder: {
                        color: "rgba(255,255,255,.2)",
                    }
                },
                yaxis:{
                    show:false,
                    axisBorder: {
                        color: "rgba(255,255,255,.2)",
                    }


                },
                legend: {
                    position: 'bottom',
                    labels: {colors: "rgba(255,255,255,.5)"},
                    // show:false
                    markers:{
                        onClick: function(chart, seriesIndex, opts) {
                            // this.filterEvents(seriesIndex)
                            // this.status=seriesIndex
                        }
                        },
                },
                grid:{
                  borderColor:"rgba(255,255,255,.2)"
                },
                tooltip: {
                    x:{
                        label:false,
                        format:'MMM  dd, yyyy HH:mm'
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
            },*/
        }),
        created() {
            this.events=this.eventsData.data
           /* let series=this.eventsData.data
            let offSeries=[]
            let normalSeries=[]
            let faultSeries=[]
            let now=new Date().getTime()

            for (let index in series){
                if(series[index].status==0){
                    offSeries.push({
                        x: 'OFF',
                        y: [
                            (series[index].start_time)*1000,
                            (series[index].end_time?series[index].end_time:now)*1000
                        ]
                    })
                }
            }

            this.series=[
                // OFF Data
                {
                    name: 'OFF',
                    data: offSeries
                },
                // ON Data
                {
                    name: 'NORMAL',
                    data: normalSeries
                },
                // FAULT Data
                {
                    name: 'FAULT',
                    data: faultSeries
                }
            ]*/

        },

        components: {
            AppLayout,
            // apexchart: VueApexCharts,
            Event
        },
        computed:{
            filteredEvents(){
                let filtered=[]
                for(let index in this.events){
                    if(this.events[index].status==0 && this.options.off){
                        filtered.push(this.events[index])
                    }else if(this.events[index].status==1 && this.options.normal){
                        filtered.push(this.events[index])
                    }else if(this.events[index].status==2 && this.options.fault){
                        filtered.push(this.events[index])
                    }
                }
                return filtered
            }
        },
        methods:{
            filterEvents(index){
                switch (index) {
                    case 0:
                        this.options.off=!this.options.off
                        break
                    case 1:
                        this.options.normal=!this.options.normal
                        break
                    default:
                        this.options.fault=!this.options.fault
                        break
                }
            }
        }

    }
</script>

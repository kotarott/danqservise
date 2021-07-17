<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                分析：結果
            </h2> 
        </template>
        
        <div v-for="(answer, title) in answers" :key="title">
            <div class="py-2">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <select 
                        v-model="chartType"
                        name=""
                        id="privacy" 
                        class="mt-1 block w-full form-input rounded-md shadow-sm"
                    >
                        <option disable value="">チャートの種類</option>
                        <option value="BarChart">BarChart</option>
                        <option value="ColumnChart">ColumnChart</option>
                        <option value="PieChart">PieChart</option>
                    </select>
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        {{ title }}<br>
                        <GChart :type="chartType" :data="mod_data(answer)" :options="makeOption(title)" />
                    </div>
                </div>
            </div>
        </div>

    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import moment from 'moment'
    import JetDialogModal from '@/Jetstream/DialogModal'
    import { GChart } from "vue3-googl-chart";

    export default {
        props: ['answers'],
        data() {
            return {
                chartType: "BarChart"
            }
        },
        components: {
            AppLayout,
            JetDialogModal,
            GChart
        },
        methods: {
            toDate: function(value) {
                return moment(value).format('Y/M/D')
            },
            mod_data: function(value) {
                let arry = value[0].map((_, c) => value.map(r => r[c]));
                const columns = ["回答", "合計"];
                arry.unshift(columns);
                return arry
            },
            makeOption: function(value) {
                const options = {
                    chart: {
                        title: value,
                        subtitle: "",
                    },
                }
                return options
            }
        }
    };

</script>
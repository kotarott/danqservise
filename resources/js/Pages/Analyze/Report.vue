<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                集計：テーブル
            </h2>
        </template>

        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" ref="getParentWidth">
                    <SpreadSheet :rows="answers" :columns="makeColumns()" :cells="tgwidth"></SpreadSheet>
                </div>
            </div>
        </div>

    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import moment from 'moment'
    import JetDialogModal from '@/Jetstream/DialogModal'
    import TableLite from 'vue3-table-lite';
    import SpreadSheet from '@/components/SpreadSheet';

    export default {
        props: ['columns', 'answers'],
        data() {
            return {
                tgwidth: 0,
            }
        },
        mounted() {
            this.getTargetWidth()
            window.addEventListener('resize', this.getTargetWidth)
        },
        components: {
            AppLayout,
            JetDialogModal,
            TableLite,
            SpreadSheet
        },
        methods: {
            toDate: function(value) {
                return moment(value).format('Y/M/D')
            },
            getTargetWidth: function() {
                let targetWidth = this.$refs.getParentWidth.clientWidth
                this.tgwidth = parseInt(((targetWidth - ( 30 + 64 * this.columns.length)) / 50) + this.columns.length + 1, 10);
            },
            makeColumns: function() {
                let columns_data = [
                    {type: 'numeric', title:'#', width: 30}  //
                ]
                // const num = this.columns.length
                // let culc_width = parseInt((this.tgwidth * 0.95) / num, 10)
                for(let key in this.columns) {
                    let column = {
                        type: this.columns[key].type,
                        title: this.columns[key].title,
                        width: 64
                    }
                    columns_data.push(column)
                }
                return columns_data
            }
        },
    }



</script>
<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                分析：レポート
            </h2>
        </template>

        <!-- <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <TableLite
                        :has-checkbox="true"
                        :is-loading="table.isLoading"
                        :is-re-search="table.isReSearch"
                        :columns="table.columns"
                        :rows="table.rows"
                        :total="table.totalRecordCount"
                        :messages="table.messages"
                        @do-search="doSearch"
                        @is-finished="tableLoadingFinish"
                        @return-checked-rows="updateCheckedRows"
                    ></TableLite>
                </div>
            </div>
        </div> -->

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
    // import { reactive } from 'vue'
    import TableLite from 'vue3-table-lite';
    import SpreadSheet from '@/components/SpreadSheet';

    export default {
        props: ['columns', 'answers'],
        data() {
            return {
                // table: reactive({
                //     isLoading: false,
                //     isReSearch: false,
                //     columns: this.columns,
                //     rows: this.answers,
                //     totalRecordCount: Object.keys(this.answers).length,
                //     messages: {
                //         pagingInfo: "{0}~{1} / {2}",
                //         pageSizeChangeLabel: "display:",
                //         gotoPageLabel: "Go to page:",
                //         noDataAvailable: "No data",
                //     },
                //     sortable: {
                //         order: "id",
                //         sort: "asc",
                //     },
                // }),
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
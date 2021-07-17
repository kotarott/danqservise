<template>
    <div>
        <div id="jexcel" ref="spreadsheet"></div>
        <div><input type="button" value="Add new row" @click="() => spreadsheet.insertRow()"/></div>
    </div>
</template>

<script>
    import jspreadsheet from 'jspreadsheet-ce'
    import 'jspreadsheet-ce/dist/jspreadsheet.css'
    // import 'jspreadsheet-ce/dist/jspreadsheet.theme.css'

    export default {
        name: 'jexcel',
        props: ['rows', 'columns', 'cells'],
        data() {
            return {
                options: {
                    data: this.rows,
                    allowToolbar: true,
                    columns: this.columns,
                    tableOverflow: true,
                    lazyLoading: true,
                    loadingSpin: true,
                    minDimensions:[22,],
                },
            }
        },
        mounted: function () {
            let spreadsheet = jspreadsheet(this.$el, this.options)
            Object.assign(this, { spreadsheet })
        },

    }
</script>
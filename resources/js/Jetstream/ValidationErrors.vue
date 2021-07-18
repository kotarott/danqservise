<template>
    <div v-if="hasErrors">
        <div class="font-medium text-red-600">入力を修正してください！！</div>
        <ul class="mt-3 list-disc list-inside text-sm text-red-600" v-for="(error, key) in errors" :key="key">
            <div v-if="!isString(error)">
                <li v-for="(i, k) in error" :key="k">{{ i }}</li>
            </div>
            <div v-else>
                <li>{{ error }}</li>
            </div>
        </ul>
    </div>
</template>

<script>
    export default {
        computed: {
            errors() {
                return this.$page.props.errors
            },

            hasErrors() {
                return Object.keys(this.errors).length > 0;
            },
        },
        methods: {
            isString: function(value) {
                if(typeof(value) != "string"){
                    return false
                } else {
                    return true
                }
            }
        }
    }
</script>

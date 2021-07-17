<template>
    <div v-if="hasErrors">
        <div class="font-medium text-red-600">入力を修正してください！！</div>
        <!-- <div class="font-medium text-red-600">Whoops! Something went wrong.</div> -->

        <ul class="mt-3 list-disc list-inside text-sm text-red-600" v-for="(error, key) in errors" :key="key">
            <li v-for="(i, k) in error" :key="k">{{ i }}</li>
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
        }
    }
</script>

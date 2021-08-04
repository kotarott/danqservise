<template>

    <form  @input="submit">
        <label for="title">タイトルは？</label>
        <input type="text" class="mt-1 block w-full form-input rounded-md shadow-sm" id="title" v-model="title">
    </form>

</template>

<script>

    export default {
        data() {
            return {
                title: null
            }
        },
        methods: {
            submit: function() {
                this.$emit('update', {
                    title: this.title
                })
            },
        }
    }
</script>
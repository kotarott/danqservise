<template>

    <div>
        <h2>回答タイプは？</h2>
        <form  @change="submit">
            <select 
                v-model.number="selectedItem"
                id="selectItem" 
                class="mt-1 block w-full form-input rounded-md shadow-sm"
                size="6"
            >
                <option v-for="(item, id) in items" :key="id" :value="item.typeId">
                    {{ item.typename }}
                </option>
            </select>
        </form>
    </div>

</template>

<script>

    export default {
        props: ['items'],
        data() {
            return {
                selectedItem: null
            }
        },
        methods: {
            submit: function() {
                this.$emit('update', {
                    questionType: this.selectedItem
                })
            },
        }
    }
</script>
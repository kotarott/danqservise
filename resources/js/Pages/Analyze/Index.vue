<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                分析：質問一覧
            </h2>
            <div class="text-right">
                <jet-button
                    class="bg-blue-400 mx-2"
                    v-if="!getData"
                    v-on:click="getData = !getData; resetArray()"
                >
                    テーブルで取得
                </jet-button>
                <jet-button
                    class="bg-green-400 mx-2"
                    v-if="getData"
                    v-on:click="getData = !getData; resetArray()"
                >
                    グラフで取得
                </jet-button>
            </div>
        </template>

        <div class="py-12" v-if="!getData">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <form class="m-4">
                        <label for="selectQuestions">グラフで取得</label>
                        <select 
                            v-model.number="form.selected"
                            id="selectQuestions" 
                            class="mt-1 block w-full form-input rounded-md shadow-sm"
                            multiple
                            size="10"
                        >
                            <option v-for="(question, id) in ex1_questions" :key="id" :value="question.id">
                                {{ question.title }}
                            </option>
                        </select>
                    </form>
                    <div class="flex space-x-4 flex-row-reverse">
                        <jet-button
                            class="bg-green-400 m-2"
                            v-on:click="toggleModal = !toggleModal"
                        >
                            結果を見る
                        </jet-button>

                    </div>
                    <pre>{{$data.premier}}</pre>
                </div>
            </div>
        </div>

        <div class="py-12" v-if="getData">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <form class="m-4">
                        <label for="selectQuestions">テーブルで取得</label>
                        <select 
                            v-model.number="form.selected"
                            id="selectQuestions" 
                            class="mt-1 block w-full form-input rounded-md shadow-sm"
                            multiple
                            size="10"
                        >
                            <option v-for="(question, id) in questions" :key="id" :value="question.id">
                                {{ question.title }}
                            </option>
                        </select>
                    </form>
                    <div class="flex space-x-4 flex-row-reverse">
                        <jet-button
                            class="bg-blue-400 m-2"
                            v-on:click="toggleModal1 = !toggleModal1"
                        >
                            データを取得する
                        </jet-button>
                    </div>
                </div>
            </div>
        </div>

        <jet-dialog-modal :show="toggleModal" @close="toggleModal = false">
            <template #title>
                選択された質問
            </template>
            <template #content>
                <div class="overflow-auto h-32 bg-yellow-100 shadow-md sm:rounded-lg px-2">
                    <ul
                        v-for="(question, id) in questions" :key="id"
                    >
                        <li v-if="form.selected.includes(question.id)">
                            ・{{ question.title }}
                        </li>
                    </ul>
                </div>
            </template>
            <template #footer>
                <jet-button
                    class="bg-green-700"
                    v-on:click="getResult(); toggleModal = !toggleModal"
                >
                    決定
                </jet-button>
            </template>
        </jet-dialog-modal>

        <jet-dialog-modal :show="toggleModal1" @close="toggleModal1 = false">
            <template #title>
                選択された質問
            </template>
            <template #content>
                <div class="overflow-auto h-32 bg-yellow-100 shadow-md sm:rounded-lg px-2">
                    <ul
                        v-for="(question, id) in questions" :key="id"
                    >
                        <li v-if="form.selected.includes(question.id)">
                            ・{{ question.title }}
                        </li>
                    </ul>
                </div>
            </template>
            <template #footer>
                <jet-button
                    class="bg-blue-700"
                    v-on:click="getReport(); toggleModal1 = !toggleModal1"
                >
                    決定
                </jet-button>
            </template>
        </jet-dialog-modal>

    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import { reactive } from 'vue'
    // import moment from 'moment'
    import JetDialogModal from '@/Jetstream/DialogModal'
    import JetButton from '@/Jetstream/Button'
    // import vSelect from 'vue-select'
    import TableLite from 'vue3-table-lite';

    export default {
        props: ['questions'],
        data() {
            return {
                toggleModal: false,
                toggleModal1: false,
                getData: false,
                form: this.$inertia.form(
                    {
                        selected: [],
                    },
                    {
                        bag: "reportGet",
                        resetOnSuccess: false,
                    }
                ),
            }
        },
        components: {
            AppLayout,
            JetDialogModal,
            JetButton,
            TableLite
        },
        methods: {
            getReport: function(value) {
                this.form.post(route('analyze.report', this.form.selected))
            },
            getResult: function(value) {
                this.form.post(route('analyze.result', this.form.selected))
            },
            resetArray: function(value) {
                return this.form.selected.splice(-this.form.selected.length);
            }
        },
        computed: {
            q_index: function() {
                return Object.keys(this.questions[0]);
            },
            q_value: function() {
                return Object.values(this.questions);
            },
            ex1_questions: function() {
                let questions = []
                this.questions.forEach(function(item){
                    if(item.questiontype_id != 1){
                        questions.push(item)
                    }
                })
                return questions;
            }
        }
    }
</script>
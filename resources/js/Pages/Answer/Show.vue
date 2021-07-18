<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ question.title }}
            </h2>
            <!-- <button v-on:click="toggleModal = !toggleModal">共有設定</button> -->
            <div class="text-right">
                <jet-button
                    class="bg-green-400 mx-2"
                    v-on:click="toggleModal = !toggleModal"
                >
                    共有設定
                </jet-button>
                <jet-button
                    class="bg-red-400 mx-2"
                    v-on:click="toggleModalD = !toggleModalD"
                >
                    削除
                </jet-button>
            </div>
            
        </template>

        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <section class="text-gray-600 body-font">
                    <div class="container px-5 py-6 mx-auto bg-blue-100 overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="flex flex-wrap -m-4 text-center">
                            <div class="p-4 sm:w-1/4 w-1/2">
                                <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900">{{ question.answers_count | addComma }}</h2>
                                <p class="leading-relaxed">すべての回答</p>
                            </div>
                            <div class="p-4 sm:w-1/4 w-1/2">
                                <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900">1.8K</h2>
                                <p class="leading-relaxed">今月の回答数（仮）</p>
                            </div>
                            <div class="p-4 sm:w-1/4 w-1/2">
                                <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900">88</h2>
                                <p class="leading-relaxed">今日の回答数（仮）</p>
                            </div>
                            <div class="p-4 sm:w-1/4 w-1/2">
                                <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900">{{ toDate(question.created_at) }}</h2>
                                <p class="leading-relaxed">作成日</p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <div class="py-2" v-if="question.questiontype_id != 1">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" v-for="(answer, title) in result" :key="title">
                    <GChart :type="chartType" :data="mod_data(answer)" :options="makeOption(title)" />
                </div>
            </div>
        </div>

        <div class="py-2" v-if="question.questiontype_id == 1">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <section class="text-gray-600 body-font overflow-hidden">
                        <div class="container px-5 py-24 mx-auto">
                            <div class="-my-8 divide-y-2 divide-gray-100" v-for="(answer, index) in result" :key="index">
                                <div class="py-8 flex flex-wrap md:flex-nowrap">
                                    <div class="md:w-64 md:mb-0 mb-6 flex-shrink-0 flex flex-col">
                                        <span class="font-semibold title-font text-gray-700">{{ index + 1 }}</span>
                                        <span class="mt-1 text-gray-500 text-sm">{{ toDate(answer.created_at) }}</span>
                                        <!-- <span class="font-semibold title-font text-gray-700">{{ answer.created_at }}</span> -->
                                    </div>
                                    <div class="md:flex-grow">
                                        <p class="leading-relaxed font-medium text-gray-900">{{ answer.text }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- <ul v-for="(answer, index) in result" :key="index">
                        #{{index}}<li>{{  }}</li>
                    </ul> -->
                </div>
            </div>
        </div>

    <jet-dialog-modal :show="toggleModal" @close="toggleModal = false">
        <template #title>
            あなたの回答
        </template>
        <template #content>
            <div v-if="yourAnswer.text">
                <P class="bg-yellow-100 shadow-md sm:rounded-lg px-2">{{ yourAnswer.text }}</p>
            </div>
            <div v-if="yourAnswer.int">
                <P class="bg-yellow-100 shadow-md sm:rounded-lg px-2">{{ yourAnswer.int }}</p>
            </div>
            <div v-if="yourAnswer.selection">
                <P class="bg-yellow-100 shadow-md sm:rounded-lg px-2">{{ yourAnswer.selection }}</p>
            </div>
            <form class="m-4">
                <label for="privacy">共有範設定の変更</label>
                <select 
                    v-model.number="form.privacy"
                    name=""
                    id="privacy" 
                    class="mt-1 block w-full form-input rounded-md shadow-sm"
                >
                    <option v-for="(privacy, id) in privacies" :key="id" :value="privacy.id">
                        {{ privacy.status }}
                    </option>
                </select>
            </form>
        </template>
        <template #footer>
            <jet-button
                class="bg-blue-700"
                v-on:click="updateAnswer(); toggleModal = !toggleModal"
            >
                更新
            </jet-button>
        </template>
    </jet-dialog-modal>

    <JetConfirmationModal
        :show="toggleModalD"
        @close="toggleModalD = false"
    >
        <template #title>回答データの削除</template>
        <template #content>
            回答データが削除されます。よろしいですか？
        </template>
        <template #footer>
            <jet-button
                class="bg-red-700"
                v-on:click="deleteAnswer(yourAnswer.id); toggleModalD = !toggleModalD"
            >
                削除
            </jet-button>
        </template>
        
    </JetConfirmationModal>

    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import JetDialogModal from '@/Jetstream/DialogModal'
    import JetConfirmationModal from '@/Jetstream/ConfirmationModal'
    import JetFormSection from '@/Jetstream/FormSection'
    import JetInput from '@/Jetstream/Input'
    import JetButton from '@/Jetstream/Button'
    import moment from 'moment'
    import { GChart } from "vue3-googl-chart";

    export default {
        props: ['question', 'result', 'yourAnswer', 'privacies'],
        data() {
            return {
                toggleModal: false,
                toggleModalD: false,
                chartType: "ColumnChart",
                form: this.$inertia.form(
                    {
                        privacy: this.yourAnswer.privacy_id
                    },
                    {
                        bag: "answerUpdate",
                        resetOnSuccess: false,
                    }
                ),
            }
        },
        components: {
            AppLayout,
            JetDialogModal,
            JetConfirmationModal,
            JetFormSection,
            JetInput,
            JetButton,
            GChart
        },
        methods: {
            updateAnswer: function(value) {
                this.form.put(route("answer.update", this.yourAnswer.id));
                event.preventDefault();
                
            },
            deleteAnswer: function(id) {
                this.form.delete(route("answer.destroy", id));
                event.preventDefault();
            },
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
        },
        filters: {
            addComma: function(value) {
                return value.toString();
            }
        }
    }

</script>
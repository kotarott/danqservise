<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ question.title }}
            </h2>
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
                                <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900"> </h2>
                                <p class="leading-relaxed">今月の回答数</p>
                            </div>
                            <div class="p-4 sm:w-1/4 w-1/2">
                                <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900"> </h2>
                                <p class="leading-relaxed">今日の回答数</p>
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
                <select 
                    v-model="chartType"
                    name=""
                    id="selectType" 
                    class="mt-1 block w-full form-input rounded-md shadow-sm"
                >
                    <option disable value="">チャートの種類</option>
                    <option value="BarChart">棒グラフ（横）</option>
                    <option value="ColumnChart">棒グラフ（縦）</option>
                    <option value="PieChart">円グラフ</option>
                </select>
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" v-for="(answer, title) in result" :key="title">
                    <GChart :type="chartType" :data="mod_data(answer)" :options="makeOption(title)" />
                </div>
            </div>
        </div>

        <div class="py-2" v-if="question.questiontype_id == 1">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div id="task-comments" class="pt-4"  v-for="(answer, index) in result" :key="index">
                    <!--     comment-->
                    <div class="bg-white rounded-lg p-3  flex flex-col justify-center items-center md:items-start shadow-lg mb-4">
                        <div class="flex flex-row justify-center mr-2">
                            <!-- <img alt="avatar" width="48" height="48" class="rounded-full w-10 h-10 mr-4 shadow-lg mb-4" src="https://cdn1.iconfinder.com/data/icons/technology-devices-2/100/Profile-512.png"> -->
                            <h3 class="text-purple-600 font-semibold text-lg text-center md:text-left ">{{ toDate(answer.created_at) }}</h3>
                        </div>
                        <p style="width: 90%" class="text-gray-600 text-lg text-center md:text-left ">{{ answer.text }}</p>
                    </div>
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
                <label for="privacy">共有設定の変更</label>
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
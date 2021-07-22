<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                回答
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                        <jet-form-section @submitted="createAnswer">
                            <template #title>回答する</template>
                            <template #description>質問への回答を作成します</template>
                            <template #form>
                                    <div class="col-span-6 sm:col-span-4">
                                        <jet-validation-errors bag="answerCreate" class="mb-4" />
                                    </div>

                                    <!-- タイトル -->
                                    <div class="col-span-6 sm:col-span-4">
                                        <p class="text-base sm:text-lg md:text-xl lg:text-xl xl:text-xl text-indigo-700 font-semibold underline">{{ question.title }}</p>
                                    </div>

                                    <!-- テキストタイプ -->
                                    <div class="col-span-6 sm:col-span-4" v-if="questionType.typeId == 1">
                                        <!-- 回答 -->
                                        <jet-label for="answer" value="回答を入力してください" />
                                        <textarea 
                                            v-model="form.answer_text"
                                            class="mt-1 block w-full form-input rounded-md shadow-sm"
                                            id="answer"
                                        />
                                    </div>

                                    <!-- 選択肢 -->
                                    <div class="col-span-6 sm:col-span-4" v-if="questionType.typeId == 2">
                                        <!-- 回答 -->
                                        <jet-label for="answer" value="回答を選択してください" />
                                        <div v-for="(selection, k) in selections" :key="k">
                                            <input type="radio" :id="k" :value="selection.selection" v-model="form.answer_text">
                                            <label :for="k">{{ selection.selection }}</label>
                                        </div>
                                    </div>

                                    <!-- 数値（整数） -->
                                    <div class="col-span-6 sm:col-span-4" v-if="questionType.typeId == 3">
                                        <!-- 回答 -->
                                        <jet-label for="answer" value="回答を入力してください" />
                                        <jet-input
                                            id="answer"
                                            type="number"
                                            class="mt-1 block w-full"
                                            v-model.number="form.answer_num"
                                        />
                                    </div>

                                    <!-- 5段階 -->
                                    <div class="col-span-6 sm:col-span-4" v-if="questionType.typeId == 4">
                                        <!-- 回答 -->
                                        <jet-label for="answer" value="5段階で評価してください" />
                                        <p>あなたの回答：{{form.answer_num}}</p>
                                        <jet-input
                                            id="answer"
                                            type="range"
                                            class="mt-1 block w-full"
                                            v-model.number="form.answer_num"
                                            max = '5'
                                            min = '1'
                                            step = '1'
                                        />
                                    </div>

                                    <!-- 10段階 -->
                                    <div class="col-span-6 sm:col-span-4" v-if="questionType.typeId == 5">
                                        <!-- 回答 -->
                                        <jet-label for="answer" value="10段階で評価してください" />
                                        <jet-input
                                            id="answer"
                                            type="range"
                                            class="mt-1 block w-full"
                                            v-model.number="form.answer_num"
                                            max = '10'
                                            min = '1'
                                            step = '1'
                                        />
                                    </div>

                                    <!-- 100段階 -->
                                    <div class="col-span-6 sm:col-span-4" v-if="questionType.typeId == 6">
                                        <!-- 回答 -->
                                        <jet-label for="answer" value="0~100の間で評価してください" />
                                        <jet-input
                                            id="answer"
                                            type="range"
                                            class="mt-1 block w-full"
                                            v-model.number="form.answer_num"
                                            max = '100'
                                            min = '1'
                                            step = '1'
                                        />
                                    </div>

                                    <div class="col-span-6 sm:col-span-4">
                                        <!-- プライバシー -->
                                        <jet-label for="privacy_id" value="プライバシー設定" />

                                        <select 
                                            v-model.number="form.privacy"
                                            name=""
                                            id="privacy" 
                                            class="mt-1 block w-full form-input rounded-md shadow-sm"
                                        >
                                            <p class="bg-yellow-100 sm:rounded-lg px-2">
                                                <ul>
                                                    <li>共有する場合：他の回答と紐づけられます。</li>
                                                    <li>共有しない場合：この質問の中でのみ利用が可能です。</li>
                                                </ul>
                                            </p>
                                            <option disable value="">公開範囲を選択してください</option>
                                            <option v-for="(privacy, id) in privacies" :key="id" :value="privacy.id">
                                                {{ privacy.status }}
                                            </option>
                                        </select>
                                    </div>
                            </template>
                            <template #actions>
                                    <jet-button class="bg-blue-700">
                                            回答
                                    </jet-button>
                            </template>
                        </jet-form-section>
                    </div>
                </div>
            </div>
        </div>

    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import JetButton from '@/Jetstream/Button'
    import JetFormSection from '@/Jetstream/FormSection'
    import JetInput from '@/Jetstream/Input'
    import JetLabel from '@/Jetstream/Label'
    import JetInputError from '@/Jetstream/InputError'
    import JetValidationErrors from '@/Jetstream/ValidationErrors'

    export default {
        props: ['question', 'questionType', 'selections', 'privacies'],
        components: {
            AppLayout,
            JetFormSection,
            JetInput,
            JetLabel,
            JetButton,
            JetInputError,
            JetValidationErrors,
        },
        data() {
            return {
                form: this.$inertia.form(
                    {
                        _method: "POST",
                        answer_text: "",
                        answer_num: 0,
                        question_id: this.question.id,
                        questionType: this.questionType.typeId,
                        privacy: NaN
                    },
                    {
                        bag: "answerCreate",
                        resetOnSuccess: false,
                    }
                ),
            }
        },
        methods: {
            createAnswer(event) {
                // this.form.question_id = this.question.id
                this.form.post(route("answer.store"));
                event.preventDefault();
            },
        }
    }
</script>

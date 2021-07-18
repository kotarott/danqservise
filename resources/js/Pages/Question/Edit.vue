<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                質問作成
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <jet-form-section @submitted="updateQuestion">
                    <template #title>質問を編集する</template>
                    <template #description>質問を編集します</template>
                    <template #form>
                        <div class="col-span-6 sm:col-span-4">
                            <jet-validation-errors bag="questionUpdate" class="mb-4" />
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <!-- タイトル -->
                            <jet-label for="title" value="タイトル" />
                            <jet-input
                                id="title"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.title"
                            />
                        </div>

                        <div class="col-span-6 sm:col-span-4">
                            <!-- 質問のタイプ -->
                            <jet-label for="questionType" value="質問のタイプ" />
                            <select 
                                v-model.number="form.questionType"
                                name=""
                                id="questionType" 
                                class="mt-1 block w-full form-input rounded-md shadow-sm"
                            >
                                <option disable value="">質問タイプを選択してください</option>
                                <option v-for="(questiontype, id) in questionTypes" :key="id" :value="questiontype.typeId">
                                    {{ questiontype.typename }}
                                </option>
                            </select>
                        </div>


                        <div class="col-span-6 sm:col-span-4" v-if="form.questionType == 2" id="selection-form">
                            <!-- 選択肢の追加 -->
                            <jet-label for="selections" value="選択肢の作成" />
                            <ul>
                                <li v-for="n of selectNum + 1" :key="n">
                                    <input
                                        type='text'
                                        class='mt-1 block w-full form-input rounded-md shadow-sm'
                                        id='inputSlections'
                                        placeholder='選択肢を入力'
                                        v-model="form.selections[n-1]"
                                    >
                                </li>
                            </ul>
                        </div>

                        <div class="col-span-6 sm:col-span-4">
                            <!-- 説明 -->
                            <jet-label for="description" value="質問の説明" />
                            <textarea 
                                v-model="form.description"
                                class="mt-1 block w-full form-input rounded-md shadow-sm"
                            />
                        </div>

                        <div class="col-span-6 sm:col-span-4">
                            <!-- 回答後表示する文 -->
                            <jet-label for="result" value="回答後のコメント" />
                            <textarea 
                                v-model="form.result"
                                class="mt-1 block w-full form-input rounded-md shadow-sm"
                            />
                        </div>

                        <div class="col-span-6 sm:col-span-4">
                            <!-- ステータス -->
                            <jet-label for="status" value="質問のステータス" />
                            <select 
                                v-model.number="form.status"
                                name=""
                                id="status" 
                                class="mt-1 block form-input rounded-md shadow-sm"
                            >
                                <option disable value="">質問のステータスを選択してください</option>
                                <option :value="0">公開</option>
                                <option :value="1">下書き</option>
                            </select>
                        </div>

                        <div class="col-span-6 sm:col-span-4">
                            <!-- 注意事項の同意 -->
                            <jet-label for="checkCaution" value="注意事項" />
                            <p class="bg-yellow-100 sm:rounded-lg px-2">
                                <ul>
                                    <li>共有する場合：他の回答と紐づけられます。</li>
                                    <li>共有しない場合：この質問の中でのみ利用が可能です。</li>
                                </ul>
                            </p>
                            <input
                                id="checkCaution"
                                type="checkbox"
                                class="mt-1 form-input rounded-md shadow-sm"
                                v-model="form.caution"
                            />
                            <label for="checkCaution" class="mt-1">同意する</label>
                        </div>

                    </template>
                    <template #actions>
                        <jet-button class="bg-blue-700">
                            作成
                        </jet-button>
                    </template>
                </jet-form-section>
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
        props: ['questionTypes', 'question'],
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
                        title: this.question.title,
                        questionType: this.question.questiontype.typeId,
                        description: this.question.description,
                        result: this.question.result,
                        status: this.question.status,
                        caution: false,
                        selections: [],
                    },
                    {
                        bag: "questionCreate",
                        resetOnSuccess: false,
                    }
                ),
                newSelection: ""
            }
        },
        computed: {
            selectNum : function(){ 
                let num = this.form.selections.length;
                if(num != 0) {
                    for(let item in this.form.selections) {
                        if(!item) {
                            num--
                        }
                    }
                }
                return num;
            },
        },
        methods: {
            updateQuestion(event) {
                this.form.put(route("question.update", this.question.id));
                event.preventDefault();
            },
            deleteSelections: function(index) {
                this.form.selections.splice(index, 1);
            },
            addSelections: function(event) {
                if(this.newSelection == '') return;
                var item = this.newSelection;
                this.form.selections.push(item);
                this.newSelection = '';
            },
        }
    }
</script>

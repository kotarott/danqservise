<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                質問作成
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <jet-form-section @submitted="createQuestion">
                    <template #title>質問を作成する</template>
                    <template #description>新しい質問を作成します</template>
                    <template #form>
                        <div class="col-span-6 sm:col-span-4">
                            <jet-validation-errors bag="questionCreate" class="mb-4" />
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
                                    <li>公開後は内容の変更ができません</li>
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

        <div class="py-3">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <section class="body-font">
                    <div class="container px-5 py-3 mx-auto bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <InputTitle v-if="stepNumber == 1" @update="updateForm"></InputTitle>
                        <SelectComponent v-if="stepNumber == 2" :items="questionTypes" @update="updateForm"></SelectComponent>
                        <div class="py-2">
                            <div class="flex justify-center">
                                <jet-button class="bg-gray-300 px-4 py-2 m-2" @click="backStep">
                                    前に戻る
                                </jet-button>
                                <jet-button class="bg-blue-700 px-4 py-2 m-2" @click="nextStep">
                                    次に進む
                                </jet-button>
                            </div>
                        </div>
                    </div>
                </section>
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
    import InputTitle from '@/components/createQuestion/InputTitle'
    import SelectComponent from '@/components/createQuestion/SelectComponent'

    export default {
        props: ['questionTypes'],
        components: {
            AppLayout,
            JetFormSection,
            JetInput,
            JetLabel,
            JetButton,
            JetInputError,
            JetValidationErrors,
            InputTitle,
            SelectComponent,
        },
        data() {
            return {
                form: this.$inertia.form(
                    {
                        _method: "POST",
                        title: "",
                        questionType: 0,
                        description: "",
                        result: "",
                        status: NaN,
                        caution: false,
                        selections: [],
                    },
                    {
                        bag: "questionCreate",
                        resetOnSuccess: false,
                    }
                ),
                newSelection: "",
                stepNumber: 1
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
            createQuestion(event) {
                this.form.post(route("question.store"));
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
            updateForm:function(formData){
                Object.assign(this.form, formData);
            },
            backStep:function(){
                this.stepNumber--;
            },
            nextStep:function(){
                this.stepNumber++;
            },
        }
    }
</script>

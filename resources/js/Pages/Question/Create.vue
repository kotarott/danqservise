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
                            <!-- <jet-input-error
                                :message="form.error.title"
                                class="mt-2"
                            /> -->
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
                                <option v-for="(type, id) in questionTypes" :key="id" :value="id">
                                    {{ type }}
                                </option>
                            </select>
                            <!-- <jet-input-error 
                                :message="form.error('questionType')"
                                class="mt-2"
                            /> -->
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
                                <!-- <li v-for="(item, k) in form.selections" :key="k">
                                    <span>{{ item }}</span>
                                    <p v-on:click="deleteSelections(k)">削除</p>
                                </li> -->
                            </ul>
                            <!-- <input
                                type='text'
                                class=''
                                id='inputSlections'
                                placeholder='選択肢を入力'
                                v-model="$data.newSelection"
                            >
                            <p v-on:click="addSelections()">選択肢を追加</p> -->
                            <!-- <pre>
                                {{ $data }}
                            </pre> -->
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
                            <!-- <jet-input-error 
                                :message="form.error('status')"
                                class="mt-2"
                            /> -->
                        </div>

                        <div class="col-span-6 sm:col-span-4">
                            <!-- 注意事項の同意 -->
                            <jet-label for="checkCaution" value="注意事項" />
                            <input
                                id="checkCaution"
                                type="checkbox"
                                class="mt-1 form-input rounded-md shadow-sm"
                                v-model="form.caution"
                            />
                            <label for="checkCaution" class="mt-1">同意する</label>
                            <!-- <jet-input-error 
                                :message="form.error('caution')"
                                class="mt-2"
                            /> -->
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
        props: ['questionTypes'],
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
        }
    }
</script>

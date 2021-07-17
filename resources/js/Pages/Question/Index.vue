<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                質問一覧
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <section class="body-font">
                    <div class="container px-5 mx-auto">
                        <div class="flex flex-wrap -m-4">
                            <div class="p-4 lg:w-1/3 w-full" v-for="(question, index) in questions" :key="index">
                                <div class="h-full bg-white bg-opacity-75 px-8 pt-12 pb-20 rounded-lg overflow-hidden text-center relative shadow-xl">
                                <h2 class="tracking-widest text-xs title-font font-medium text-gray-400 mb-1">Question:</h2>
                                <h1 class="title-font sm:text-2xl text-xl font-medium text-gray-900 mb-3">{{ question.title }}</h1>
                                <p class="leading-relaxed mb-3">{{ question.description }}</p>
                                <p class="leading-relaxed mb-3">作成日：{{ toDate(question.created_at) }}</p>
                                <a class="text-indigo-500 inline-flex items-center">
                                    <!-- <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12h14"></path>
                                    <path d="M12 5l7 7-7 7"></path>
                                    </svg> -->
                                    <inertia-link
                                        :href="route('question.show', question.id)"
                                        v-if="!question.answer_status"
                                    >
                                        <button
                                            class="bg-green-400 text-white px-4 py-2 border rounded-md hover:bg-white hover:border-indigo-500 hover:text-black"
                                        >
                                            回答する
                                        </button>
                                    </inertia-link>

                                    <inertia-link
                                        :href="route('answer.show', question.answer_status)"
                                        v-else
                                    >
                                        <button
                                            class="bg-indigo-500 text-white px-4 py-2 border rounded-md hover:bg-white hover:border-indigo-500 hover:text-black"
                                        >
                                            確認する
                                        </button>
                                    </inertia-link>
                                </a>
                                <div class="text-center mt-2 leading-none flex justify-center absolute bottom-0 left-0 w-full py-4">
                                    <span class="text-gray-400 mr-3 inline-flex items-center leading-none text-sm pr-3 py-1 border-r-2 border-gray-200">
                                    <svg class="w-4 h-4 mr-1" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>{{ question.answers_count }}
                                    </span>
                                    <span class="text-gray-400 inline-flex items-center leading-none text-sm">
                                    <svg class="w-4 h-4 mr-1" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                        <path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"></path>
                                    </svg>(仮)
                                    </span>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

    <!-- <table class="min-w-full table-auto">
        <thead class="justify-between">
            <tr class="bg-gray-800">
                <th class="px-16 py-2">
                    <span class="text-gray-300">#</span>
                </th>
                <th class="px-16 py-2">
                    <span class="text-gray-300">タイトル</span>
                </th>
                <th class="px-16 py-2">
                    <span class="text-gray-300">説明</span>
                </th>
                <th class="px-16 py-2">
                    <span class="text-gray-300">作成日</span>
                </th>
                <th class="px-16 py-2">
                    <span class="text-gray-300">ステータス</span>
                </th>
          </tr>
        </thead>
        <tbody class="bg-gray-200">
            <tr class="bg-white border-4 border-gray-200" v-for="(question, index) in questions" :key="index">
                <td class="px-16 py-2 flex flex-row items-center">
                    <p>{{ index }}</p>
                </td>
                <td>
                    <span class="text-center ml-2 font-semibold">{{ question.title }}</span>
                </td>
                <td class="px-16 py-2">
                    <span class="text-center ml-2 font-semibold">{{ question.description }}</span>
                </td>
                <td class="px-16 py-2">
                    <span>{{ toDate(question.created_at) }}</span>
                </td>
                <td class="px-16 py-2">
                    <inertia-link
                        :href="route('question.show', question.id)"
                        v-if="!question.answer_status"
                    >
                        <button
                            class="bg-green-400 text-white px-4 py-2 border rounded-md hover:bg-white hover:border-indigo-500 hover:text-black"
                        >
                            回答する
                        </button>
                    </inertia-link>

                    <inertia-link
                        :href="route('answer.show', question.answer_status)"
                        v-else
                    >
                        <button
                            class="bg-indigo-500 text-white px-4 py-2 border rounded-md hover:bg-white hover:border-indigo-500 hover:text-black"
                        >
                            確認する
                        </button>
                    </inertia-link>
                </td>
          </tr>

        </tbody>
    </table> -->

    <jet-dialog-modal :show="toggleModal" @close="toggleModal = false">
        <template #title>
            Product added
        </template>
        <template #content>
            
        </template>
    </jet-dialog-modal>

    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import moment from 'moment'
    import JetDialogModal from '@/Jetstream/DialogModal'

    export default {
        props: ['questions'],
        data() {
            return {
                toggleModal: false,
            }
        },
        components: {
            AppLayout,
            JetDialogModal,
        },
        methods: {
            toDate: function(value) {
                return moment(value).format('Y/M/D')
            },
        }
    }

</script>
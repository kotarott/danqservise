<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                トップ
            </h2>
        </template>

        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <section class="text-gray-600 body-font">
                    <div class="container px-5 py-6 mx-auto bg-blue-100 overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="flex flex-wrap -m-4 text-center">
                            <div class="p-4 sm:w-1/4 w-1/2">
                                <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900">{{ summary.users | addComma }}</h2>
                                <p class="leading-relaxed">登録者数</p>
                            </div>
                            <div class="p-4 sm:w-1/4 w-1/2">
                                <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900">{{ summary.questions | addComma}}</h2>
                                <p class="leading-relaxed">総質問数</p>
                            </div>
                            <div class="p-4 sm:w-1/4 w-1/2">
                                <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900">{{ summary.answers | addComma}}</h2>
                                <p class="leading-relaxed">総回答数</p>
                            </div>
                            <div class="p-4 sm:w-1/4 w-1/2">
                                <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900"></h2>
                                <p class="leading-relaxed"></p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <div class="py-3 bg-green-100">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h2 class="font-semibold text-xl">最新の投稿</h2>
                    <GetQuestions :type="'latest'"></GetQuestions>
            </div>
        </div>
        <div class="py-3">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h2 class="font-semibold text-xl">最新の回答</h2>
                    <GetQuestions :type="'answerd'"></GetQuestions>
            </div>
        </div>
        <div class="py-3">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h2 class="font-semibold text-xl">編集中のコンテンツ</h2>
                    <GetQuestions :type="'edit'"></GetQuestions>
            </div>
        </div>
        
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import GetQuestions from '@/components/GetQuestions'

    export default {
        props: ['summary'],
        components: {
            AppLayout,
            GetQuestions
        },
    }
</script>

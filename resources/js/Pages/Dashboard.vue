<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                トップ
            </h2>
        </template>

        <div class="py-3 bg-green-100">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h2 class="font-semibold text-xl">最新の投稿</h2>
                    <GetQuestions :type="'latest'"></GetQuestions>
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
        components: {
            AppLayout,
            GetQuestions
        },
    }
</script>

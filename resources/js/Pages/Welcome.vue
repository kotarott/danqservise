<template>
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
        <div v-if="canLogin" class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            <inertia-link v-if="$page.props.user" href="/dashboard" class="text-sm text-gray-700 underline">
                Dashboard
            </inertia-link>

            <template v-else>
                <inertia-link :href="route('login')" class="text-sm text-gray-700 underline">
                    Log in
                </inertia-link>

                <inertia-link v-if="canRegister" :href="route('register')" class="ml-4 text-sm text-gray-700 underline">
                    Register
                </inertia-link>
            </template>
        </div>

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                <!-- <img src="storage/logos/logo.png" alt="logo"> -->
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="120px" height="62px" viewBox="0 0 120 62" enable-background="new 0 0 120 62" xml:space="preserve">
                    <image id="image0" width="120" height="62" x="0" y="0"
                        href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAHgAAAA+CAMAAADXuy+RAAAABGdBTUEAALGPC/xhBQAAACBjSFJN
                        AAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAACDVBMVEUAAABAleo6kvA3ku0A
                        //84lPA5lfA5lfA5lfE7lPFAgP85lfA4lfA7nes5lPA5lu85lfA5lO85lfA6lfE6lfA5lfE5lfA5
                        lfA5lfA5lfA6l+45le84lu85lfA6lfA6lPI5le83lu44lu85lO85lfA6lfA4lfA6lO88lvA5lPA5
                        lfA5lfA5lfA5lPA6lvA4lfM5l+w4lPA5lfA4lPA4le85le86le85lu85le85lfA9kvM5lPBAn/85
                        lfE4lfA5lfA5lPBJkv85lu85lfA4le86l/A5lfA5lfA5lvA5lvE5lfA5lfA2lPI6lfA4lPA5lfA6
                        l/M7lvI4lvA2k/A5lfE4lfA4lPA4lfA5lfAzme46lO85lfA4le84lfA5lO45le87k/A5lfA6lfE8
                        ku85lfA6lfA5lfA7k+s5lu86lPE5lfA5lfA1le05lfA4k/I5lfA5lO85nPE7le85lO82lPI5le83
                        mPE4lvE5lfA5lfA5lfA5lO83lvDka5TsZ5XqZpTpZ5XjY47qZ5XrZ5XsZ5Y6lvA3le45k+7pZ5Ts
                        aJc5lfI5le/qZ5XrZ5U5lfA5lfA5lfA6lO/saJXrZ5U5lvE6lvA5le/rZ5XrZ5brZ5XsZpbrZZM5
                        lfA4k+85lfDtZ5XsZ5Y5le86lfA5le84lfDrZZTrZ5XqZpTraJXqZ5E3kPQ5lfDrZ5XqZ5X////P
                        6RsfAAAAq3RSTlMADCMcAWT96rBKBO57DeE/9GL3arpsdLfx4yyQcvKoOeUug8Tp6+KxEXXO+vPc
                        mykbiNaeUvaAovWqFbgIjrWr6AezyGBC38pVWvvnJmUy+BYn0CFIvqyarw9dnXGETJM0zJ8v7EbP
                        Go985Isd4Du2lBJBURPTJW3X0q1wMxNeel4S+PZchTwtRUI6xbe02vDYkvv4a5Ze+7+8UE5nQLlv
                        bbRUsnYmdJFzJReoP3KkAAAAAWJLR0SuuWuTpwAAAAd0SU1FB+UHEQ0cNWjExlYAAANeSURBVFjD
                        7Zj5VxJRFMdHHIaCMiMyRQmqUXBwLxWQVpPSSkVMW8z2NG2zzbKy3coWrcz2fW/of4x5y2ww06uT
                        cE5nvj+9d+/jfpg7994ZoChDhgwZMmTIUAplmeTKptMGNvMKMZZZs62ZAAuyzZmbGTDP58zLEJjP
                        nZ8hMG9fkCawY6GgvEX5mFzgTA+4EG2tRS5EXjzDnaUCU5TbAy2WJaLJ6l66jLUxTHGJ1+xLiuAr
                        5Sz+svKKSoW1qrqmmCkrWV5JDKZW1EJTHQ5RH5DdfH8wBM0NYGsOr7TjEbAqJMYIrWawNegzrVER
                        NMBr10FTYxbYrnfxSrFNMnCRQ+aJ4LpwRmTWDRtdZGCquQWYNm0WNlv8SRVf3CqB2xQerh0EiOYo
                        rB0BQnAM3uVAZ2LdXgP9ZZzX692Kar6LFsEqdYOUbUvlIgBv56DNLF59/g5Y4uGdUi4w2NMTNTl3
                        ofuRE0t4elGRuHbviZr3MuRgHDMvsdwnXYig/QeEbe5B6ZADlrmzAOxamhPrIPQc6hMcdD/zx2DB
                        dtgrqAl7ohYVeAC3C+qFQYo6chSsbMegI3z8r8BKhU8wKnAQu4Y68GdOuqRCEHSqjRRMO6RUixpy
                        mis41LIysPQ5cY8iisMeZYAAfPqMVFzC9zg77B1QNJU+uE46I69VAjCsINhOVKjfltQZ+uBCFTjp
                        pCa4B9ahJZpYt8pnEO8/VzuDYFQmYGS2n8dMe/nIhYthOHb1wYO6qb40evnK1ZRgReOhi/f0ZEMn
                        CVi3uEavxePx6zdSgOmbqI7yx8T69tzC3l6CVHcGtNvpdhzqjhpMj9/FI054EUBZb8DB0TDQB+sN
                        kHsIfF8EPwATipsQ6whcJQJPVsEY1ocMAZjughFSjcxHCPxY82XPPyWLxjeO0/Js6IOlh8STMdO0
                        8iHxE4GfaoHxS2adaGBZu+j9DRgnVylw8hkCP9cAT46jaJUDSscEmMPgGaQNxo8qnLxcyfMCgV+m
                        AjORV9Kvpym/3BV5DXuyntYFiy+MIFz/G5nnLeC+o9TgiZL3pTHFgPkgxbDX+6humOtefTDV9xHf
                        2sAnWuH5/OXrt+8UiazuihqWZctHprOIziPFqjmW9TiGfVojMw0ywP8/+Af4e2Uo/WBDhgwZ+gf6
                        BTX38gC8PA3hAAAAJXRFWHRkYXRlOmNyZWF0ZQAyMDIxLTA3LTE3VDEzOjI4OjUzKzAwOjAwOaPa
                        OwAAACV0RVh0ZGF0ZTptb2RpZnkAMjAyMS0wNy0xN1QxMzoyODo1MyswMDowMEj+YocAAAAASUVO
                        RK5CYII="
                    />
                </svg>
            </div>

            <section class="text-gray-600 body-font">
                <div class="container mx-auto flex px-5 py-24 md:flex-row flex-col items-center">
                    <div class="lg:flex-grow md:w-1/2 lg:pr-24 md:pr-16 flex flex-col md:items-start md:text-left mb-16 md:mb-0 items-center text-center">
                    <!-- <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-blue-600 font-bold">Danq</h1> -->
                    <!-- <img src="storage/logos/logo.png" alt="logo"> -->
                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="120px" height="62px" viewBox="0 0 120 62" enable-background="new 0 0 120 62" xml:space="preserve">
                        <image id="image0" width="120" height="62" x="0" y="0"
                            href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAHgAAAA+CAMAAADXuy+RAAAABGdBTUEAALGPC/xhBQAAACBjSFJN
                            AAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAACDVBMVEUAAABAleo6kvA3ku0A
                            //84lPA5lfA5lfA5lfE7lPFAgP85lfA4lfA7nes5lPA5lu85lfA5lO85lfA6lfE6lfA5lfE5lfA5
                            lfA5lfA5lfA6l+45le84lu85lfA6lfA6lPI5le83lu44lu85lO85lfA6lfA4lfA6lO88lvA5lPA5
                            lfA5lfA5lfA5lPA6lvA4lfM5l+w4lPA5lfA4lPA4le85le86le85lu85le85lfA9kvM5lPBAn/85
                            lfE4lfA5lfA5lPBJkv85lu85lfA4le86l/A5lfA5lfA5lvA5lvE5lfA5lfA2lPI6lfA4lPA5lfA6
                            l/M7lvI4lvA2k/A5lfE4lfA4lPA4lfA5lfAzme46lO85lfA4le84lfA5lO45le87k/A5lfA6lfE8
                            ku85lfA6lfA5lfA7k+s5lu86lPE5lfA5lfA1le05lfA4k/I5lfA5lO85nPE7le85lO82lPI5le83
                            mPE4lvE5lfA5lfA5lfA5lO83lvDka5TsZ5XqZpTpZ5XjY47qZ5XrZ5XsZ5Y6lvA3le45k+7pZ5Ts
                            aJc5lfI5le/qZ5XrZ5U5lfA5lfA5lfA6lO/saJXrZ5U5lvE6lvA5le/rZ5XrZ5brZ5XsZpbrZZM5
                            lfA4k+85lfDtZ5XsZ5Y5le86lfA5le84lfDrZZTrZ5XqZpTraJXqZ5E3kPQ5lfDrZ5XqZ5X////P
                            6RsfAAAAq3RSTlMADCMcAWT96rBKBO57DeE/9GL3arpsdLfx4yyQcvKoOeUug8Tp6+KxEXXO+vPc
                            mykbiNaeUvaAovWqFbgIjrWr6AezyGBC38pVWvvnJmUy+BYn0CFIvqyarw9dnXGETJM0zJ8v7EbP
                            Go985Isd4Du2lBJBURPTJW3X0q1wMxNeel4S+PZchTwtRUI6xbe02vDYkvv4a5Ze+7+8UE5nQLlv
                            bbRUsnYmdJFzJReoP3KkAAAAAWJLR0SuuWuTpwAAAAd0SU1FB+UHEQ0cNWjExlYAAANeSURBVFjD
                            7Zj5VxJRFMdHHIaCMiMyRQmqUXBwLxWQVpPSSkVMW8z2NG2zzbKy3coWrcz2fW/of4x5y2ww06uT
                            cE5nvj+9d+/jfpg7994ZoChDhgwZMmTIUAplmeTKptMGNvMKMZZZs62ZAAuyzZmbGTDP58zLEJjP
                            nZ8hMG9fkCawY6GgvEX5mFzgTA+4EG2tRS5EXjzDnaUCU5TbAy2WJaLJ6l66jLUxTHGJ1+xLiuAr
                            5Sz+svKKSoW1qrqmmCkrWV5JDKZW1EJTHQ5RH5DdfH8wBM0NYGsOr7TjEbAqJMYIrWawNegzrVER
                            NMBr10FTYxbYrnfxSrFNMnCRQ+aJ4LpwRmTWDRtdZGCquQWYNm0WNlv8SRVf3CqB2xQerh0EiOYo
                            rB0BQnAM3uVAZ2LdXgP9ZZzX692Kar6LFsEqdYOUbUvlIgBv56DNLF59/g5Y4uGdUi4w2NMTNTl3
                            ofuRE0t4elGRuHbviZr3MuRgHDMvsdwnXYig/QeEbe5B6ZADlrmzAOxamhPrIPQc6hMcdD/zx2DB
                            dtgrqAl7ohYVeAC3C+qFQYo6chSsbMegI3z8r8BKhU8wKnAQu4Y68GdOuqRCEHSqjRRMO6RUixpy
                            mis41LIysPQ5cY8iisMeZYAAfPqMVFzC9zg77B1QNJU+uE46I69VAjCsINhOVKjfltQZ+uBCFTjp
                            pCa4B9ahJZpYt8pnEO8/VzuDYFQmYGS2n8dMe/nIhYthOHb1wYO6qb40evnK1ZRgReOhi/f0ZEMn
                            CVi3uEavxePx6zdSgOmbqI7yx8T69tzC3l6CVHcGtNvpdhzqjhpMj9/FI054EUBZb8DB0TDQB+sN
                            kHsIfF8EPwATipsQ6whcJQJPVsEY1ocMAZjughFSjcxHCPxY82XPPyWLxjeO0/Js6IOlh8STMdO0
                            8iHxE4GfaoHxS2adaGBZu+j9DRgnVylw8hkCP9cAT46jaJUDSscEmMPgGaQNxo8qnLxcyfMCgV+m
                            AjORV9Kvpym/3BV5DXuyntYFiy+MIFz/G5nnLeC+o9TgiZL3pTHFgPkgxbDX+6humOtefTDV9xHf
                            2sAnWuH5/OXrt+8UiazuihqWZctHprOIziPFqjmW9TiGfVojMw0ywP8/+Af4e2Uo/WBDhgwZ+gf6
                            BTX38gC8PA3hAAAAJXRFWHRkYXRlOmNyZWF0ZQAyMDIxLTA3LTE3VDEzOjI4OjUzKzAwOjAwOaPa
                            OwAAACV0RVh0ZGF0ZTptb2RpZnkAMjAyMS0wNy0xN1QxMzoyODo1MyswMDowMEj+YocAAAAASUVO
                            RK5CYII="
                        />
                    </svg>
                    <h2 class="title-font sm:text-2xl text-2xl mb-4 hidden lg:inline-block text-gray-500 font-normal">アンケート共有サービス</h2>
                        <!-- <br class="hidden lg:inline-block text-gray-500 font-normal">アンケート共有サービス -->

                    <p class="mb-8 leading-relaxed">
                        Danqはアンケートの共有サービスです。<br>
                        「誰でも」「気軽に」アンケートを作成・回答することができます。<br>
                        ビジネスや生活に役立つように回答を活用できます。
                    </p>
                    <div class="flex justify-center">
                        <inertia-link :href="route('register')">
                            <button class="inline-flex text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">新規登録</button>
                        </inertia-link>
                        <inertia-link :href="route('login')">
                            <button class="ml-4 inline-flex text-gray-700 bg-gray-100 border-0 py-2 px-6 focus:outline-none hover:bg-gray-200 rounded text-lg">ログイン</button>
                        </inertia-link>
                    </div>
                    </div>
                    <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6">
                        <img class="object-cover object-center rounded" alt="hero" src="https://dummyimage.com/720x600">
                    </div>
                </div>
            </section>

            <!-- <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <div class="p-6">
                        <div class="flex items-center">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            <div class="ml-4 text-lg leading-7 font-semibold"><a href="https://laravel.com/docs" class="underline text-gray-900 dark:text-white">Documentation</a></div>
                        </div>

                        <div class="ml-12">
                            <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                Laravel has wonderful, thorough documentation covering every aspect of the framework. Whether you are new to the framework or have previous experience with Laravel, we recommend reading all of the documentation from beginning to end.
                            </div>
                        </div>
                    </div>

                    <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l">
                        <div class="flex items-center">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <div class="ml-4 text-lg leading-7 font-semibold"><a href="https://laracasts.com" class="underline text-gray-900 dark:text-white">Laracasts</a></div>
                        </div>

                        <div class="ml-12">
                            <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                Laracasts offers thousands of video tutorials on Laravel, PHP, and JavaScript development. Check them out, see for yourself, and massively level up your development skills in the process.
                            </div>
                        </div>
                    </div>

                    <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                        <div class="flex items-center">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path></svg>
                            <div class="ml-4 text-lg leading-7 font-semibold"><a href="https://laravel-news.com/" class="underline text-gray-900 dark:text-white">Laravel News</a></div>
                        </div>

                        <div class="ml-12">
                            <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                Laravel News is a community driven portal and newsletter aggregating all of the latest and most important news in the Laravel ecosystem, including new package releases and tutorials.
                            </div>
                        </div>
                    </div>

                    <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-l">
                        <div class="flex items-center">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <div class="ml-4 text-lg leading-7 font-semibold text-gray-900 dark:text-white">Vibrant Ecosystem</div>
                        </div>

                        <div class="ml-12">
                            <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                Laravel's robust library of first-party tools and libraries, such as <a href="https://forge.laravel.com" class="underline">Forge</a>, <a href="https://vapor.laravel.com" class="underline">Vapor</a>, <a href="https://nova.laravel.com" class="underline">Nova</a>, and <a href="https://envoyer.io" class="underline">Envoyer</a> help you take your projects to the next level. Pair them with powerful open source libraries like <a href="https://laravel.com/docs/billing" class="underline">Cashier</a>, <a href="https://laravel.com/docs/dusk" class="underline">Dusk</a>, <a href="https://laravel.com/docs/broadcasting" class="underline">Echo</a>, <a href="https://laravel.com/docs/horizon" class="underline">Horizon</a>, <a href="https://laravel.com/docs/sanctum" class="underline">Sanctum</a>, <a href="https://laravel.com/docs/telescope" class="underline">Telescope</a>, and more.
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

            <!-- <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
                <div class="text-center text-sm text-gray-500 sm:text-left">
                    <div class="flex items-center">
                        <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="-mt-px w-5 h-5 text-gray-400">
                            <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>

                        <a href="https://laravel.bigcartel.com" class="ml-1 underline">
                            Shop
                        </a>

                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="ml-4 -mt-px w-5 h-5 text-gray-400">
                            <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>

                        <a href="https://github.com/sponsors/taylorotwell" class="ml-1 underline">
                            Sponsor
                        </a>
                    </div>
                </div>

                <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                    Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }})
                </div>
            </div> -->
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            canLogin: Boolean,
            canRegister: Boolean,
            laravelVersion: String,
            phpVersion: String,
        }
    }
</script>

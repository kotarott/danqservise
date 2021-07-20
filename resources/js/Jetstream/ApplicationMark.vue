<template>
    <!-- <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M11.395 44.428C4.557 40.198 0 32.632 0 24 0 10.745 10.745 0 24 0a23.891 23.891 0 0113.997 4.502c-.2 17.907-11.097 33.245-26.602 39.926z" fill="#6875F5"/>
      <path d="M14.134 45.885A23.914 23.914 0 0024 48c13.255 0 24-10.745 24-24 0-3.516-.756-6.856-2.115-9.866-4.659 15.143-16.608 27.092-31.75 31.751z" fill="#6875F5"/>
    </svg> -->
    <!-- <img :src="'/storage/logos/logo.png'" alt="logo"> -->
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
    RK5CYII="/>
</svg>
</template>

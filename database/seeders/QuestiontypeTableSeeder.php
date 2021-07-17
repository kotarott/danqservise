<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class QuestiontypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('questiontypes')->insert([
            [
                'typeId' => 1,
                'typename' => 'テキスト',
            ],
            [
                'typeId' => 2,
                'typename' => '選択肢',
            ],
            [
                'typeId' => 3,
                'typename' => '数値（整数）',
            ],
            [
                'typeId' => 4,
                'typename' => '5段階',
            ],
            [
                'typeId' => 5,
                'typename' => '10段階',
            ],
            [
                'typeId' => 6,
                'typename' => '100点満点',
            ],
        ]);
    }
}

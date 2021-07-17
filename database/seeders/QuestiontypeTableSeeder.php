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
                'typename' => 'テキスト',
            ],
            [
                'typename' => '選択肢',
            ],
            [
                'typename' => '数値（整数）',
            ],
            [
                'typename' => '5段階',
            ],
            [
                'typename' => '10段階',
            ],
            [
                'typename' => '100点満点',
            ],
        ]);
    }
}

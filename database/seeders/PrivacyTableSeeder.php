<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PrivacyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('privacies')->insert([
            [
                'status' => 'この質問のみ',
            ],
            [
                'status' => 'パッケージ内',
            ],
            [
                'status' => 'すべての質問',
            ],
        ]);
    }
}

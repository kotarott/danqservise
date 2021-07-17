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
                'privacyId' => 1,
                'status' => '共有しない',
            ],
            [
                'privacyId' => 3,
                'status' => '共有する',
            ],
        ]);
    }
}

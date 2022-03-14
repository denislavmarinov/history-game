<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionDifficultiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $difficulties = [
            [
                'difficulty' => "лесно"
            ],
            [
                'difficulty' => "средно"
            ],
            [
                'difficulty' => "трудно"
            ],
            [
                'difficulty' => "за експерти"
            ],
            [
                'difficulty' => "за историци"
            ],
        ];

        DB::table("question_difficulties")->insert($difficulties);
    }
}

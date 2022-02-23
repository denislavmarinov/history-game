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
                'difficulty' => "easy"
            ],
            [
                'difficulty' => "medium"
            ],
            [
                'difficulty' => "hard"
            ],
            [
                'difficulty' => "expert"
            ],
            [
                'difficulty' => "insane"
            ],
        ];

        DB::table("question_difficulties")->insert($difficulties);
    }
}

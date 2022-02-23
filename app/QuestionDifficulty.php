<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class QuestionDifficulty extends Model
{
    public static function select_all()
    {
        return DB::table("question_difficulties")
                ->select("*")
                ->get();
    }
}

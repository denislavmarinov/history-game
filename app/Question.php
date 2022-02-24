<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Question extends Model
{
    public static function select_all_questions()
    {
        return DB::table("questions")
                ->select('questions.id as id', 'question', 'points', 'question_difficulties.difficulty as difficulty', 'deleted_at')
                ->join("question_difficulties", "questions.difficulty", "=", "question_difficulties.id")
                ->get();
    }

    public static function select_question($id)
    {
        return DB::table("questions")
                ->select('questions.id as id', 'question', 'answers', 'points', 'question_difficulties.difficulty as difficulty', 'added_by', 'added_at', 'updated_by', 'updated_at', 'deleted_at', 'deleted_by')
                ->join("question_difficulties", "questions.difficulty", "=", "question_difficulties.id")
                ->where("questions.id", '=', $id)
                ->get();
    }

    public static function insert_question($data)
    {
        return DB::table("questions")
                ->insert($data);
    }

    public static function update_question($id, $data)
    {
        return DB::table("questions")
                ->where("id", "=", $id)
                ->update($data);
    }

    public static function delete_question($id)
    {
        return DB::table("questions")
                ->where("id", "=", $id)
                ->delete();
    } 
}

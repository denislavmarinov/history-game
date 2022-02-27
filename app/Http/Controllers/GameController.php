<?php

namespace App\Http\Controllers;

use App\GameLog;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    public function index()
    {
        return view("game.index");
    }

    public function get_a_question(Request $request)
    {
        $question = Question::get_a_question_by_difficulty($request->difficulty)[0];
        
        $answers = json_decode($question->answers);

        $answers_new = [];
        $num = 'A';

        foreach ($answers as $answer)
        {
            $answers_new[$num] = $answer->answer;

            if ($answer->answer_type == "c")
            {
                $correct_answer = $num; 
            }
            $num++;
        }

        $result = [
            'id' => $question->id,
            'question' => $question->question,
            'answer_1' => $answers_new['A'],
            'answer_2' => $answers_new['B'],
            'answer_3' => $answers_new['C'],
            'answer_4' => $answers_new['D'],
            'correct_answer' => $correct_answer,
            'points' => $question->points,
        ];
        
        $result = json_encode($result);

        return view('game.get_a_question', compact("result"));
    }

    public function gameover()
    {
        $data = Session::get("data");
        return view("game.over", compact("data"));
    }

    public function gameover_ajax(Request $request)
    {
        $started_at = date_create($request->started_at);
        $finished_at = date_create($request->finished_at);
        
        $data = [
            "points" => $request->points,
            "status" => $request->status,
            "user" => Auth::user()->id,
            "game_completion_time" => $request->time,
            "started_at" => date_format($started_at, 'Y-m-d H:i:s'),
            "finished_at" => date_format($finished_at, 'Y-m-d H:i:s')
        ];

        GameLog::add_game_log($data);
        Session::put('data', $data);

        return json_encode(true);
    }
}

<?php

namespace App\Http\Controllers;

use App\Question;
use App\Http\Requests\QuestionRequest;
use Illuminate\Http\Request;
use App\QuestionDifficulty;
use Illuminate\Support\Facades\Auth;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::select_all_questions();

        return view("questions.index", compact("questions"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $question_difficulties = QuestionDifficulty::select_all();

        return view("questions.create", compact("question_difficulties"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\QuestionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionRequest $request)
    {

        $answers = [];

        for ($i = 1; $i <= 4; $i++)
        {
            $type_of_answer = $request->correct_answer == "answer".$i ? "c" : "w"; 
            array_push($answers, ['answer_type' => $type_of_answer, 'answer' => $request->{"answer".$i}]);
        }

        $data = [
            'question' => $request->question,
            'answers' => json_encode($answers),
            'points' => $request->points,
            'difficulty' => $request->difficulty,
            'added_by' => Auth::user()->id,
            'added_at' => now(),
        ];

        Question::insert_question($data);

        return redirect()->route("questions.index")->with(['message'=> 'Въпроса беше успешно създаден!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        $question = Question::select_question($question->id)[0];

        return view("questions.show", compact("question"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        $question_difficulties = QuestionDifficulty::select_all();
        $question = Question::select_question($question->id)[0];

        $answers = json_decode($question->answers);

    
        for ($i = 0; $i < 4; $i++)
        {
            if($answers[$i]->answer_type == "c")
            {
                $correct_answer = $i+1;
                break;
            }
        }

        return view("questions.edit", compact("question_difficulties", "question", "answers", "correct_answer"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\QuestionRequest  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionRequest $request, Question $question)
    {
        $answers = [];

        for ($i = 1; $i <= 4; $i++)
        {
            $type_of_answer = $request->correct_answer == "answer".$i ? "c" : "w"; 
            array_push($answers, ['answer_type' => $type_of_answer, 'answer' => $request->{"answer".$i}]);
        }

        $data = [
            'question' => $request->question,
            'answers' => json_encode($answers),
            'points' => $request->points,
            'difficulty' => $request->difficulty,
            'updated_by' => Auth::user()->id,
            'updated_at' => now(),
        ];

        Question::update_question($question->id, $data);

        return redirect()->route("questions.show", $question->id)->with(['message'=> 'Въпросът беше успешно редактиран!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        Question::delete_question($question->id);

        return redirect()->route("questions.index")->with(['message'=> 'Въпросът беше успешно изтрит!']);
    }

    /**
     * Soft deletes a question
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function soft_delete(Question $question)
    {
        $id = $question->id;

        $data = [
            'deleted_at' => now(),
            'deleted_by' => Auth::user()->id,
        ];

        Question::update_question($id, $data);

        return redirect()->back()->with(['message'=> 'Въпросът успешно беше премахнат от игри!']);
    }

    /**
     * Returns a question into the game
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function return_in_game(Question $question)
    {
        $id = $question->id;

        $data = [
            'deleted_at' => NULL,
            'deleted_by' => NULL,
        ];

        Question::update_question($id, $data);

        return redirect()->back()->with(['message'=> 'Въпросът беше успешно добавен в игри!']);
    }
}

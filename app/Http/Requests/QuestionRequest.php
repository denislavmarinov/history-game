<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'question' => 'required|min:10|max:1000',
            'answer1' => 'required|max:300',
            'answer2' => 'required|max:300',
            'answer3' => 'required|max:300',
            'answer4' => 'required|max:300',
            'correct_answer' => 'required',
            'points'  => 'required',
            'difficulty' => 'required',
        ];
    }
}

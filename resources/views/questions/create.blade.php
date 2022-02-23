@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add question') }}</div>

                <div class="card-body">
                    <form action="{{ route('questions.store') }}" method="post">
                        @csrf

                        <label for="question" class="form-control-label">Question:</label>
                        <input type="text" name="question" id="qiestion" class="form-control" placeholder="Enter your question here.........">
                        <br>

                        <label for="answer1" class="form-control-label">Answer 1:</label>
                        <input type="text" name="answer1" id="answer1" class="form-control" placeholder="Enter answer number 1..........">
                        <br>

                        <label for="answer2" class="form-control-label">Answer 2:</label>
                        <input type="text" name="answer2" id="answer2" class="form-control" placeholder="Enter answer number ..........">
                        <br>

                        <label for="answer3" class="form-control-label">Answer 3:</label>
                        <input type="text" name="answer3" id="answer3" class="form-control" placeholder="Enter answer number 3..........">
                        <br>

                        <label for="answer4" class="form-control-label">Answer 4:</label>
                        <input type="text" name="answer4" id="answer4" class="form-control" placeholder="Enter answer number 4..........">
                        <br>

                        <label for="correct_answer" class="form-control-label">Correct answer:</label>
                        <select name="correct_answer" id="correct_answer" class="form-control">
                            <option selected hidden disabled>---Select answer---</option>
                            <option value="answer1">Answer 1</option>
                            <option value="answer2">Answer 2</option>
                            <option value="answer3">Answer 3</option>
                            <option value="answer4">Answer 4</option>
                        </select>                       
                        <br>

                        <label for="points" class="form-control-label">Points:</label>
                        <input type="text" name="points" id="points" class="form-control" placeholder="Enter points for this question.........">
                        <br>

                        <label for="difficulty" class="form-control-label">Difficulty:</label>
                        <select name="difficulty" id="difficulty" class="form-control">
                            <option selected hidden disabled>---Select answer---</option>
                            @foreach($question_difficulties as $qd)
                                <option value="{{ $qd->id }}">{{ $qd->difficulty }}</option>
                            @endforeach
                        </select>
                        <br>

                        <input type="submit" value="Create question" class="btn btn-outline-success">

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

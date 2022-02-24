@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add question') }}</div>

                <div class="card-body">
                    <form action="{{ route('questions.update', $question->id) }}" method="post">
                        @csrf
                        @method("PUT")

                        <label for="question" class="form-control-label">Question:</label>
                        @if ($errors->has('question'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->get('question')[0] }}</strong>
                            </span>
                        @endif
                        <input type="text" name="question" id="qiestion" class="form-control" placeholder="Enter your question here........." value="{{$question->question}}">
                        <br>

                        <label for="answer1" class="form-control-label">Answer 1:</label>
                        @if ($errors->has('answer1'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->get('answer1')[0] }}</strong>
                            </span>
                        @endif
                        <input type="text" name="answer1" id="answer1" class="form-control" placeholder="Enter answer number 1.........." value="{{$answers[0]->answer}}">
                        <br>

                        <label for="answer2" class="form-control-label">Answer 2:</label>
                        @if ($errors->has('answer2'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->get('answer2')[0] }}</strong>
                            </span>
                        @endif
                        <input type="text" name="answer2" id="answer2" class="form-control" placeholder="Enter answer number 2.........." value="{{$answers[1]->answer}}">
                        <br>

                        <label for="answer3" class="form-control-label">Answer 3:</label>
                        @if ($errors->has('answer3'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->get('answer3')[0] }}</strong>
                            </span>
                        @endif
                        <input type="text" name="answer3" id="answer3" class="form-control" placeholder="Enter answer number 3.........." value="{{$answers[2]->answer}}">
                        <br>

                        <label for="answer4" class="form-control-label">Answer 4:</label>
                        @if ($errors->has('answer4'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->get('answer4')[0] }}</strong>
                            </span>
                        @endif
                        <input type="text" name="answer4" id="answer4" class="form-control" placeholder="Enter answer number 4.........." value="{{$answers[3]->answer}}">
                        <br>

                        <label for="correct_answer" class="form-control-label">Correct answer:</label>
                        @if ($errors->has('correct_answer'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->get('correct_answer')[0] }}</strong>
                            </span>
                        @endif
                        <select name="correct_answer" id="correct_answer" class="form-control">
                            @for ($i = 1; $i <= 4; $i++)
                                @php $selected = ""; @endphp
                                @if ($correct_answer == $i)
                                    @php $selected = "selected"; @endphp
                                @endif
                                <option value="answer{{$i}}" {{$selected}}>Answer {{$i}}</option>   
                            @endfor
                        </select>                       
                        <br>

                        <label for="points" class="form-control-label">Points:</label>
                        @if ($errors->has('points'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->get('points')[0] }}</strong>
                            </span>
                        @endif
                        <input type="text" name="points" id="points" class="form-control" placeholder="Enter points for this question........." value="{{$question->points}}">
                        <br>

                        <label for="difficulty" class="form-control-label">Difficulty:</label>
                        @if ($errors->has('difficulty'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->get('difficulty')[0] }}</strong>
                            </span>
                        @endif
                        <select name="difficulty" id="difficulty" class="form-control">
                            <option selected hidden disabled>---Select answer---</option>
                            @foreach($question_difficulties as $qd)
                                @php $selected = ""; @endphp
                                @if ($question->difficulty == $qd->difficulty)
                                    @php $selected = "selected"; @endphp
                                @endif
                                <option value="{{ $qd->id }}" {{$selected}}>{{ $qd->difficulty }}</option>
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

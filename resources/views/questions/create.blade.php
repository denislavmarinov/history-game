@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Добави въпрос</div>

                <div class="card-body">
                    <form action="{{ route('questions.store') }}" method="post">
                        @csrf

                        <label for="question" class="form-control-label">Въпрос:</label>
                        @if ($errors->has('question'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->get('question')[0] }}</strong>
                            </span>
                        @endif
                        <input type="text" name="question" id="qiestion" class="form-control" placeholder="Enter your question here........." value="{{old('question')}}">
                        <br>

                        <label for="answer1" class="form-control-label">Отговор 1:</label>
                        @if ($errors->has('answer1'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->get('answer1')[0] }}</strong>
                            </span>
                        @endif
                        <input type="text" name="answer1" id="answer1" class="form-control" placeholder="Enter answer number 1.........." value="{{old('answer1')}}">
                        <br>

                        
                        <label for="answer2" class="form-control-label">Отговор 2:</label>
                        @if ($errors->has('answer2'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->get('answer2')[0] }}</strong>
                            </span>
                        @endif
                        <input type="text" name="answer2" id="answer2" class="form-control" placeholder="Enter answer number 2.........." value="{{old('answer2')}}">
                        <br>

                        
                        <label for="answer3" class="form-control-label">Отговор 3:</label>
                        @if ($errors->has('answer3'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->get('answer3')[0] }}</strong>
                            </span>
                        @endif
                        <input type="text" name="answer3" id="answer3" class="form-control" placeholder="Enter answer number 3.........." value="{{old('answer3')}}">
                        <br>

                        
                        <label for="answer4" class="form-control-label">Отговор 4:</label>
                        @if ($errors->has('answer4'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->get('answer4')[0] }}</strong>
                            </span>
                        @endif
                        <input type="text" name="answer4" id="answer4" class="form-control" placeholder="Enter answer number 4.........." value="{{old('answer4')}}">
                        <br>

                        
                        <label for="correct_answer" class="form-control-label">Верен отговор:</label>
                        @if ($errors->has('correct_answer'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->get('correct_answer')[0] }}</strong>
                            </span>
                        @endif
                        <select name="correct_answer" id="correct_answer" class="form-control">
                            <option selected hidden disabled>---Избери отговор---</option>
                            <option value="answer1">Отговор 1</option>
                            <option value="answer2">Отговор 2</option>
                            <option value="answer3">Отговор 3</option>
                            <option value="answer4">Отговор 4</option>
                        </select>                       
                        <br>

                        
                        <label for="points" class="form-control-label">Точки:</label>
                        @if ($errors->has('points'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->get('points')[0] }}</strong>
                            </span>
                        @endif
                        <input type="text" name="points" id="points" class="form-control" placeholder="Enter points for this question........." value="{{old('points')}}">
                        <br>

                        
                        <label for="difficulty" class="form-control-label">Трудност:</label>
                        @if ($errors->has('difficulty'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->get('difficulty')[0] }}</strong>
                            </span>
                        @endif
                        <select name="difficulty" id="difficulty" class="form-control">
                            <option selected hidden disabled>---Избери трудност---</option>
                            @foreach($question_difficulties as $qd)
                                <option value="{{ $qd->id }}">{{ $qd->difficulty }}</option>
                            @endforeach
                        </select>
                        <br>

                        <input type="submit" value="Добави въпрос" class="btn btn-outline-success">

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

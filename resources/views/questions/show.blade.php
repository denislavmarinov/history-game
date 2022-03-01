@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Въпрос') }}</div>

                <div class="card-body">
                    @if( Session::has('message') )
                        <div class="alert alert-success">
                            {{ Session::get('message') }}
                        </div>
                    @endif
                    <table class="table">
                        <tr>
                            <th>Въпрос:</th>
                            <td colspan="2">{{ $question->question }}</td>
                        </tr>
                        <tr>
                            <th>Отговори:</th>
                            <td colspan="2">
                                <table width="100%">
                                    @foreach(json_decode($question->answers) as $answer)
                                        <tr>
                                            <td><b>{{ $answer->answer_type == "c" ? "Верен" : "Грешен" }}</b>:</td>
                                            <td>{{ $answer->answer }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <th>Точки:</th>
                            <td colspan="2">{{ $question->points }}</td>
                        </tr>
                        <tr>
                            <th>Трудност:</th>
                            <td colspan="2">{{ $question->difficulty }}</td>
                        </tr>
                        <tr>
                            <th>Добавен на </th>
                            <td>{{ $question->added_at }}</td>
                            <th>Добавен от</th>
                            <td>{{ auth()->user($question->added_by)->username }}</td>
                        </tr>
                        <tr>
                            <th>Редактиран на</th>
                            <td>{{ isset($question->updated_at) ? $question->updated_at : "-" }}</td>
                            <th>Редактиран от</th>
                            <td>{{ isset($question->updated_by) ? auth()->user($question->updated_by)->username : "-" }}</td>
                        </tr>
                        <tr>
                            <th>Изтрит на</th>
                            <td>{{ isset($question->deleted_at) ? $question->deleted_at : "-" }}</td>
                            <th>Изтрит от</th>
                            <td>{{ isset($question->deleted_by) ? auth()->user($question->deleted_by)->username : "-" }}</td>
                        </tr>
                        <tr>
                            <td>
                                <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-warning">Редактирай</a>
                            </td>
                            <td> 
                                @if (!isset($question->deleted_at))
                                <form action="{{ route('questions.soft_delete', $question->id) }}" method="post">
                                    @csrf
                                    @method("PUT")

                                    <input type="submit" class="btn btn-outline-danger" value="Премахни от игра">
                                </form>
                                @else
                                <form action="{{ route('questions.return_in_game', $question->id) }}" method="post">
                                    @csrf
                                    @method("PUT")

                                    <input type="submit" class="btn btn-outline-success" value="Върни в игра">
                                </form>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-danger delete-btns" data-id="question_{{$question->id}}">Изтрий</button>
                                <form action="{{ route('questions.destroy', $question->id) }}" method="post" id="question_{{$question->id}}">
                                    @csrf
                                    @method("DELETE")
                                </form>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(".delete-btns").each(function(e){
        e.preventDefault;
        $(this).on("click", function(e){
            e.preventDefault;
            let answer = prompt("Наистина ли искате да изтриете този въпрос? (Yes/No)");
            
            if (answer == "Yes" || answer == "yes" || answer == "YES")
            {
                let id = "#" + $(this).data("id");
                $(id).submit();
            }
            else
            {
                e.preventDefault;
            }
        })
    });
</script>
@endsection

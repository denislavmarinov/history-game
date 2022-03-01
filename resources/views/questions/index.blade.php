@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Всички въпроси</div>

                <div class="card-body">
                    @if( Session::has('message') )
                        <div class="alert alert-success">
                            {{ Session::get('message') }}
                        </div>
                    @endif
                    <div class="row">
                            <div class="col-1 offset-6">
                                <label for="search" class="form-control-label">Търси:</label>
                            </div>
                            <div class="col-5">
                                <form method="post">
                                    <input type="text" id="search" class="form-control">
                                </form>
                            </div>
                    </div>
                    <br>

                    <table class="table">
                        <tr id="head">
                            <th>#</th>
                            <th>Въпрос</th>
                            <th>Точки</th>
                            <th>Трудност</th>
                            <th>Редактирай</th>
                            <th>Премахни от игра</th>
                            <th>Изтрий</th>
                        </tr>
                        @php $num = 1; @endphp
                        @foreach($questions as $question)
                            <tr data-question="{{ str_split($question->question, 15)[0] }}">
                                <td>{{ $num++ }}</td>
                                <td>
                                    <a href="{{ route('questions.show', $question->id) }}">
                                        {{ str_split($question->question, 15)[0] }}...
                                    </a>
                                </td>
                                <td>{{ $question->points }}</td>
                                <td>{{ $question->difficulty }}</td>
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
                        @endforeach
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

    function search()
    {
        let column = "question",
            search = $("#search").val();

        $("tr").each( function () { 

            if ($(this).attr("id") != "head")
            {
                if($(this).data(column).includes(search))
                {
                    $(this).show();
                }
                else
                {
                    $(this).hide();
                }
            }
        });

    }
    $("#search").on("input", search);
</script>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('All questions') }}</div>

                <div class="card-body">

                    <div class="row">
                            <div class="col-1 offset-6">
                                <label for="search" class="form-control-label">Search:</label>
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
                            <th>Question</th>
                            <th>Points</th>
                            <th>Difficulty</th>
                            <th>Edit</th>
                            <th>Remove from games</th>
                            <th>Delete</th>
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
                                    <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-warning">Edit</a>
                                </td>
                                <td>
                                    @if (!isset($question->deleted_at))
                                    <form action="{{ route('questions.soft_delete', $question->id) }}" method="post">
                                        @csrf
                                        @method("PUT")

                                        <input type="submit" class="btn btn-outline-danger" value="Remove from games">
                                    </form>
                                    @else
                                    <form action="{{ route('questions.return_in_game', $question->id) }}" method="post">
                                        @csrf
                                        @method("PUT")

                                        <input type="submit" class="btn btn-outline-success" value="Return in games">
                                    </form>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-danger delete-btns" data-id="question_{{$question->id}}">Delete</button>
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
            let answer = prompt("Do you really want to delete this question? (Yes/No)");
            
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

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('All questions') }}</div>

                <div class="card-body">
                    <table class="table">
                        <tr>
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
                            <tr>
                                <td>{{ $num++ }}</td>
                                <td>
                                    <a href="{{ route('questions.show', $question->id) }}">
                                        {{ implode("", str_split($question->question, 30)) }}...
                                    </a>
                                </td>
                                <td>{{ $question->points }}</td>
                                <td>{{ $question->difficulty }}</td>
                                <td>
                                    <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-warning">Edit</a>
                                </td>
                                <td>
                                    <form action="{{ route('questions.soft_delete', $question->id) }}" method="post">
                                        @csrf
                                        @method("PUT")

                                        <input type="submit" class="btn btn-danger" value="Remove from games">
                                    </form>
                                </td>
                                <td>
                                    <!-- Part of further development -->
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

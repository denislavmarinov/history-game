@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Question') }}</div>

                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>Question:</th>
                            <td colspan="2">{{ $question->question }}</td>
                        </tr>
                        <tr>
                            <th>Answers:</th>
                            <td colspan="2">
                                <table width="100%">
                                    @foreach(json_decode($question->answers) as $answer)
                                        <tr>
                                            <td><b>{{ $answer->answer_type == "c" ? "Correct" : "Wrong" }}</b>:</td>
                                            <td>{{ $answer->answer }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <th>Points:</th>
                            <td colspan="2">{{ $question->points }}</td>
                        </tr>
                        <tr>
                            <th>Difficulty:</th>
                            <td colspan="2">{{ $question->difficulty }}</td>
                        </tr>
                        <tr>
                            <th>Added at</th>
                            <td>{{ $question->added_at }}</td>
                            <th>Added by</th>
                            <td>{{ $question->added_by }}</td>
                        </tr>
                        <tr>
                            <th>Updated at</th>
                            <td>{{ isset($question->updated_at) ? $question->updated_at : "-" }}</td>
                            <th>Updated by</th>
                            <td>{{ isset($question->updated_by) ? $question->updated_by : "-" }}</td>
                        </tr>
                        <tr>
                            <th>Removed from games at</th>
                            <td>{{ isset($question->deleted_at) ? $question->deleted_at : "-" }}</td>
                            <th>Removed from games by</th>
                            <td>{{ isset($question->deleted_by) ? $question->deleted_by : "-" }}</td>
                        </tr>
                        <tr>
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
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

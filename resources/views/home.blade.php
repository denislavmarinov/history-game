@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">Начално табло</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h3 class="text-center">Последните 5 въпроса:</h3>
                    <br><br>
                    <table class="table">
                        <tr>
                            <td>#</td>
                            <td>Резултат</td>
                            <td>Точки</td>
                            <td>Време за приключване на игра</td>
                            <td>Дата</td>
                        </tr>
                        @php $num = 1; @endphp
                        @if (!empty($logs))
                            @foreach($logs as $log)
                                <tr>
                                    <td>{{ $num++ }}</td>
                                    <td class="text-{{ $log->status ? 'success' : 'danger'}}">{{ $log->status ? "Победа" : "Загуба"}}</td>
                                    <td>{{ $log->points }}</td>
                                    <td>{{ $log->game_completion_time }}</td>
                                    <td>{{ date_format(date_create($log->started_at), "d.m.Y") }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center">Няма последни игри</td>
                            </tr>    
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

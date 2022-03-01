@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Играта свърши') }}</div>

                <div class="card-body">
                    <h3 class="text-center">Данни за игра</h3>
                    <table class="table">
                        <tr>
                            <th>Точки</th>
                            <td>{{ $data['points'] }}</td>
                        </tr>
                        <tr>
                            <th>Статус</th>
                            <td class="text-{{ $data['status'] ? 'success' : 'danger'}}">{{ $data['status'] ? "Победа" : "Загуба"}}</td>
                        </tr>
                        <tr>
                            <th>Време за завършване</th>
                            <td>{{ $data['game_completion_time'] }}</td>
                        </tr>
                        <tr>
                            <th>Начало</th>
                            <td>{{ date_format(date_create($data['started_at']), "d.m.Y H:i:s") }}</td>
                        </tr>
                        <tr>
                            <th>Край</th>
                            <td>{{ date_format(date_create($data['finished_at']), "d.m.Y H:i:s") }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

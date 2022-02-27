@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Game over') }}</div>

                <div class="card-body">
                    <h3 class="text-center">Game stats</h3>
                    <table class="table">
                        <tr>
                            <th>Points</th>
                            <td>{{ $data['points'] }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td class="text-{{ $data['status'] ? 'success' : 'danger'}}">{{ $data['status'] ? "Win" : "Loss"}}</td>
                        </tr>
                        <tr>
                            <th>Time for completion</th>
                            <td>{{ $data['game_completion_time'] }}</td>
                        </tr>
                        <tr>
                            <th>Started at</th>
                            <td>{{ date_format(date_create($data['started_at']), "d.m.Y H:i:s") }}</td>
                        </tr>
                        <tr>
                            <th>Finished at</th>
                            <td>{{ date_format(date_create($data['finished_at']), "d.m.Y H:i:s") }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

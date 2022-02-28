@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h3 class="text-center">Last 5 games:</h3>
                    <br><br>
                    <table class="table">
                        <tr>
                            <td>#</td>
                            <td>Status</td>
                            <td>Points</td>
                            <td>Game completion time</td>
                            <td>Date</td>
                        </tr>
                        @php $num = 1; @endphp
                        @if (!empty($logs))
                            @foreach($logs as $log)
                                <tr>
                                    <td>{{ $num++ }}</td>
                                    <td class="text-{{ $log->status ? 'success' : 'danger'}}">{{ $log->status ? "Win" : "Loss"}}</td>
                                    <td>{{ $log->points }}</td>
                                    <td>{{ $log->game_completion_time }}</td>
                                    <td>{{ date_format(date_create($log->started_at), "d.m.Y") }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center">There is no game history</td>
                            </tr>    
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
    @if (Auth::check())
        <div class="row">
        <div class="card">
            <div class="card-header">
                <p class="card-title">{{ $user->name }}</p>
            </div>
            <div class="card-body">
                <img class="rounded-circle img-fluid" src="{{ Gravatar::src($user->name, 100) }}" alt="">
            </div>
        </div>
        <div class="col">
            <h2>TotalTime:{{ $user_time }}</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            {!! $cal_tag !!}
            
            @include('activities.create_activity')
            
        </div>
        <div class="col-md-4 card">
            @if (count($activities) > 0)
                @include('activities.activities', ['activities' => $activities])
            @endif
        </div>
    </div>
    @else
    <div class="center jumbotron">
        <div class="text-center">
            <h1>Actpile</h1>
            <p>共有できるカレンダー式の活動記録</p>
            {!! link_to_route('signup.get', '新規登録', [], ['class' => 'btn btn-lg btn-primary']) !!}
            {!! link_to_route('login.post', 'ログイン', [], ['class' => 'btn btn-lg btn-primary']) !!}
        </div>
    </div>
    @endif
@endsection
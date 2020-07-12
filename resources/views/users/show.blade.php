@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <p class="card-title">{{ $user->name }}</p>
            </div>
            <div class="card-body">
                <img class="rounded-circle img-fluid" src="{{ Gravatar::src($user->name, 100) }}" alt="">
            </div>
            <div>
                @include('user_follow.follow_button', ['user' => $user])
            </div>
        </div>
        <div>
            <h2>TotalTime:{{ $user_time }}</h2>
        </div>

    </div>
    <div class="row">
        <div class="col-md-8">
            {!! $cal_tag !!}
            @include('activities.create_activity')
        </div>
        <div class="col-md-4">
        @include('users.navtabs', ['user' => $user])
        @if (count($activities) > 0)
            @include('activities.activities', ['activities' => $activities])
        @endif
        </div>
    </div>
@endsection
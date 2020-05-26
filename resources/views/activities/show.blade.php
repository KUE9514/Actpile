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
            
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            {!! $cal_tag !!}
            
            <p>日付:{!! $activity->day !!}</p>
            <p>活動内容：{!! $activity->title !!}</p>
            <p>活動時間：{!! $activity->time !!}</p>
            <p>メモ：{!! $activity->content !!}</p>
            
            {!! link_to_route('comments.show', 'コメント', ['id' => $activity->id], ['class' => 'btn btn-light btn-sm']) !!}
            
            @if (Auth::id() == $activity->user_id)
                {!! link_to_route('activity.edit', '編集', ['id' => $activity->user->id, 'activity_id' => $activity->id], ['class' => 'btn btn-light btn-sm']) !!}
            
                {!! Form::open(['route' => ['activities.destroy', $activity->id], 'method' => 'delete']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                {!! Form::close() !!}
            @endif
        </div>
        
        <div class="col-md-4">
        @include('users.navtabs', ['user' => $user])
        @if (count($activities) > 0)
            @include('activities.activities', ['activities' => $activities])
        @endif
        </div>
    </div>
@endsection
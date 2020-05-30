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
            <p>活動時間：{!! substr($activity->time, 0, 5) !!}</p>
            <p>メモ：{!! $activity->content !!}</p>
            
            {!! Form::open(['route' => ['comments.store', $activity->id]]) !!}
            {{ Form::hidden('activity_id',$activity->id) }}
            {!! Form::label('comments', 'コメント') !!}
            {!! Form::textarea('comments', old('comments')) !!}
            {!! Form::submit('コメントする', ['class' => "btn btn-dark btn-sm"]) !!}
            {!! Form::close() !!}
            
        </div>
        <div class="col-md-4">
            <ul class="list-unstyled">
                @foreach($comments as $comment)
                    <li class="media mb-3">
            <img class="mr-2 rounded-circle" src="{{ Gravatar::src($activity->user->name, 50) }}" alt="">
            <div class="media-body">
                <div>
                    {!! link_to_route('users.show', $activity->user->name, ['id' => $activity->user->id]) !!}
                </div>
                <div>
                    {!! $comment->created_at !!}
                </div>
                <div>
                    {!! $comment->comments !!}
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
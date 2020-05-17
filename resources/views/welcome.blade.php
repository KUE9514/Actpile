@extends('layouts.app')

@section('content')
    @if (Auth::check())
        <div class="row">
        <div class="card">
            <div class="card-header">
                <p class="card-title">{{ $user->name }}</p>
            </div>
            <div class="card-body">
                <img class="rounded img-fluid" src="{{ Gravatar::src($user->name, 100) }}" alt="">
            </div>
        </div>
        <div>
            <P>合計時間</P>
            <P>合計時間</P>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7">
            {!! $cal_tag !!}
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
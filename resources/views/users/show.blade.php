@extends('layouts.app')

@section('content')
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
@endsection
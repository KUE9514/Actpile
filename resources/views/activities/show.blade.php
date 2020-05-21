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
            <P>合計時間</P>
            <P>合計時間</P>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            {!! $cal_tag !!}
            <ul class="list-unstyled">

                <div>
           
                </div>
                <div>
                    {!! $activities !!}
                </div>    
                <div>
                   
                </div>
   
        </div>
        <div class="col-md-4">

        
        </div>
    </div>
@endsection
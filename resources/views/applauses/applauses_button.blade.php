@if (Auth::id() != $user->id)
    {!! Form::open(['route' => ['applauses.applause', $activity->id]]) !!}
            {!! Form::submit('拍手', ['class' => "btn btn-light btn-sm"]) !!}
    {!! Form::close() !!}
@endif
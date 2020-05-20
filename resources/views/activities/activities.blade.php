<ul class="list-unstyled">
    @foreach ($activities as $activity)
        <li class="media mb-3">
            <img class="mr-2 rounded-circle" src="{{ Gravatar::src($activity->user->name, 50) }}" alt="">
            <div class="media-body">
                <div>
                    {!! link_to_route('users.show', $activity->user->name, ['id' => $activity->user->id]) !!}
                </div>
                <div>
                    {!! $activity->day !!}
                </div>    
                <div>
                    {!! $activity->title !!}
                    {!! $activity->time !!}
                    <p class="mb-0">{!! $activity->content !!}</p>
                </div>
                <div>
                    {!! Form::submit('拍手', ['class' => 'btn btn-light btn-sm']) !!}
                    @if (Auth::id() == $activity->user_id)
                        {!! Form::open(['route' => ['activities.destroy', $activity->id], 'method' => 'delete']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                        {!! Form::close() !!}
                    @endif
                </div>
            </div>
        </li>
    @endforeach
</ul>
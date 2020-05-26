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
                    {!! $activity->id !!}
                </div>    
                <div>
                    {!! $activity->title !!}
                    {!! $activity->time !!}
                    <p class="mb-0">{!! $activity->content !!}</p>
                </div>
                <div class="row">
                    <div class="col-3">
                    {!! link_to_route('activity.show', '詳細', ['id' => $activity->user->id, 'activity_id' => $activity->id], ['class' => 'btn btn-light btn-sm']) !!}
                    </div>
                    <div class="col-３">
                    {!! link_to_route('comments.show', 'コメント', ['id' => $activity->id], ['class' => 'btn btn-light btn-sm']) !!}
                    </div>
                    
                    <div class="col-3">
                        @if (Auth::User()->is_applauses($activity->id))
                            {!! Form::open(['route' => ['applauses.applause', $activity->id]]) !!}
                                {!! Form::submit('拍手', ['class' => "btn btn-success btn-sm"]) !!}
                            {!! Form::close() !!}
                            
                        @else
                            {!! Form::open(['route' => ['applauses.applause', $activity->id]]) !!}
                                {!! Form::submit('拍手', ['class' => "btn btn-light btn-sm"]) !!}
                            {!! Form::close() !!}
                        @endif
                        <span class="badge badge-secondary">{{ $count_applauses }}</span>
                    </div>    
                </div>
            </div>
        </li>
    @endforeach
</ul>
{{ $activities->links('pagination::bootstrap-4') }}
<ul class="list-unstyled">
    @foreach ($activities as $activity)
        <li class="media mb-3">
            <img class="mr-2 rounded" src="{{ Gravatar::src($activity->user->name, 50) }}" alt="">
            <div class="media-body">
                <div>
                    {!! link_to_route('users.show', $activity->user->name, ['id' => $activity->user->id]) !!}
                </div>
                <div>
                   
                </div>
            </div>
        </li>
    @endforeach
</ul>
@if (count($users) > 0)
    <ul class="list-unstyled">
        @foreach ($users as $user)
            <li class="media">
                <img class="mr-2 rounded-circle" src="{{ Gravatar::src($user->name, 50) }}" alt="">
                <div class="media-body">
                    <div>
                        {{ $user->name }}
                    </div>
                    <div>
                        <p>{!! link_to_route('users.show', 'View profile', ['id' =>$user->id]) !!}</p>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
     {{ $users->links('pagination::bootstrap-4') }}
@endif
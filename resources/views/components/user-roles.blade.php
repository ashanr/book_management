@if ($user->roles->count() > 0)
    <ul>
        @foreach ($user->roles as $role)
            <li>{{ $role->name }}</li>
        @endforeach
    </ul>
@endif

<x-layout>
    <h1 class="text-xl font-normal">All profiles</h1>
    @if (count($users))
        <ul>
        @foreach ($users as $user)
            <li><a class="hover:text-blue-500" href="{{ route('user.profile',$user) }}">{{ $user->email }}</a> | {{ $user->comments_count }}</li>
        @endforeach
        </ul>
    @else
        <p>No users...</p>
    @endif
</x-layout>

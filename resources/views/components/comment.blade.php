@props(['comment','parent' => null,'user' => null])
<div class="border rounded shadow-md mb-2">
    <div class="border-b">
        <div class="py-1 px-3 flex gap-1 items-baseline">
            {{-- @if ($parent)
                <span class="text-sm italic"> Answer to <strong>{{ $parent->header }}</strong> by {{ $parent->user->email }}:</span>
            @endif --}}
            <h3 class="font-medium">{{ $comment->header }}</h3>
            <span class="text-sm">by {{ $user ? $user->email : $comment->user->email }}</span>
            {{-- @auth
                @if ((!$comment->deleted && (auth()->user()->can('own_comment', $comment)) || auth()->user()->can('own_profile', $user)))
                    <x-delete_comment_form :comment-id="$comment->id"/>
                @endif
            @endauth --}}
        </div>
    </div>
    <div class="border-b">
        <p class="py-2 px-3">
            <span>{{ $comment->description }}</span>
        </p>
    </div>
    <div class="py-0.5 px-3 flex items-baseline">
        <span class="text-xs">{{ $comment->updated_at }}</span>
    </div>
</div>


{{-- <div x-data="{ showForm: false }" class="mb-2">
    <div class="border rounded shadow-md">
        <div class="border-b">
            <div class="py-1 px-3 flex gap-1 items-baseline">
                @if ($parent)
                    <span class="text-sm italic"> Answer to <strong>{{ $parent->header }}</strong> by {{ $parent->user->username }}:</span>
                @endif
                <h3 class="font-medium">{{ $comment->header }}</h3>
                <span class="text-sm">by {{ $comment->user->username }}</span>
                @auth
                    @if (!$comment->deleted && (auth()->user()->can('manage_comments', $comment->user) || auth()->user()->can('delete_comment',$comment)))
                        <form action="{{ route('user.comment.delete') }}" method="POST" class="ml-auto">
                            @csrf
                            <input type="hidden" name="id" value="{{ $comment->id }}"/>
                            <button class="border rounded py-0.5 px-1 hover:bg-red-500 hover:text-white text-sm" type="submit">Delete</button>
                        </form>
                    @endif
                @endauth
            </div>
        </div>
        <div class="border-b">
            <p class="py-2 px-3">

                <span>{{ $comment->description }}</span>
            </p>
        </div>
        <div class="py-0.5 px-3 flex items-baseline">
            <span class="text-xs">{{ $comment->updated_at }}</span>
            @auth
                @can('add_comment',$comment)
                    <button x-on:click="showForm = !showForm" type="button" class="ml-auto text-sm" x-text="!showForm ? 'Reply' : 'Hide'"></button>
                @endcan
            @endauth
        </div>
    </div>
    @auth
        @can('add_comment',$comment)
            <div x-cloak x-show="showForm" class="mt-2">
                <x-add_comment_form :comment-id="$comment->id"/>
            </div>
        @endcan
    @endauth

</div> --}}

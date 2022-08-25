@props(['user','subject' => 'page'])

<div class="pt-2 pb-2 flex items-baseline border-b">
    <h2 class="text-xl">{{ $user->email }}'s <span class="text-base">{{ $subject }}</span></h2>
    @auth
        <div class="ml-auto flex gap-1 items-baseline">

            @can('share_library',$user)
                <form action="{{ route('user.share',[$user->id,auth()->user()]) }}" method="POST">
                    @csrf
                    <button class="text-sm border rounded px-1.5 py-0.5 hover:bg-blue-400 hover:text-white"
                        type="submit">
                            Share user
                    </button>
                </form>
            @elsecan('deny_library',$user)
                <a class="text-sm border rounded px-1.5 py-0.5 hover:bg-blue-400 hover:text-white" href="{{ route('user.books',$user->id) }}">View library</a>
                <form action="{{ route('user.share',[$user->id,auth()->user()]) }}" method="POST">
                    @csrf
                    <button class="text-sm border rounded px-1.5 py-0.5 hover:bg-red-500 hover:text-white"
                        type="submit">
                        Deny user
                    </button>
                </form>
            @endcan
        </div>
    @endauth
</div>

<x-layout>
    <div class="mt-2 mb-3">
        <h2 class="text-xl">{{ $user->email }}'s comments page</h2>
        <hr>
    </div>
    <h3 class="text-xl">Comments</h3>
    <section>
        @if (count($user->onlyComments))
            @foreach ($user->onlyComments as $comment)
                <div class="mb-2">
                    <div class="border rounded shadow-md">
                        <div class="border-b">
                            <div class="py-1 px-3 flex gap-1 items-baseline">
                                <h3 class="font-medium">{{ $comment->header }}</h3>
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
                </div>
            @endforeach
        @else
            <p>No comments...</p>
        @endif
    </section>
</x-layout>

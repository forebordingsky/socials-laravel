<x-layout>
    <div class="pt-2 pb-2 flex items-baseline border-b">
        <h2 class="text-xl">{{ $user->email }}'s <span class="text-base">comments page</span></h2>
    </div>
    <h3 class="text-xl mb-1">Comments</h3>
    <section>
        @if (count($comments))
            @foreach ($comments as $comment)
                <div class="mb-2">
                    <div class="border rounded shadow-md">
                        <div class="border-b">
                            <div class="py-1 px-3 flex gap-1 items-baseline">
                                @if ($comment->parent)
                                    <span class="text-sm italic">Answer to <strong>{{ $comment->parent->header }}</strong> by {{ $comment->parent->user->email }}:</span>
                                @endif
                                <h3 class="font-medium">{{ $comment->header }}</h3>
                                <span class="text-sm">by {{ $user->email }}</span>
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

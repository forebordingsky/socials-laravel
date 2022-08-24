<div class="ml-2">
    <x-comment :comment="$comment" :parent="$parent"/>
    @if (count($comment->replies))
        @foreach ($comment->replies as $reply)
            @include('child_comment',['comment' => $reply, 'parent' => $comment])
        @endforeach
    @endif
</div>

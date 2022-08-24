@props(['commentId'])

<form action="{{ route('user.comment.delete') }}" method="POST" class="ml-auto">
    @csrf
    <input type="hidden" name="id" value="{{ $commentId }}"/>
    <button class="border rounded py-0.5 px-1 hover:bg-red-500 hover:text-white text-sm" type="submit">Delete</button>
</form>

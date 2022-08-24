@props(['commentId'])
<form action="{{ route('user.comment.add') }}" method="POST" class="border rounded py-2 px-3 ml-3">
    @csrf
    <input type="hidden" name="answered_comment_id" value="{{ $commentId }}"/>
    <div class="flex mb-2">
        <label>Header</label>
        <input class="ml-2 border-b w-full focus:border-b-2 focus:outline-none" type="text" name="header" value="{{ old('header') }}">
        @error('header')
            <label class="error">{{ $message }}</label>
        @enderror
    </div>
    <div class="flex flex-col mb-2">
        <label class="mb-1">Description</label>
        <textarea name="description" rows="3" class="border rounded focus:outline-none focus:border-2 text-sm p-1">{{ old('description') }}</textarea>
        @error('description')
            <label class="error">{{ $message }}</label>
        @enderror
    </div>
    <button class="border rounded px-1.5 py-0.5 hover:bg-blue-400 hover:text-white" type="submit">Add comment</button>
</form>

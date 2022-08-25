@php
    $auth = auth()->check();
    $userId = $auth ? auth()->user()->id : false;
    $owner = $auth && ($userId === $user->id);
@endphp
<x-layout>
    <x-top :user="$user" subject="profile page"/>
    <div>
        <h3 class="text-xl mb-1">Dashboard</h3>
        @if ($user->user_comments_count > 0)
        <comments-list-wrapper
            :comments="{{ json_encode($user->latestComments) }}"
            :count="{{ $user->user_comments_count }}"
            :auth="{{ $auth ? 'true' : 'false' }}"
            :owned="{{ $owner ? 'true' : 'false' }}"
            :profile-id="{{ $user->id }}"
            :user-id="{{ $userId ?? 'false' }}"/>
        @else
            <p>No comments...</p>
        @endif
    </div>
    @can('add_comment',$user)
        <section class="my-2">
            <h3 class="text-xl mb-1">Add comment</h3>
            <form action="{{ route('user.comment.add',auth()->user()) }}" method="POST" class="border rounded py-2 px-3 shadow-md">
                @csrf
                <div class="mb-2">
                    <div class="flex">
                        <label>Header</label>
                        <input class="ml-2 border-b w-full focus:border-b-2 focus:outline-none" type="text" name="header" value="{{ old('header') }}">
                    </div>
                    @error('header')
                        <label class="text-sm text-red-500">{{ $message }}</label>
                    @enderror
                </div>
                <div class="flex flex-col mb-2">
                    <label class="mb-1">Description</label>
                    <textarea name="description" rows="3" class="border rounded focus:outline-slate-200 text-sm p-1">{{ old('description') }}</textarea>
                    @error('description')
                        <label class="text-sm text-red-500">{{ $message }}</label>
                    @enderror
                </div>
                <button class="border rounded px-1.5 py-0.5 hover:bg-blue-400 hover:text-white" type="submit">Add comment</button>
            </form>
        </section>
    @endcan
</x-layout>

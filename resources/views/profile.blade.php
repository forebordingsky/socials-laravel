<x-layout>
    <div class="mt-2 mb-3">
        <h2 class="text-xl">{{ $user->email }}'s profile page</h2>
        <hr>
    </div>
    <div>
        @if ($user->comments_count > 0)
        <comments-list-wrapper :comments="{{ json_encode($user->latestComments) }}"
                                :count="{{ $user->comments_count }}"
                                :auth="{{ auth()->check() ? 'true' : 'false' }}"
                                :owned="{{ auth()->check() && auth()->user()->id == $user->id ? 'true' : 'false' }}"
                                :profile-id="{{ $user->id }}"
                                :user-id="{{ auth()->check() ? auth()->user()->id : 'false' }}"/>
        @else
            <p>No comments...</p>
        @endif
    </div>
    @can('own_profile',$user)
        <section class="mt-3">
            <h3 class="text-xl">Add comment</h3>
            <form action="{{ route('user.comment.add') }}" method="POST" class="border rounded py-2 px-3 shadow-md">
                @csrf
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
        </section>
    @endcan

</x-layout>

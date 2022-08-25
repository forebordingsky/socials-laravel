<x-layout>
    <div class="mt-2">
        <form action="{{ route('user.book.store',auth()->user()) }}" method="POST" class="border rounded py-2 px-3 shadow-md ">
            @csrf
            <div class="mb-2">
                <div class="flex">
                    <label>Name</label>
                    <input class="ml-2 border-b w-full focus:outline-slate-200" type="text" name="name" value="{{ old('name') }}" placeholder="Book name">
                </div>
                @error('name')
                    <label class="text-sm text-red-500">{{ $message }}</label>
                @enderror
            </div>
            <div class="flex flex-col mb-2">
                <label class="mb-1">Book content</label>
                <textarea name="content" rows="10" class="border rounded focus:outline-slate-200 text-sm p-1">{{ old('content') }}</textarea>
                @error('content')
                    <label class="text-sm text-red-500">{{ $message }}</label>
                @enderror
            </div>
            <div class="flex justify-between">
                <button class="border rounded px-1.5 py-0.5 hover:bg-blue-400 hover:text-white" type="submit">
                    Create
                </button>
                <div class="flex gap-1 items-center">
                    <input type="checkbox"
                            name="link_access"
                            id="link"
                            value="1"
                            {{ old('likn_access') == 1 ? 'checked' : '' }}
                            class="hover:cursor-pointer"
                            />
                    <label for="link" class="hover:cursor-pointer text-sm">Allow link access</label>
                </div>
            </div>
        </form>
    </div>
</x-layout>

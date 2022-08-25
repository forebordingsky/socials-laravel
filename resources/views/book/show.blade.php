<x-layout>
    <div class="mt-2 mb-3">
        <h2 class="text-xl">{{ ucwords($book->name) }} book by{{ $user->email }}</h2>
        <hr>
    </div>
    <div>
        {{ $book->content }}
    </div>
</x-layout>

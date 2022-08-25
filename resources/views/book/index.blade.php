<x-layout>
    <div class="mt-2 mb-3 flex gap-2 items-baseline">
        <h2 class="text-xl">{{ $user->email }}'s library page</h2>
        <a class="border rounded px-1.5 py-0.5 bg-blue-400 text-white hover:bg-transparent hover:text-blue-400"
            href="{{ route('user.book.create',$user) }}">
            Create Book
        </a>
    </div>
    @if (count($user->books))
        <table class="w-full border-l border-r shadow-md">
            <tr class="bg-blue-400 text-white">
                <th class="w-1/12 text-center">№</th>
                <th class="w-8/12 text-left">Name</th>
                <th class="w-2/12 text-center">Updated at</th>
                <th colspan="3"></th>
            </tr>
            @foreach ($user->books as $index => $book)
                <tr class="border-b">
                    <td class="text-center">{{ ++$index}}</td>
                    <td>{{ $book->name }}</td>
                    <td class="text-center">{{ $book->updated_at }}</td>
                    <td>
                        <a href="{{ route('user.book.show',[$user->id,$book->id]) }}"
                            class="text-sm border rounded px-1.5 py-0.5 hover:bg-blue-400 hover:text-white">
                            View
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('user.book.edit',[$user->id,$book->id]) }}"
                            class="text-sm border rounded px-1.5 py-0.5 hover:bg-blue-400 hover:text-white">
                            Edit
                        </a>
                    </td>
                    <td>
                        <form action="{{ route('user.book.delete',[$user->id,$book->id]) }}" method="POST">
                            @method('delete')
                            @csrf
                            <button type="submit" class="text-sm border rounded px-1.5 py-0.5 hover:bg-red-500 hover:text-white">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <p>No books...</p>
    @endif
</x-layout>

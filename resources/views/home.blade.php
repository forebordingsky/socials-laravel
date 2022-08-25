<x-layout>
    <h1 class="text-xl font-normal">All profiles</h1>
    @if (count($users))
        <table class="w-full border-l border-r shadow-md">
            <tr class="bg-blue-400 text-white">
                <th class=" w-1/12 text-center">№</th>
                <th class="text-left">Email</th>
            </tr>
            @foreach ($users as $index => $user)
                <tr class="hover:bg-slate-100">
                    <td class="text-center">{{ $index }}</td>
                    <td>
                        <a href="{{ route('user.profile',$user->id) }}"
                            class="hover:text-blue-400">
                            {{ $user->email }}
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <p>No users...</p>
    @endif
</x-layout>

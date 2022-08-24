<x-layout>
    <div class="w-2/3 mx-auto">
        <h1 class="text-xl mt-2 ml-3">Register Page</h1>
        <form method="POST" action="{{ route('auth.register.handler') }}" class="mt-2 px-3 py-2 border rounded">
            @csrf
            <div class="flex my-3 flex-col">
                <input type="email" class="border-b w-full focus:outline-none focus:border-b-2" name="email" placeholder="Email" value="{{ old('email') }}"/>
                @error('email')
                    <label class="ml-2 text-red-400 text-sm">{{ $message }}</label>
                @enderror
            </div>
            <div class="flex my-3 flex-col">
                <input type="password" class="border-b w-full focus:outline-none focus:border-b-2" name="password" placeholder="Password"/>
                @error('password')
                    <label class="ml-2 text-red-400 text-sm">{{ $message }}</label>
                @enderror
                @error('error')
                    <label class="ml-2 text-red-400 text-sm">{{ $message }}</label>
                @enderror
            </div>
            <div class="flex gap-2 items-center justify-center">
                <button class="border rounded px-1.5 py-0.5 hover:bg-blue-400 hover:text-white" type="submit">Register</button>
                <span>Or <a class="text-blue-500 hover:underline" href="{{ route('auth.login.page') }}">login</a></span>
            </div>
        </form>
    </div>
</x-layout>

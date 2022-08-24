<header class=" bg-blue-400 text-white py-1 shadow-md">
    <div class="container mx-auto flex justify-between">
        <div class="flex items-baseline">
            <h1 class="text-xl mr-3">Socials</h1>
            <nav class="flex gap-2 items-baseline">
                <a class="text-sm hover:text-base transition-all" href="{{ route('user.profiles') }}">Profiles</a>
                {{-- @auth
                    <a class="text-sm hover:text-base transition-all" href="{{ route('user.profile',auth()->user()) }}">My profile</a>
                    <a class="text-sm hover:text-base transition-all" href="{{ route('user.comments',auth()->user()) }}">My comments</a>
                @endauth --}}
            </nav>

        </div>
        @auth
            <div class="flex gap-1.5 items-center">
                <a href="{{ route('user.profile',auth()->user()) }}">{{ auth()->user()->email }}</a>
                <form method="POST" action="{{ route('auth.logout') }}">
                    @csrf
                    <button class="border rounded px-1.5 py-0.5 text-sm hover:bg-white hover:text-blue-400">Logout</button>
                </form>
            </div>
        @endauth
        @guest
        <div class="flex gap-1.5 items-center">
            <a href="{{ route('auth.login.page') }}" class="hover:underline">Login</a>
            <a href="{{ route('auth.register.page') }}" class="hover:underline">Or Register</a>
        </div>
        @endguest
    </div>
</header>

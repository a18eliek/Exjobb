@if (Route::has('login'))
<div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
    <a href="{{ url('/') }}" class="ml-4 text-sm text-gray-700 underline">Home</a>
    @auth
        <a href="{{ url('/dashboard') }}" class="ml-4 text-sm text-gray-700 underline">Dashboard</a>
    @else
        <a href="{{ route('login') }}" class="ml-4 text-sm text-gray-700 underline">Log in</a>

        @if (Route::has('register'))
            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
        @endif
    @endauth
</div>
@endif
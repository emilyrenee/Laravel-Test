@include('partials.header')

<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
    <div class="top-right links">
        @auth
        <a href="{{ url('/') }}">Home</a>
        @else
        <a href="{{ route('login') }}">Login</a>

        @if (Route::has('register'))
        <a href="{{ route('register') }}">Register</a>
        @endif
        @endauth
    </div>
    @endif

    <div class="content">
        <div class="title m-b-md">
            Project Tracker
        </div>

        <div class="links">
            <a href="#">Projects</a>
            <a href="#">Tasks</a>
            |
            <a href="/teams">Teams</a>
            <a href="/developers">Developers</a>
        </div>
    </div>
</div>

@include('partials.footer')
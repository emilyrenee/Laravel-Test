@include('partials.header')

<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
    <div class="top-right links">
        @auth
        <a href="{{ url('/home') }}">Home</a>
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
            New Developer
        </div>

        <div style="margin: 2rem 0;">
            <form method="post" action="/developer/create">
                @csrf
                <div style="display: flex; flex-direction: column">
                    <div>
                        <label for="name">Name</label>
                        <input type="text" name="name">
                    </div>
                    <div>
                        <label for="name">Email</label>
                        <input type="text" name="email">
                    </div>
                    <input type="submit">
                </div>
            </form>
        </div>

        <div class="links">
            <a href="/">Home</a>
            <a href="#">Projects</a>
            <a href="/developers">Developers</a>
            <a href="/teams">Teams</a>
            <a href="#">Tasks</a>
        </div>
    </div>
</div>

@include('partials.footer')
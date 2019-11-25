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
            Developers
        </div>

        <div style="margin: 2rem 0">
            @foreach ($developers as $developer)
            <div style="margin: 1rem 0; display: flex; flex-direction: column; align-items: flex-start">
                <p style="margin: 0">{{ $developer->name }}</p>
                <p style="margin: .15rem 0">{{ $developer->email }}</p>
                @if(count($developer->teams) > 0)
                    <p style="margin: .5rem 0 0 0"><b>Teams</b></p>
                    @foreach ($developer->teams as $team)
                    <p style="margin: 0 0 .15rem 0">{{ $team->name }}</p>
                    @endforeach
                @endif
                <hr style="width: 100%;" />
            </div>
            @endforeach
        </div>

        <div style="margin: 2rem 0">
            <a href="/developer/create">Add</a>
        </div>

        <div class="links">
            <a href="/">Home</a>
            <a href="#">Projects</a>
            <a href="/teams">Teams</a>
            <a href="#">Tasks</a>
        </div>
    </div>
</div>

@include('partials.footer')
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
            Teams
        </div>

        <div class="links">
            <a href="#">Projects</a>
            <a href="#">Tasks</a>
            |
            <a href="/teams">Teams</a>
            <a href="/developers">Developers</a>
        </div>

        <div style="margin: 2rem 0">
            @foreach ($teams as $team)
            <div
                style="margin: 1rem 0; display: flex; flex-direction: column; align-items: flex-start"
            >
                <p style="margin: 0 0 .5rem 0">{{ $team->name }}</p>
                @if(count($team->developers) > 0)
                    <p style="margin: .5rem 0 0 0"><b>Developers</b></p>
                    @foreach ($team->developers as $developer)
                        <p style="margin: 0">{{ $developer->name }}</p>
                    @endforeach
                @endif
                <hr style="width: 100%;"/>
            </div>
            @endforeach
        </div>

    </div>
</div>

@include('partials.footer')
@include('partials.header')

<div class="flex-center position-ref" style="padding: 4rem 0">
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
            <a href="/projects">Projects</a>
            <a href="/tasks">Tasks</a>
            |
            <a href="/teams">Teams</a>
            <a href="/developers">Developers</a>
        </div>

        <div style="margin: 2rem 0">
            @foreach ($teams as $team)
            <div
                style="margin: 4rem 0; display: flex; flex-direction: column; align-items: flex-start"
            >
                <h2 style="margin: 0 0 .25rem 0">{{ $team->name }}</h2>
                @if(count($team->developers) > 0)
                    <p style="margin: .25rem 0 0 0"><b>Developers</b></p>
                    @foreach ($team->developers as $developer)
                        <p style="margin: 0">{{ $developer->name }}</p>
                    @endforeach
                @endif
                @if(count($team->projects) > 0)
                    <p style="margin: .25rem 0 0 0"><b>Projects</b></p>
                    @foreach ($team->projects as $project)
                        <p style="margin: 0">{{ $project->name }}</p>
                    @endforeach
                @endif
                <a href="/team/assignProject?id={{$team->id}}" style="align-self: flex-end">Assign Project</a>
                <hr style="width: 100%;"/>
            </div>
            @endforeach
        </div>

    </div>
</div>

@include('partials.footer')
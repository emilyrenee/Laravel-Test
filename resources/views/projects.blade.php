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
            Projects
        </div>

        <div class="links">
            <a href="/projects">Projects</a>
            <a href="/tasks">Tasks</a>
            |
            <a href="/teams">Teams</a>
            <a href="/developers">Developers</a>
        </div>

        <div style="margin: 2rem 0">
            @foreach ($projects as $project)
            <div
                style="margin: 4rem 0; display: flex; flex-direction: column; align-items: flex-start"
            >
                <h2 style="margin: 0 0 .25rem 0">{{ $project->name }}</h2>
                @if($project->team)
                    <p style="margin: .25rem 0 0 0"><b>Team</b></p>
                    <p style="margin: 0 0 .15rem 0">{{ $project->team->name }}</p>
                @endif
                @if(!$project->team)
                    <a href="/project/assignTeam?id={{$project->id}}" style="align-self: flex-end">Assign to a Team</a>
                @endif
                <hr style="width: 100%;"/>
            </div>
            @endforeach
        </div>

    </div>
</div>

@include('partials.footer')
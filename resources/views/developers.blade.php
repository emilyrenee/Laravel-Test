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
            Developers
        </div>

        <div class="links">
            <a href="/projects">Projects</a>
            <a href="/teams">Teams</a>
            <a href="/developers">Developers</a>
        </div>

        <div style="margin: 2rem 0">
            <a href="/developer/create">Add</a>
        </div>

        <div style="margin: 2rem 0">
            @foreach ($developers as $developer)
            <div style="margin: 1rem 0; display: flex; flex-direction: column; align-items: flex-start; border: 1px solid rgba(192,192,192,0.3); padding: 1rem 1.15rem">
                <a href="/developer/update?id={{$developer->id}}" style="align-self: flex-end; margin-bottom: 1rem">Edit</a>
                <img style="width:150px;height: 150px; margin: auto" src="/storage/avatars/{{ $developer->avatar }}">
                <p style="margin: 0">
                    {{ $developer->name }}
                </p>
                <p style="margin: 0">
                    {{ $developer->email }}
                </p>

                @if(count($developer->teams) > 0)
                <p style="margin: .5rem 0 0 0">
                    <b>Teams</b>
                </p>
                <hr style="width: 100%; margin-top: .15rem; border-color: rgba(192,192,192,0.3)" />

                @foreach ($developer->teams as $team)
                <div style="display: flex; justify-content: space-between; width: 100%; padding: .25rem 0 .25rem 0">
                    <div>
                        <p style="margin: 0">
                            {{ $team->name }}
                        </p>
                    </div>
                    @if(count($team->projects) > 0)
                    <div style="margin: 0">
                        <small style="margin: 0">
                            <b>Projects</b>
                        </small>
                        <br/>
                            @foreach ($team->projects as $project)
                            <small style="margin: 0">
                                {{ $project->name }}
                            </small>
                            <br/>
                            @endforeach
                    </div>
                    @endif
                </div>
                @endforeach
                @endif

                <form method="post" action="/api/developer/delete" enctype="multipart/form-data" style="width: 100%; margin-top: 1rem">
                    @csrf
                    <input type="hidden" name="id" id="id" value="{{$developer->id}}">
                    <div style="display: flex; justify-content: flex-end">
                        <input type="submit" style="width: 100px" value="Delete">
                    </div>
                </form>

            </div>
            @endforeach
        </div>
    </div>
</div>

@include('partials.footer')
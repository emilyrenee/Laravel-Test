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
            Assign Project
        </div>

        <div class="links">
            <a href="/projects">Projects</a>
            <a href="/tasks">Tasks</a>
            |
            <a href="/teams">Teams</a>
            <a href="/developers">Developers</a>
        </div>

        <div style="margin: 2rem 0;">
            <h2 style="margin: 0 0 .25rem 0">{{ $project->name }}</h2>
            <form method="post" action="/project/assignTeam">
                @csrf
                <div class="form-inner">
                    <input type="hidden" name="id" id="id" value="{{$project->id}}">
                    <div class="form-input">
                        <label for="team_id">Select one team</label>
                        <select name="team_id" multiple>
                            @foreach ($teams as $team)
                            <option value="{{ $team->id }}" id="team_ids_{{$loop->iteration}}">
                                {{ $team->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <input type="submit" style="width: 200px">
                    @if (isset($errors) && $errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>

@include('partials.footer')
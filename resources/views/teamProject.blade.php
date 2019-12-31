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
            Assign Project To Team
        </div>

        <div class="links">
            <a href="/projects">Projects</a>
            <a href="/teams">Teams</a>
            <a href="/developers">Developers</a>
        </div>

        <div style="margin: 2rem 0;">
            <h2 style="margin: 0 0 .25rem 0">{{ $team->name }}</h2>
            <form method="post" action="/api/team/project">
                @csrf
                <div class="form-inner">
                    <input type="hidden" name="id" id="id" value="{{$team->id}}">
                    <div class="form-input">
                        <label for="project_id">Select one or more project(s)</label>
                        <select name="project_id" multiple>
                            @foreach ($projects as $project)
                            @if(!$project->team_id)
                            <option value="{{ $project->id }}" id="project_id_{{$loop->iteration}}">
                                {{ $project->name }}
                            </option>
                            @endif
                            @if($project->team_id === $team->id )
                            <option value="{{ $project->id }}" id="project_id_{{$loop->iteration}}" selected>
                                {{ $project->name }}
                            </option>
                            @endif
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
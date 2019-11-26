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
            New Developer
        </div>

        <div style="margin: 2rem 0;">
            <form onsubmit="event.preventDefault(); return handleUpdateDeveloper(event)">
                @csrf
                <div class="form-inner">
                    <input type="hidden" name="name" id="id" value="{{$developer->id}}">
                    <div class="form-input">
                        <label for="name">Name*</label>
                        <input type="text" name="name" id="name" value="{{$developer->name}}">
                    </div>
                    <div class="form-input">
                        <label for="email">Email*</label>
                        <input type="text" name="email" id="email" value="{{$developer->email}}">
                    </div>
                    <div class="form-input">
                        <label for="avatar">Avatar</label>
                        <input type="file" name="avatar" id="avatar">
                    </div>
                    <div class="form-input-row">
                        <label for="is_local">Developer is local resident?</label>&nbsp;
                        <input type="checkbox" name="is_local" value="{{$developer->is_local}}" id="is_local">
                    </div>
                    <div class="form-input">
                        <label for="timezone">Timezone</label>
                        <input type="text" name="timezone" id="timzone" value="{{$developer->timzone}}">
                    </div>
                    <div class="form-input">
                        <label for="timezone">Personal Site</label>
                        <input type="text" name="personal_site" id="personal_site" value="{{$developer->url}}">
                    </div>
                    <div class="form-input">
                        <label for="team_ids">Select one or more team(s)</label>
                        <select name="team_ids" multiple>
                            @foreach ($teamOptions as $option)
                            @if($developer->teams->filter(function ($team, $key) use ($option) {
                            return $team['name'] === $option->name;
                            })->count() > 0)
                            <option value="{{ $option->id }}" id="team_ids_{{$loop->iteration}}" selected>
                                {{ $option->name }}
                            </option>
                            @else
                            <option value="{{ $option->id }}" id="team_ids_{{$loop->iteration}}">
                                {{ $option->name }}
                            </option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <br />
                    <input type="submit" style="width: 200px">
                    @if ($errors && $errors->any())
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
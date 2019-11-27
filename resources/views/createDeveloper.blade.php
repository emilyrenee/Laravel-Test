@include('partials.header')

<div class="flex-center position-ref full-height" style="padding: 4rem 0">
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
            <form onsubmit="event.preventDefault(); return handleCreateDeveloper(event)">
                @csrf
                <div class="form-inner">
                    <div class="form-input">
                        <label for="name">Name*</label>
                        <input type="text" name="name" id="name">
                    </div>
                    <div class="form-input">
                        <label for="email">Email*</label>
                        <input type="text" name="email" id="email">
                    </div>
                    <div class="form-input">
                        <label for="avatar">Avatar</label>
                        <input type="file" name="avatar" id="avatar">
                    </div>
                    <div class="form-input-row">
                        <label for="is_local">Developer is local resident?</label>&nbsp;
                        <input type="checkbox" name="is_local" value="true" id="is_local">
                    </div>
                    <div class="form-input">
                        <label for="timezone">Timezone</label>
                        <input type="text" name="timezone" id="timzone">
                    </div>
                    <div class="form-input">
                        <label for="timezone">Personal Site</label>
                        <input type="text" name="personal_site" id="personal_site">
                    </div>
                    <div class="form-input">
                        <select name="team_ids" multiple>
                            @foreach ($teamOptions as $option)
                            <option value="{{ $option->id }}" id="team_ids_{{$loop->iteration}}">{{ $option->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <br />
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
        <div class="links">
            <a href="/projects">Projects</a>
            <a href="/tasks">Tasks</a>
            |
            <a href="/teams">Teams</a>
            <a href="/developers">Developers</a>
        </div>
    </div>
</div>

@include('partials.footer')
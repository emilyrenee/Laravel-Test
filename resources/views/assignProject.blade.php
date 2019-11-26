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
            Assign Project
        </div>

        <div style="margin: 2rem 0;">
            <form onsubmit="event.preventDefault(); return handleAssignProject(event)">
                @csrf
                <div class="form-inner">
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
            <a href="/projects">Projects</a>
            <a href="/tasks">Tasks</a>
            |
            <a href="/teams">Teams</a>
            <a href="/developers">Developers</a>
        </div>
    </div>
</div>

@include('partials.footer')
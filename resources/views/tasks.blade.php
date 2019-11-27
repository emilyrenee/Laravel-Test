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

        <div style="margin: 4rem 0">
            @foreach ($tasks as $task)
            <div
                style="margin: 1rem 0; display: flex; flex-direction: column; align-items: flex-start"
            >
                <h2 style="margin: 0 0 .5rem 0">{{ $task->name }}</h2>
                <p style="margin: 0 0 .5rem 0">{{ $task->description }}</p>
                <hr style="width: 100%;"/>
            </div>
            @endforeach
        </div>

    </div>
</div>

@include('partials.footer')
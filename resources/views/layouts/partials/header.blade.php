<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ env('APP_URL') }}">{{ env('APP_NAME') }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ $homepageLink ?? '' }}" href="{{ env('APP_URL') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $usersLink ?? '' }}"
                            href="{{ route('users.index') }}">Users</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

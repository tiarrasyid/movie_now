<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('movies.index') }}">MOVIE NOW</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('movies.index') }}">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        Location
                    </a>
                    <ul class="dropdown-menu" aria-label-ledby="navbarDropdown">
                        @foreach ($locations as $loc)
                            <li>
                                <a class="dropdown-item" href="{{ route('movies.byLocation', $loc->location_name) }}">
                                    {{ $loc->location_name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('movies.coming-soon') }}">Coming Soon</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('about') }}">About Us</a>
                </li>
            </ul>
            <form class="d-flex" action="{{ route('movies.index') }}" method="GET">
                <input class="form-control me-2" type="search" name="search" placeholder="Search movie or location..."
                    value="{{ request('search') }}" />
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>

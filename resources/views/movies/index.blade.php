@extends('layout.app')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Movie List</h2>
    </div>
    @if (isset($selectedLocation))
        <h4 class="mb-3 text-muted">Movies in {{ $selectedLocation }}</h4>
    @endif
    <div class="row">
        @forelse($movies as $movie)
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $movie->movie_name }}</h5>
                        <p>🌟 {{ $movie->movie_rating }} -- {{ \Carbon\Carbon::parse($movie->movie_date)->format('d/m/Y') }}</p>
                        <div class="accordion" id="acc{{ $movie->movie_id }}">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#collapse{{ $movie->movie_id }}">
                                        Locations ({{ $movie->locations_count }}) </button>
                                </h2>
                                <div id="collapse{{ $movie->movie_id }}" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        @if($movie->locations->isNotEmpty())
                                            <ul class="mb-0">
                                                @foreach($movie->locations as $location)
                                                    <li>
                                                        <strong>{{ $location->location_name }}</strong>
                                                        <small>{{ $location->location_detail }}</small>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <em>No locations available</em>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-2">
                            <a href="{{ route('movies.show', $movie->id) }}" class="btn btn-sm btn-outline-primary">Details</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">No movies found.</p>
        @endforelse
    </div>
    <div class="mt-3">
        <nav aria-label="page_nav">
            <ul class="pagination">
                @if ($movies->onFirstPage())
                    <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $movies->previousPageUrl() }}">Previous</a></li>
                @endif

                @foreach ($movies->links()->elements[0] ?? [] as $page => $url)
                    <li class="page-item {{ $page == $movies->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach

                @if ($movies->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $movies->nextPageUrl() }}">Next</a>
                    </li>
                @else
                    <li class="page-item disabled"><span class="page-link">Next</span></li>
                @endif
            </ul>
        </nav>
    </div>
@endsection
@extends('layout.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Coming Soon Movies</h1>

        @if ($movies->count())
            <div class="accordion" id="accordion">
                @foreach ($movies as $movie)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{ $movie->movie_id }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse{{ $movie->movie_id }}" aria-expanded="false"
                                aria-controls="collapse{{ $movie->movie_id }}">
                                {{ $movie->movie_name }} (Release:
                                {{ \Carbon\Carbon::parse($movie->movie_date)->format('M d, Y') }})
                            </button>
                        </h2>
                        <div class="collapse{{ $movie->movie_id }}" class="accordion-collapse collapse"
                            aria-labelledby="heading{{ $movie->movie_id }}">
                            <div class="accordion-body">
                                <p><strong>Synopsis:</strong> {{ $movie->description ?? 'No description available.' }}</p>
                                <p><strong>Location:</strong></p>
                                @if ($movie->locations->count())
                                    <ul>
                                        @foreach ($movie->locations as $location)
                                            <li>{{ $location->location_name }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p>No locations available.</p>
                                @endif
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
            <div class="mt-4">
                {{ $movies->links() }}
            </div>
        @else
            <p>No coming soon movies available.</p>
        @endif
    </div>
@endsection
@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Movie Grouped by Location</h2>

        @forelse ($locations as $locationName => $locGroup)
            <div class="card mb-4">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">{{ $locationName }}</h5>
                </div>
                <div class="card-body">
                    @if ($locGroup->isNotEmpty())
                        <ul class="list-group list-group-flush">
                            @foreach ($locGroup as $loc)
                                <br class="list-group-item">
                                🎬<strong>{{ $loc->movie->movie_name ?? 'No Movie' }}</strong></br>
                                ⭐{{ $loc->movie->movie_rating ?? '-' }} -
                                {{ optional($loc->movie)->movie_date ? \Carbon\Carbon::parse($loc->movie->movie_date)->format('M d, Y') : '-' }}
                                </br>
                                <small>{{ $location_detail }}</small>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>No Movie for this Location</p>
                    @endif
                </div>
            </div>
        @empty
            <p>No Locations available.</p>
        @endforelse
    </div>

@endsection

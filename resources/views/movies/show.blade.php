@extends('layout.app')

@section('content')
    <div class="container">
        <div class="mb-4">
            <h2 class="fw-bold">{{ $movie->movie_name }}</h2>
            <p class="text-muted-mb-1">
                ⭐ <strong>{{ $movie->movie_rating }}</strong>
                🗓️ {{ \Carbon\Carbon::parse($movie->movie_date)->format('d/m/Y') }}
            </p>
            <p>
                {{ $movie->movie_description }}
            </p>
        </div>

        <h4 class="mt-4">Locations</h4>

        @if ($movie->locations->count())
            <div class="accordion" id="accordionLocations">
                @foreach ($movie->locations as $index => $loc)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{ $index }}">
                            <button class="accordion-button {{ $index !== 0 ? 'collapsed' : '' }}" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}"
                                aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $index }}">
                                {{ $loc->location_name }}
                            </button>
                        </h2>
                        <div id="collapse{{ $location->id }}" class="accordion-collapse collapse"
                            aria-labelledby="heading{{ $location->id }}" data-bs-parent="#accordionLocations">
                            <div class="accordion-body">
                                <p>{{ $location->location_detail }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

        @endif
    </div>

@endsection
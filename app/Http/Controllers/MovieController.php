<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Location;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        // fungsi search box
        $search = $request->input('search');
        $grouped = $request->boolean('grouped'); // ?grouped=1

        if ($grouped) {
            // tampilkan movie beserta lokasi
            $Locations = Location::with('movie')
                ->when($search, function ($query, $search) {
                    $query->where('location_name', 'like', "%{$search}%")
                        ->orWhereHas('movie', function ($q) use ($search) {
                            $q->where('movie_name', 'like', "%{$search}%");
                        });
                })->orderBy('location_name')
                ->get()
                ->groupBy('location_name');

            return view('movies.grouped', compact('Locations', 'search'));
        } else {
            // tampilan daftar movie biasa
            $movies = Movie::with('locations')
                ->when($search, function ($query, $search) {
                    $query->where('movie_name', 'like', "%{$search}%")
                        ->orWhereHas('locations', function ($q) use ($search) {
                            $q->where('location_name', 'like', "%{$search}%");
                        });
                })
                ->paginate(10);
            return view('movies.index', compact('movies', 'search'));
        }

    }

    public function show($id)
    {
        //ambil movie berdasarkan id, sekaligus relasi locations
        $movie = \App\Models\Movie::with('locations')->findOrFail($id);

        // kirim ke view 'movies.show'
        return view('movies.show', compact('movie'));
    }

    public function comingSoon()
    {
        // ambil film yang tanggal rilisnya di masa depan
        $movies = Movie::where('movie_date', '>', now())
            ->orderBy('movie_date', 'asc')
            ->with('locations')
            ->paginate(10);
        return view('movies.coming-soon', compact('movies'));
    }

    public function filterByLocation($name)
    {
        // ambil semua film yang memiliki lokasi sesuai nama yang diklik
        $movies = \App\Models\Movie::whereHas('locations', function ($q) use ($name) {
            $q->where('location_name', $name);
        })->with('locations')->paginate(10);

        // ambil daftar lokasi untuk navbar dropdown
        $locations = \App\Models\Location::select('location_name')
            ->groupBy('location_name')
            ->orderBy('location_name')
            ->get();

        return view('movies.index', [
            'movies' => $movies,
            'search' => null,
            'locations' => $locations,
            'selectedLocation' => $name,
        ]);

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Media;
use App\Models\Genre;

class ManhwaController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua genre untuk sidebar filter
        $genres = Genre::all();

        // Ambil media yang type 'manhwa'
        $manhwas = Media::with('genres')
            ->where('type', 'manhwa')
            ->when($request->status, function($query, $status) {
                $query->where('status', $status);
            })
            ->when($request->genres, function($query, $genres) {
                $query->whereHas('genres', function($q) use ($genres) {
                    $q->whereIn('genres.id', $genres);
                });
            })
            ->get();

        return view('manhwa.index', compact('manhwas', 'genres'));
    }
}
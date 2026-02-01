<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Media;
use App\Models\Genre;

class BrowseController extends Controller
{
    public function index(Request $request, string $type)
    {
        abort_unless(in_array($type, ['drama', 'manhwa']), 404);

        $query = Media::with('genres')
            ->where('type', $type)
            ->withAvg('userMediaLists', 'rating');

        // Search
        if ($request->filled('search')) {
            $query->where('title', 'like', $request->search . '%');
        }

        // Genre filter
        if ($request->filled('genres')) {
            foreach ($request->genres as $genreId) {
                $query->whereHas('genres', function ($q) use ($genreId) {
                    $q->where('genres.id', $genreId);
                });
            }
        }

        // Year filter
        if ($request->filled('year')) {
            $query->where('release_year', $request->year);
        }

        // Sort
        match ($request->get('sort', 'trending')) {
            'newest' => $query->orderByDesc('release_year'),

            'popular' => $query
                ->withCount('userMediaLists')
                ->orderByDesc('user_media_lists_count'),

            default => $query
                ->withCount('userMediaLists')
                ->orderByDesc('user_media_lists_count'),
        };

        $medias = $query->paginate(15)->withQueryString();

        $genres = Genre::whereHas('media', fn ($q) => $q->where('type', $type))->get();

        return view('browse.index', compact(
            'medias',
            'genres',
            'type'
        ));
    }
}

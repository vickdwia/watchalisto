<?php

namespace App\Http\Controllers;

use App\Models\UserMediaList;
use App\Models\Genre;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DramaController extends Controller
{
    public function index(Request $request)
{
    // DEFAULT SORT
    $sort = $request->get('sort', 'rating_desc');

    $query = UserMediaList::query()
        ->with(['media.genres'])
        ->where('user_id', Auth::id())
        ->whereHas('media', fn ($q) =>
            $q->where('type', 'drama')
        );

    /* ================= FILTER ================= */

    if ($request->filled('drama_status')) {
        $query->whereHas('media', fn ($q) =>
            $q->where('status', $request->drama_status)
        );
    }

    if ($request->filled('list_status')) {
        $query->where('user_media_lists.status', $request->list_status);
    }


    if ($request->filled('genres')) {
        $genreIds = $request->genres;

        $query->whereHas(
            'media.genres',
            fn ($q) => $q->whereIn('genres.id', $genreIds),
            '=',
            count($genreIds)
        );
    }

    if ($request->filled('year')) {
        $query->whereHas('media', fn ($q) =>
            $q->where('release_year', $request->year)
        );
    }

    if ($request->filled('rating')) {
        if ($request->rating === '0') {
            $query->whereNull('rating');
        } elseif (is_numeric($request->rating)) {
            $query->where('rating', '>=', (int) $request->rating);
        }
    }

    /* ================= SORT ================= */

    $query->join('media', 'media.id', '=', 'user_media_lists.media_id');

    match ($sort) {
        'az' =>
            $query->orderBy('media.title', 'asc'),

        'rating_desc' =>
            $query->orderBy('user_media_lists.rating', 'desc'),

        'newest' =>
            $query->orderBy('user_media_lists.created_at', 'desc'),

        'oldest' =>
            $query->orderBy('user_media_lists.created_at', 'asc'),

        default =>
            $query->orderBy('user_media_lists.rating', 'desc'),
    };

    $dramas = $query
        ->select('user_media_lists.*')
        ->paginate(24)
        ->withQueryString();

    $genres = Genre::orderBy('name')->get();
    $years = Media::where('type', 'drama')
        ->whereNotNull('release_year')
        ->distinct()
        ->orderBy('release_year', 'desc')
        ->pluck('release_year');

    return view('drama.index', compact('dramas', 'genres', 'years', 'sort'));
}

    public function show($id)
    {
        $drama = UserMediaList::with('media.genres')
            ->where('user_id', Auth::id())
            ->where('media_id', $id)
            ->whereHas('media', fn ($q) =>
                $q->where('type', 'drama')
            )
            ->firstOrFail();

        return view('drama.show', compact('drama'));
    }

    public function browse(Request $request)
{
    $genres = Genre::orderBy('name')->get();

    $dramas = Media::with('genres')
        ->where('type', 'drama');

    // Keyword search
    if ($request->filled('search')) {
        $search = $request->search;
        $dramas->where('title', 'like', "%{$search}%");
    }

    // Filter genres
    if ($request->filled('genres')) {
        $dramas->whereHas('genres', function($q) use ($request) {
            $q->whereIn('genres.id', $request->genres);
        });
    }

    // Filter year
    if ($request->filled('year')) {
        $dramas->where('release_year', $request->year);
    }

    $dramas = $dramas->paginate(12)->withQueryString();

    // Manhwa tab
    $manhwas = Media::with('genres')->where('type', 'manhwa')->paginate(12);

    return view('drama.browse', compact('dramas', 'manhwas', 'genres'));
}



}
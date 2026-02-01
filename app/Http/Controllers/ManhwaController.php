<?php

namespace App\Http\Controllers;

use App\Models\UserMediaList;
use App\Models\Genre;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManhwaController extends Controller
{
    public function index(Request $request)
    {
        // DEFAULT SORT
        $sort = $request->get('sort', 'rating_desc');

        $query = UserMediaList::query()
            ->with(['media.genres'])
            ->where('user_id', Auth::id())
            ->whereHas('media', fn ($q) =>
                $q->where('type', 'manhwa')
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

        $manhwas = $query
            ->select('user_media_lists.*')
            ->paginate(15)
            ->withQueryString();

        $genres = Genre::orderBy('name')->get();
        $years = Media::where('type', 'manhwa')
            ->whereNotNull('release_year')
            ->distinct()
            ->orderBy('release_year', 'desc')
            ->pluck('release_year');

        return view('manhwa.index', compact('manhwas', 'genres', 'years', 'sort'));
    }

        public function show($id)
        {
            $manhwa = UserMediaList::with('media.genres')
                ->where('user_id', Auth::id())
                ->where('media_id', $id)
                ->whereHas('media', fn ($q) =>
                    $q->where('type', 'manhwa')
                )
                ->firstOrFail();

            return view('manhwa.show', compact('manhwa'));
        }

        public function browse(Request $request)
    {
        $genres = Genre::orderBy('name')->get();
        $sort = $request->get('sort', 'trending');

        $manhwas = Media::with('genres')
            ->where('type', 'manhwa');

        // Search
        if ($request->filled('search')) {
            $manhwas->where('title', 'like', '%' . $request->search . '%');
        }

        // Filter genre
        if ($request->filled('genres')) {
            $genreIds = $request->genres;

            $manhwas->whereHas(
                'genres',
                function ($q) use ($genreIds) {
                    $q->whereIn('genres.id', $genreIds);
                },
                '=',
                count($genreIds)
            );
        }

        // Filter year
        if ($request->filled('year')) {
            $manhwas->where('release_year', $request->year);
        }

        // SORT (FINAL)
        match ($sort) {
            // Trending = rating tertinggi
            'trending' =>
                $manhwas->withAvg('userMediaLists', 'rating')
                        ->orderBy('user_media_lists_avg_rating', 'desc'),


            // Most Watched = paling banyak user
            'popular' =>
                $manhwas->withCount('userMediaLists')
                        ->orderBy('user_media_lists_count', 'desc'),

            // Newest
            'newest' =>
                $manhwas->orderBy('created_at', 'desc'),

            default =>
                $manhwas->orderBy('rating', 'desc'),
        };

        $manhwas = $manhwas
            ->paginate(15)
            ->withQueryString();

        return view('manhwa.browse', compact('manhwas', 'genres', 'sort'));
    }
}
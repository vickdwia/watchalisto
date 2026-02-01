<?php

namespace App\Http\Controllers;

use App\Models\Drama;
use App\Models\Manhwa;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MediaController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->get('q');
        
        $results = Media::with(['dramaDetail', 'manhwaDetail'])
            ->where('title', 'LIKE', "%{$query}%")
            ->limit(10)
            ->get()
            ->map(function($media) {
                return [
                    'id' => $media->id,
                    'title' => $media->title,
                    'type' => $media->type,
                    'poster' => $media->poster,
                    'release_year' => $media->release_year,
                    'total_episode' => $media->dramaDetail?->total_episode,
                    'total_season' => $media->dramaDetail?->total_season,
                    'total_chapter' => $media->manhwaDetail?->total_chapter,
                    'total_volume' => $media->manhwaDetail?->total_volume,
                ];
            });

        return response()->json($results);
    }

    public function overview()
    {
        $totalDramas = Drama::count();
        $totalManhwas = Manhwa::count();
        $totalMedia = $totalDramas + $totalManhwas;

        $completedMedia =
            Drama::where('status', 'finished')->count() +
            Manhwa::where('status', 'finished')->count();

        $recentMedia = collect()
            ->merge(
                Drama::with('media.genres')
                    ->latest()
                    ->take(6)
                    ->get()
                    ->map(fn ($item) => $item->setAttribute('type', 'drama'))
            )
            ->merge(
                Manhwa::with('media.genres')
                    ->latest()
                    ->take(6)
                    ->get()
                    ->map(fn ($item) => $item->setAttribute('type', 'manhwa'))
            )
            ->sortByDesc('created_at')
            ->take(12)
            ->values();

        $ongoingMedia = collect()
            ->merge(
                Drama::with('media.genres')
                    ->where('status', 'ongoing')
                    ->take(6)
                    ->get()
                    ->map(fn ($item) => $item->setAttribute('type', 'drama'))
            )
            ->merge(
                Manhwa::with('media.genres')
                    ->where('status', 'ongoing')
                    ->take(6)
                    ->get()
                    ->map(fn ($item) => $item->setAttribute('type', 'manhwa'))
            )
            ->take(12)
            ->values();

        return view('media.overview', compact(
            'totalMedia',
            'totalDramas',
            'totalManhwas',
            'completedMedia',
            'recentMedia',
            'ongoingMedia'
        ));
    }

    public function show($id)
    {
        $media = Media::with([
                'genres', 
                'userMediaLists', 
                'dramaDetail', 
                'manhwaDetail'
            ])
            ->withAvg('userMediaLists','rating')
            ->findOrFail($id);

        // Optional: kalau mau cek drama/manhwa
        // $type = $media->type;

        $related = Media::whereHas('genres', function($q) use ($media) {
            $q->whereIn('genres.id', $media->genres->pluck('id'));
        })
        ->where('id', '!=', $media->id)
        ->limit(8)
        ->get();

        return view('media.mediadetail', compact('media', 'related'));
    }

    public function toggleList($id)
    {
        $user = Auth::user();
        $media = Media::with('userMediaLists')->findOrFail($id);

        if ($media->isInUserList($user->id)) {
            // Hapus dari list
            $user->media()->detach($media->id);
            $message = 'Removed from your list.';
        } else {
            // Tambah ke list dengan status default "planned"
            $user->media()->attach($media->id, ['status' => 'planned']);
            $message = 'Added to your list.';
        }

        return back()->with('status', $message);
    }
}
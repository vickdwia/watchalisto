<?php

namespace App\Http\Controllers;

use App\Models\Drama;
use App\Models\Manhwa;
use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->query('q');

        if (!$query) {
            return response()->json([]);
        }

        return Media::where('title', 'like', "%{$query}%")
            ->limit(10)
            ->get();
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
}
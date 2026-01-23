<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserMediaList;

class StatsController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Ambil semua media user dengan relasi detail
        $mediaList = $user->mediaList()->with([
            'media.dramaDetail',
            'media.manhwaDetail'
        ])->get();

        // Hitung stats
        $stats = [
            'total_media'   => $mediaList->count(),
            'total_drama'   => $mediaList->where('media.type', 'drama')->count(),
            'total_manhwa'  => $mediaList->where('media.type', 'manhwa')->count(),

            'planned'       => $mediaList->where('status', 'planned')->count(),
            'watching'      => $mediaList->where('status', 'watching')->count(),
            'completed'     => $mediaList->where('status', 'completed')->count(),

            'avg_rating'    => round($mediaList->whereNotNull('rating')->avg('rating'), 1),

            'time_spent'    => $this->calculateTimeSpent($mediaList),
        ];

        return view('stats.index', compact('stats'));
    }

    private function calculateTimeSpent($mediaList)
    {
        $totalMinutes = 0;

        foreach ($mediaList as $item) {
            $media = $item->media;

            if (!$media) continue;

            if ($media->type === 'drama' && $media->dramaDetail) {
                $totalMinutes += $item->progress * $media->dramaDetail->episode_duration;
            }

            if ($media->type === 'manhwa' && $media->manhwaDetail) {
                $totalMinutes += $item->progress * $media->manhwaDetail->avg_read_time;
            }
        }

        return $totalMinutes; // dalam menit
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Media;
use App\Models\UserMediaList;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // ===============================
        // USER MEDIA LIST
        // ===============================
        $userMedia = UserMediaList::with('media')
            ->where('user_id', $user->id)
            ->get();

        // ===============================
        // STATUS COUNTS
        // ===============================
        $dramaCompleted = UserMediaList::where('user_id', $user->id)
            ->whereHas('media', fn ($q) => $q->where('type', 'drama'))
            ->where('status', 'completed')
            ->count();

        $dramaWatching = UserMediaList::where('user_id', $user->id)
            ->whereHas('media', fn ($q) => $q->where('type', 'drama'))
            ->where('status', 'watching')
            ->count();

        $manhwaCompleted = UserMediaList::where('user_id', $user->id)
            ->whereHas('media', fn ($q) => $q->where('type', 'manhwa'))
            ->where('status', 'completed')
            ->count();

        $manhwaReading = UserMediaList::where('user_id', $user->id)
            ->whereHas('media', fn ($q) => $q->where('type', 'manhwa'))
            ->where('status', 'reading')
            ->count();

        // ===============================
        // DAYS WATCHED (ESTIMATED)
        // ===============================
        $totalMinutes = 0;

        foreach ($userMedia as $item) {
            if (!$item->media) continue;

            // Drama: 1 episode = 60 menit
            if ($item->media->type === 'drama') {
                $totalMinutes += ($item->progress ?? 0) * 60;
            }

            // Manhwa: 1 chapter = 5 menit
            if ($item->media->type === 'manhwa') {
                $totalMinutes += ($item->progress ?? 0) * 5;
            }
        }

        $daysWatched = round($totalMinutes / 60 / 24, 1);

        // ===============================
        // RECENT ACTIVITY
        // ===============================
        $recentActivities = UserMediaList::with('media')
            ->where('user_id', $user->id)
            ->where('updated_at', '>=', Carbon::now()->subDays(7))
            ->latest('updated_at')
            ->limit(5)
            ->get();

        // ===============================
        // DRAMA SECTIONS
        // ===============================
        $trendingDramas = Media::with('genres')
            ->where('type', 'drama')
            ->withAvg('userMediaLists', 'rating')
            ->orderByDesc('user_media_lists_avg_rating')
            ->take(8)
            ->get();

        $popularDramas = Media::with('genres')
            ->where('type', 'drama')
            ->withCount('userMediaLists')
            ->orderByDesc('user_media_lists_count')
            ->take(8)
            ->get();

        $newDramas = Media::with('genres')
            ->where('type', 'drama')
            ->orderByDesc('release_year')
            ->orderBy('title', 'asc')
            ->take(8)
            ->get();

        // ===============================
        // MANHWA SECTIONS
        // ===============================
        $trendingManhwas = Media::with('genres')
            ->where('type', 'manhwa')
            ->withAvg('userMediaLists', 'rating')
            ->orderByDesc('user_media_lists_avg_rating')
            ->take(5)
            ->get();

        $popularManhwas = Media::with('genres')
            ->where('type', 'manhwa')
            ->withCount('userMediaLists')
            ->orderByDesc('user_media_lists_count')
            ->take(5)
            ->get();

        $newManhwas = Media::with('genres')
            ->where('type', 'manhwa')
            ->orderByDesc('release_year')
            ->orderBy('title', 'asc')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'daysWatched',
            'recentActivities',
            'trendingDramas',
            'popularDramas',
            'newDramas',
            'trendingManhwas',
            'popularManhwas',
            'newManhwas',
            'dramaCompleted',
            'dramaWatching',
            'manhwaCompleted',
            'manhwaReading'
        ));
    }
}

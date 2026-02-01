<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Media;
use App\Models\UserMediaList;

class OverviewController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $typeFilter = $request->query('type', 'all'); // default: all

        // kondisi berdasarkan tipe
        $mediaTypeCondition = $typeFilter === 'all' 
        ? fn($q) => $q 
        : fn($q) => $q->where('type', $typeFilter);

        // Total media
        $totalMedia = UserMediaList::where('user_id', $user->id)->count();

        // Total drama
        $totalDramas = UserMediaList::where('user_id', $user->id)
            ->whereHas('media', function ($q) {
                $q->where('type', 'drama');
            })
            ->count();

        // Total manhwa
        $totalManhwas = UserMediaList::where('user_id', $user->id)
            ->whereHas('media', function ($q) {
                $q->where('type', 'manhwa');
            })
            ->count();

        // Completed media (based on user progress)
        $completedMedia = UserMediaList::where('user_id', $user->id)
                    ->where('status', 'completed')
                    ->count();

        /// Currently Watching Dramas
        $ongoingMedia = UserMediaList::where('user_id', $user->id)
                    ->where('status', 'watching')
                    ->whereHas('media', $mediaTypeCondition)
                    ->with('media')
                    ->get();

        // Recently added media (5 terakhir)
        $recentMedia = UserMediaList::where('user_id', $user->id)
                    ->whereHas('media', $mediaTypeCondition)
                    ->with('media')
                    ->latest('created_at')
                    ->take(5)
                    ->get()
                    ->pluck('media');

        return view('overview.index', compact(
            'totalMedia',
            'totalDramas',
            'totalManhwas',
            'completedMedia',
            'ongoingMedia',
            'recentMedia'
        ));
    }
}
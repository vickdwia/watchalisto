<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Media;
use App\Models\UserMediaList;

class OverviewController extends Controller
{
    public function index()
    {
        // Total media
        $totalMedia = Media::count();

        // Total drama
        $totalDramas = Media::where('type', 'drama')->count();

        // Total manhwa
        $totalManhwas = Media::where('type', 'manhwa')->count();

        // Completed media (based on user progress)
        $completedMedia = UserMediaList::where('status', 'completed')->count();

        // Ongoing media
        $ongoingMedia = UserMediaList::where('status', 'watching')->get();

        // Recently added media (5 terakhir)
        $recentMedia = Media::latest()->take(5)->get();

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
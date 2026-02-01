<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $trendingDramas = Media::withCount('userMediaLists')
            ->withAvg('userMediaLists', 'rating')
            ->where('type', 'drama')
            ->orderByDesc('user_media_lists_count')
            ->take(6)
            ->get();

        // Trending Manhwa
        $trendingManhwas = Media::withCount('userMediaLists')
            ->withAvg('userMediaLists', 'rating')
            ->where('type', 'manhwa')
            ->orderByDesc('user_media_lists_count')
            ->take(6)
            ->get();

        return view('welcome', compact('trendingDramas', 'trendingManhwas'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserMediaList;

class UserMediaListController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'media_id'      => 'required|exists:media,id',
            'status'        => 'required|in:planned,watching,reading,completed',
            'rating'        => 'nullable|integer|min:1|max:5',
            'progress'      => 'nullable|integer|min:0',
            'extra_progress' => 'nullable|integer',
            'started_date'  => 'nullable|date',
            'finished_date' => 'nullable|date',
            'notes'         => 'nullable|string',

        ]);

        $media = \App\Models\Media::with(['dramaDetail', 'manhwaDetail'])->find($request->media_id);
    
        if ($media->type === 'drama') {
            $totalEpisode = $media->dramaDetail?->total_episode;
            $totalSeason = $media->dramaDetail?->total_season;
            
            if ($totalEpisode && $request->progress && $request->progress > $totalEpisode) {
                return response()->json([
                    'success' => false,
                    'message' => "Episode tidak boleh lebih dari {$totalEpisode}"
                ], 422);
            }
            if ($totalSeason && $request->extra_progress && $request->extra_progress > $totalSeason) {
                return response()->json([
                    'success' => false,
                    'message' => "Season tidak boleh lebih dari {$totalSeason}"
                ], 422);
            }
        } 
        elseif ($media->type === 'manhwa') {
            $totalChapter = $media->manhwaDetail?->total_chapter;
            $totalVolume = $media->manhwaDetail?->total_volume;
            
            if ($totalChapter && $request->progress && $request->progress > $totalChapter) {
                return response()->json([
                    'success' => false,
                    'message' => "Chapter tidak boleh lebih dari {$totalChapter}"
                ], 422);
            }
            if ($totalVolume && $request->extra_progress && $request->extra_progress > $totalVolume) {
                return response()->json([
                    'success' => false,
                    'message' => "Volume tidak boleh lebih dari {$totalVolume}"
                ], 422);
            }
        }

        UserMediaList::updateOrCreate(
            [
                'user_id'  => auth()->id(),
                'media_id' => $request->media_id,
            ],
            [
                'status'        => $request->status,
                'rating'        => $request->rating,
                'progress'      => $request->progress ?? 0,
                'extra_progress' => $request->extra_progress,
                'started_date'  => $request->started_date,
                'finished_date' => $request->finished_date,
                'notes'         => $request->notes,
            ]
        );

        return response()->json([
            'success' => true
        ]);
    }

    public function diary()
    {
        $notes = auth()->user()
            ->mediaList() // relasi user_media_list ke user
            ->where('status', 'completed')
            ->whereNotNull('notes')
            ->where('notes', '!=', '')
            ->whereRaw("TRIM(notes) != ''")
            ->with('media') // ambil data media
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('diary.index', compact('notes'));
    }

    public function show($id)
    {
        $item = UserMediaList::with(['media' => function($query) {
            $query->with(['dramaDetail', 'manhwaDetail']);
        }])
        ->where('id', $id)
        ->where('user_id', auth()->id())
        ->firstOrFail();

        // Format response dengan data total dari relasi
        return response()->json([
            'id' => $item->id,
            'media_id' => $item->media_id,
            'status' => $item->status,
            'progress' => $item->progress,
            'extra_progress' => $item->extra_progress,
            'rating' => $item->rating,
            'started_date' => $item->started_date,
            'finished_date' => $item->finished_date,
            'notes' => $item->notes,
            'media' => [
                'id' => $item->media->id,
                'title' => $item->media->title,
                'type' => $item->media->type,
                'poster' => $item->media->poster,
                'total_episode' => $item->media->dramaDetail?->total_episode,
                'total_season' => $item->media->dramaDetail?->total_season,
                'total_chapter' => $item->media->manhwaDetail?->total_chapter,
                'total_volume' => $item->media->manhwaDetail?->total_volume,
            ],
            'userMediaList' => $item
        ]);
    }

    public function showByMedia($mediaId)
    {
        $item = UserMediaList::with(['media' => function($query) {
            $query->with(['dramaDetail', 'manhwaDetail']);
        }])
        ->where('media_id', $mediaId)
        ->where('user_id', auth()->id())
        ->first();

        if (!$item) {
            return response()->json([
                'message' => 'Not found in your list'
            ], 404);
        }

        if (!$item->media) {
            return response()->json([
                'error' => 'Media relationship missing',
                'media_id_in_record' => $item->media_id
            ], 500);
        }

        // Format response dengan data total dari relasi
        return response()->json([
            'id' => $item->id,
            'media_id' => $item->media_id,
            'status' => $item->status,
            'progress' => $item->progress,
            'extra_progress' => $item->extra_progress,
            'rating' => $item->rating,
            'started_date' => $item->started_date,
            'finished_date' => $item->finished_date,
            'notes' => $item->notes,
            'media' => [
                'id' => $item->media->id,
                'title' => $item->media->title,
                'type' => $item->media->type,
                'poster' => $item->media->poster,
                'total_episode' => $item->media->dramaDetail?->total_episode,
                'total_season' => $item->media->dramaDetail?->total_season,
                'total_chapter' => $item->media->manhwaDetail?->total_chapter,
                'total_volume' => $item->media->manhwaDetail?->total_volume,
            ],
            'userMediaList' => $item
        ]);
    }

    public function update(Request $request, $id)
    {
        $item = UserMediaList::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $request->validate([
            'status'        => 'required|in:planned,watching,reading,completed',
            'rating'        => 'nullable|integer|min:1|max:5',
            'progress'      => 'nullable|integer|min:0',
            'extra_progress' => 'nullable|integer',
            'started_date'  => 'nullable|date',
            'finished_date' => 'nullable|date',
            'notes'         => 'nullable|string',
        ]);

        $media = $item->media->load(['dramaDetail', 'manhwaDetail']);
    
        if ($media->type === 'drama') {
            $totalEpisode = $media->dramaDetail?->total_episode;
            $totalSeason = $media->dramaDetail?->total_season;
            
            if ($totalEpisode && $request->progress && $request->progress > $totalEpisode) {
                return response()->json([
                    'success' => false,
                    'message' => "Episode tidak boleh lebih dari {$totalEpisode}"
                ], 422);
            }
            if ($totalSeason && $request->extra_progress && $request->extra_progress > $totalSeason) {
                return response()->json([
                    'success' => false,
                    'message' => "Season tidak boleh lebih dari {$totalSeason}"
                ], 422);
            }
        } 
        elseif ($media->type === 'manhwa') {
            $totalChapter = $media->manhwaDetail?->total_chapter;
            $totalVolume = $media->manhwaDetail?->total_volume;
            
            if ($totalChapter && $request->progress && $request->progress > $totalChapter) {
                return response()->json([
                    'success' => false,
                    'message' => "Chapter tidak boleh lebih dari {$totalChapter}"
                ], 422);
            }
            if ($totalVolume && $request->extra_progress && $request->extra_progress > $totalVolume) {
                return response()->json([
                    'success' => false,
                    'message' => "Volume tidak boleh lebih dari {$totalVolume}"
                ], 422);
            }
        }

        if ($request->status === 'completed' && !$request->finished_date) {
            $request->merge(['finished_date' => now()]);
        }

        $item->update($request->only([
            'status',
            'progress',
            'extra_progress',
            'rating',
            'started_date',
            'finished_date',
            'notes',
        ]));

        return response()->json(['success' => true]);
    }
    
     public function destroy($id)
    {
        $item = UserMediaList::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $item->delete();

        return response()->json([
            'success' => true,
            'message' => 'Removed from list'
        ]);
    }
}
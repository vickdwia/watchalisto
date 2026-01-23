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
            'status'        => 'required|string',
            'rating'        => 'nullable|integer|min:1|max:5',
            'progress'      => 'nullable|integer|min:0',
            'started_date'  => 'nullable|date',
            'finished_date' => 'nullable|date',
            'notes'         => 'nullable|string',

        ]);

        UserMediaList::updateOrCreate(
            [
                'user_id'  => auth()->id(),
                'media_id' => $request->media_id,
            ],
            [
                'status'        => $request->status,
                'rating'        => $request->rating,
                'progress'      => $request->progress ?? 0,
                'started_date'  => $request->started_date,
                'finished_date' => $request->finished_date,
                'notes'         => $request->notes,
            ]
        );

        return response()->json([
            'success' => true
        ]);
    }
}
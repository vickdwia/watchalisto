<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Media;
use App\Models\Genre;
use App\Models\DramaDetail;
use App\Models\ManhwaDetail;



class MediaAdminController extends Controller
{
    public function index()
    {
        // Ambil semua media sekaligus relasi genre
        $medias = Media::with('genres')->orderBy('id', 'desc')->get();

        // Ambil semua genre untuk dropdown di form
        $genres = Genre::all();

        // Kirim ke view
        return view('admin.media_admin.index', compact('medias', 'genres'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:drama,manhwa',
            'release_year' => 'required|integer|min:1900|max:2100',
            'poster' => 'required|string',
            'synopsis' => 'required|string',
            'status' => 'required|in:ongoing,finished',
            'genres' => 'required|array|min:1',
            'genres.*' => 'exists:genres,id', 

            // DRAMA
            'total_episode' => 'required_if:type,drama|nullable|integer|min:1',
            'total_season'  => 'required_if:type,drama|nullable|integer|min:1',

            // MANHWA
            'total_chapter' => 'required_if:type,manhwa|nullable|integer|min:1',
            'total_volume'  => 'required_if:type,manhwa|nullable|integer|min:1',
        ]);

        $media = Media::create([
            'title'        => $data['title'],
            'type'         => $data['type'],
            'release_year' => $data['release_year'],
            'status'       => $data['status'],
            'poster'       => $data['poster'],
            'synopsis'     => $data['synopsis'],
        ]);


        if ($data['type'] === 'drama') {
            DramaDetail::create([
                'media_id' => $media->id,
                'total_episode' => $data['total_episode'],
                'total_season' => $data['total_season'],
            ]);
        }

        if ($data['type'] === 'manhwa') {
            ManhwaDetail::create([
                'media_id' => $media->id,
                'total_chapter' => $data['total_chapter'],
                'total_volume' => $data['total_volume'],
            ]);
        }

        if (!empty($data['genres'])) {
            $media->genres()->sync($data['genres']);
        }

        return redirect()->route('admin.media.admin')->with('success', 'Media berhasil ditambahkan!');
    }

    public function update(Request $request, Media $media)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:drama,manhwa',
            'release_year' => 'required|integer|min:1900|max:2100',
            'poster' => 'required|string',
            'synopsis' => 'required|string',
            'status' => 'required|in:ongoing,finished',
            'genres' => 'required|array|min:1',
            'genres.*' => 'exists:genres,id',

            'total_episode' => 'required_if:type,drama|nullable|integer|min:1',
            'total_season'  => 'required_if:type,drama|nullable|integer|min:1',
            'total_chapter' => 'required_if:type,manhwa|nullable|integer|min:1',
            'total_volume'  => 'required_if:type,manhwa|nullable|integer|min:1',
        ]);

        $media->update([
            'title' => $data['title'],
            'type' => $data['type'],
            'release_year' => $data['release_year'],
            'poster' => $data['poster'],
            'synopsis' => $data['synopsis'],
            'status' => $data['status'],
        ]);

        // UPDATE DETAIL
        if ($data['type'] === 'drama') {
            $media->dramaDetail()->updateOrCreate(
                ['media_id' => $media->id],
                [
                    'total_episode' => $data['total_episode'],
                    'total_season' => $data['total_season'],
                ]
            );
        }

        if ($data['type'] === 'manhwa') {
            $media->manhwaDetail()->updateOrCreate(
                ['media_id' => $media->id],
                [
                    'total_chapter' => $data['total_chapter'],
                    'total_volume' => $data['total_volume'],
                ]
            );
        }

        if ($data['type'] === 'drama') {
            $media->manhwaDetail()?->delete();
        }

        if ($data['type'] === 'manhwa') {
            $media->dramaDetail()?->delete();
        }

        $media->genres()->sync($data['genres'] ?? []);

        return redirect()->route('admin.media.admin')->with('success', 'Media berhasil diperbarui!');
    }


    public function destroy(Media $media)
    {
        $media->delete();
        return response()->json(['success' => true]);
    }

    public function show($id)
    {
        $media = Media::with([
            'genres',
            'dramaDetail',
            'manhwaDetail'
        ])->findOrFail($id);

        return response()->json([
            'success' => true,
            'media' => $media
        ]);
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreAdminController extends Controller
{
    /**
     * Display a listing of genres
     */
    public function index()
    {
        $genres = Genre::withCount('media')->orderBy('name')->get();
        return view('admin.genre_admin.index', compact('genres'));
    }

    /**
     * Store a newly created genre
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:2|max:50|unique:genres,name',
        ]);

        Genre::create(['name' => $request->name]);

        return redirect()->route('admin.genre.index')
            ->with('success', 'Genre "' . $request->name . '" berhasil ditambahkan');
    }

    /**
     * Display the specified genre (for AJAX edit modal)
     */
    public function show($id)
    {
        $genre = Genre::findOrFail($id);
        return response()->json(['genre' => $genre]);
    }

    /**
     * Update the specified genre
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|min:2|max:50|unique:genres,name,' . $id,
        ]);

        $genre = Genre::findOrFail($id);
        $oldName = $genre->name;
        $genre->update(['name' => $request->name]);

        return redirect()->route('admin.genre.index')
            ->with('success', 'Genre "' . $oldName . '" berhasil diperbarui menjadi "' . $request->name . '"');
    }

    /**
     * Remove the specified genre
     */
    public function destroy($id)
    {
        $genre = Genre::findOrFail($id);

        if ($genre->media()->count() > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Genre tidak dapat dihapus karena sedang digunakan oleh ' . $genre->media_count . ' media'
            ], 422);
        }

        $genre->delete();

        return response()->json(['success' => true]);
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Media;
use App\Models\Genre;

class AdminController extends Controller
{
    // LOGIN
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('name', 'password');

        if (Auth::attempt($credentials)) {
            if (Auth::user()->role !== 'admin') {
                Auth::logout();
                return back()->withErrors([
                    'name' => 'Akun ini bukan admin'
                ]);
            }

            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'name' => 'Username atau password salah'
        ]);
    }

    // LOGOUT
    public function logout(Request $request)
        {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('admin.login');
        }

    // DASHBOARD ADMIN
    public function dashboard()
    {
        // USER STATS
        $totalUsers  = User::where('role', 'user')->count();
        $totalAdmins = User::where('role', 'admin')->count();

        // MEDIA STATS
        $totalDrama  = Media::where('type', 'drama')->count();
        $totalManhwa = Media::where('type', 'manhwa')->count();
        $totalMedia  = $totalDrama + $totalManhwa;

        // MEDIA PER GENRE
        $genres = Genre::withCount([
            'media as drama_count' => function ($q) {
                $q->where('type', 'drama');
            },
            'media as manhwa_count' => function ($q) {
                $q->where('type', 'manhwa');
            }
        ])->get();

        // MEDIA TERBARU
        $recentMedia = Media::latest()
            ->limit(5)
            ->get(['id', 'title', 'type', 'created_at']);

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalAdmins',
            'totalMedia',
            'totalDrama',
            'totalManhwa',
            'recentMedia',
            'genres'
        ));
    }
}

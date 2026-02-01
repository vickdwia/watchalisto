<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Hanya ambil user dengan role 'user' (bukan admin)
        $users = User::where('role', 'user')
                    ->withCount('media')
                    ->latest()
                    ->get();
        
        return view('admin.users_admin.index', [
            'users' => $users,
            'totalActiveUsers' => $users->count(),
            'newUsersThisWeek' => $users->where('created_at', '>=', now()->subWeek())->count(),
            'avgMediaPerUser' => $users->avg('media_count') ?? 0,
        ]);
    }
}
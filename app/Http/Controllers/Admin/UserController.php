<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('is_admin', false)
            ->latest()
            ->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        $watchlistCount = $user->movies()->count();

        $favoriteCount = $user->favorites()->count();

        return view('admin.users.show', compact(
            'user',
            'watchlistCount',
            'favoriteCount'
        ));
    }

    public function toggleBan(User $user)
    {
        if ($user->is_admin) {
            return redirect()
                ->back()
                ->with('error', 'Admin users cannot be banned.');
        }

        $user->update([
            'is_banned' => !$user->is_banned,
        ]);

        return redirect()
            ->back()
            ->with(
                'success',
                $user->is_banned
                    ? 'User banned successfully.'
                    : 'User unbanned successfully.'
            );
    }
}

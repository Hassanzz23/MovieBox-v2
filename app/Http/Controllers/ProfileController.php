<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $watchlistCount = Movie::where('user_id', auth()->id())->count();

        $favoriteCount = Favorite::where('user_id', auth()->id())->count();

        return view('profile.index', compact(
            'watchlistCount',
            'favoriteCount'
        ));
    }

    public function changeName()
    {
        return view('profile.change-name');
    }

    public function updateName(Request $request)
    {
        $validated = $request->validate(
            ['name' => 'required|string|unique:users,name,' . auth()->id(),]
        );
        auth()->user()->update(['name' => $validated['name'],]);
        return redirect()->route('profile.index')
            ->with('success', 'Name changed successfully.');
    }

    public function changePassword()
    {
        return view('profile.change-password');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:4',
            'new_password_confirmation' => 'required|same:new_password',
        ]);

        if (!Hash::check($validated['old_password'], auth()->user()->password)) {
            return back()
                ->withErrors([
                    'old_password' => 'The old password is incorrect.',
                ])
                ->withInput();
        }

        auth()->user()->update([
            'password' => Hash::make($validated['new_password']),
        ]);

        return redirect()
            ->route('profile.index')
            ->with('success', 'Password changed successfully.');
    }
}

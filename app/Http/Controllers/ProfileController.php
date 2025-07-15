<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user= $request->user();
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        if ($request->hasfile("photo")) {
            $file = $request->photo;
            $oldfile =  $user->photo;
            if ($oldfile != 'images/no-profile.png') {
                if (File::exists(public_path($oldfile))) {
                    File::delete(public_path($oldfile));
                }
            }
            $newfile = time() . "." . $file->GetClientOriginalExtension();
            $file->move("images/user", $newfile);
            $user->photo = ("images/user/$newfile");
        }
        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        $oldfile =  $user->photo;
        if ($oldfile != 'images/no-profile.png') {
            if (File::exists(public_path($oldfile))) {
                File::delete(public_path($oldfile));
            }
        }
        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}

<?php

namespace Modules\Users\Http\Controllers;

use Modules\Users\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
// use Illuminate\Routing\Controllers\HasMiddleware;
// use Illuminate\Routing\Controllers\Middleware;

class ProfileController extends Controller // implements HasMiddleware
{
    // public static function middleware() : array
    // {
    //     return[
    //         new Middleware('permission:view user', only:['index']),
    //         new Middleware('permission:edit user', only:['edit']),
    //         new Middleware('permission:create user', only:['create']),
    //         new Middleware('permission:destroy user', only:['destroy']),
    //     ];
    // }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('users::profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('users::profile.edit')->with('status', 'profile-updated');
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

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}

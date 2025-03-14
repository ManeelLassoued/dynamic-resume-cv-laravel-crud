<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    // Redirect to Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Handle Google callback
    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();

        // Find or create user
        $user = User::firstOrCreate([
            'email' => $googleUser->getEmail(),
        ], [
            'name' => $googleUser->getName(),
            'password' => bcrypt('password'), // Set a default password
        ]);

        // Log in the user
        Auth::login($user);

        return redirect('/index');
    }

    // Redirect to GitHub
    public function redirectToGithub()
    {
        return Socialite::driver('github')->redirect();
    }

    // Handle GitHub callback
    public function handleGithubCallback()
    {
        $githubUser = Socialite::driver('github')->user();

        // Use nickname as fallback if name is null
        $name = $githubUser->getName() ?? $githubUser->getNickname() ?? 'GitHub User';

        // Find or create user
        $user = User::firstOrCreate([
            'email' => $githubUser->getEmail(),
        ], [
            'name' => $name,
            'password' => bcrypt('password'),
        ]);

        // Log in the user
        Auth::login($user);

        return redirect('/index');
    }
}

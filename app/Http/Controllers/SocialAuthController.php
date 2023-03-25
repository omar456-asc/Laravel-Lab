<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider(Request $request, $provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback(Request $request, $provider)
    {
        $socialUser = Socialite::driver($provider)->user();
        
        // Check if the user already exists
        $user = User::where('email', $socialUser->getEmail())->first();

        if (!$user) {
            // If the user doesn't exist, create a new user
            $user = User::create([
                'name' => $socialUser->getName(),
                'email' => $socialUser->getEmail(),
                'password' => bcrypt(str_random(16)), // generate a random password
            ]);
        }

        // Update user info with social account info
        $user->update([
            $provider . '_id' => $socialUser->getId(),
            $provider . '_avatar' => $socialUser->getAvatar(),
            $provider . '_token' => $socialUser->token,
        ]);

        // Log in the user
        Auth::login($user, true);

        return redirect()->intended('/home');
    }

    /**
     * Disconnect the user from a social account.
     *
     * @return \Illuminate\Http\Response
     */
    
    /**
     * Connect the user to a social account.
     *
     * @return \Illuminate\Http\Response
     */
    public function connect(Request $request, $provider)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Redirect to the provider's authentication page
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Show the user's social account info.
     *
     * @return \Illuminate\Http\Response
     */
    public function socialInfo(Request $request, $provider)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Get the social account info
        $socialId = $user->{$provider . '_id'};
        $socialAvatar = $user->{$provider . '_avatar'};

        return view('auth.social_info', compact('provider', 'socialId', 'socialAvatar'));
    }
}

<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Http;
use function MongoDB\BSON\toJSON;

class SocialiteController extends Controller
{
  public function redirect($provider)
  {
    return Socialite::driver($provider)->redirect();

  }

  public function callback($provider)
  {
    $providedUser = Socialite::driver($provider)->user();

    $user = User::updateOrCreate([
      'provider_id' => $providedUser->id,
      'email' => $providedUser->email
    ], [
      'name' => $providedUser->name,
      'email' => $providedUser->email,
      'password' => Hash::make(Str::random(8)),
      'provider' => $provider,
      'provider_token' => $providedUser->token,
    ]);

    Auth::login($user);

    return redirect()->route("home");

  }
  public function info()
  {
    $data = [
      'name' => auth()->user()->name,
      'email' => auth()->user()->email,
      'provider' => auth()->user()->provider,
    ];
    return json_encode($data);
  }
}
<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Setting;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppUserController extends Controller
{
    public function init() {
      $user = Auth::user();

      $randomAdmin = Admin::first();
      $isInstalled = isset($randomAdmin->id) ? true : false;
      $settings = null;
      if ($isInstalled) {
        $settings = Setting::all();
      }

      return [
        'user' => $user,
        'isInstalled' => $isInstalled,
        'settings' => $settings
      ];
    }

    public function login(Request $request) {
      if (Auth::attempt(['email' => $request->email, 'password'=> $request->password], true)) {
        $user = User::find(Auth::id());
        return [
          'user' => $user
        ];
      } else {
        return response()->json(['message' => 'Cannot log you in.'], 401);
      }
    }

    public function register(Request $request) {
      $user = User::where('email', $request->email)->first();
      if (isset($user->id)) {
        return response()->json(['message' => 'Email ' . $request->email . ' is taken.', 'key' => 'email_taken'], 400);
      }

      $user = new User();
      $user->name = $request->name;
      $user->email = $request->email;
      $user->password = bcrypt($request->password);
      $user->save();

      Auth::login($user, true);

      return [
        'user' => $user
      ];
    }

    public function logout() {
      Auth::logout();
    }
}

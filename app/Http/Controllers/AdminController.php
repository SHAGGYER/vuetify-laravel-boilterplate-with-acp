<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function adminApp(){
      return view('admin');
    }

    public function install(Request $request) {
      $settings[] = [
        'title' => 'App Title',
        'key' => 'appTitle',
        'value' => $request->title,
        'type' => 'input'
      ];

      foreach ($settings as $setting) {
        $_setting = new Setting();
        $_setting->key = $setting['key'];
        $_setting->value = $setting['value'];
        $_setting->title = $setting['title'];
        $_setting->type = $setting['type'];
        $_setting->options = isset($setting['options']) ? json_encode($setting['options']) : null;
        $_setting->description = isset($setting['description']) ? $setting['description'] : '';
        $_setting->save();
      }

      $admin = new Admin();
      $admin->name = $request->name;
      $admin->email = $request->email;
      $admin->password = bcrypt($request->password);
      $admin->root = 1;
      $admin->save();

      Auth::guard('admin')->login($admin);

      $settings = Setting::all();

      return [
        'admin' => $admin,
        'settings' => $settings
      ];
    }

    public function init() {
      $admin = Auth::guard('admin')->user();

      $randomAdmin = Admin::first();
      $isInstalled = isset($randomAdmin->id) ? true : false;
      $settings = null;
      if ($isInstalled) {
        $settings = Setting::all();
      }

      return [
        'admin' => $admin,
        'isInstalled' => $isInstalled,
        'settings' => $settings
      ];
    }

    public function login(Request $request) {
      if (Auth::guard('admin')->attempt(['email' => $request->email, 'password'=> $request->password], true)) {
        $admin = Admin::find(Auth::guard('admin')->id());
        return [
          'admin' => $admin
        ];
      } else {
        return response()->json(['message' => 'Cannot log you in.'], 401);
      }
    }

    public function logout() {
      Auth::guard('admin')->logout();
    }
}

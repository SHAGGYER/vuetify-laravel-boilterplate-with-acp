<?php

namespace App\Http\Controllers;

use App\Category;
use App\Item;
use App\Order;
use App\OrderItem;
use App\Setting;
use App\User;
use Illuminate\Http\Request;
use Faker\Factory as Faker;

class AdminSettingsController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth:admin');
    }

    public function browse() {
      $settings = Setting::all();
      return $settings;
    }

    public function emptyDatabase() {
      User::truncate();
    }

    public function populateDatabaseWithTestData() {
      $faker = Faker::create();
      for ($i = 0; $i < 100; $i++) {
        $user = new User();
        $user->name = $faker->name;
        $user->email = $faker->email;
        $user->password = bcrypt('testtest');
        $user->address = $faker->streetAddress;
        $user->zip = $faker->numberBetween(1000, 9999);
        $user->city = $faker->city;
        $user->country = $faker->country;
        $user->save();
      }
    }

    public function save(Request $request) {
      foreach ($request->settings as $setting) {
        $_setting = Setting::where('key', $setting['key'])->first();
        $_setting->value = $setting['value'];
        $_setting->save();
      }

      $settings = Setting::all();
      return $settings;
    }
}

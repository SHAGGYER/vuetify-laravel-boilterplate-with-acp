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
      Category::truncate();
      Item::truncate();
      Order::truncate();
      OrderItem::truncate();
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

      for ($i = 0; $i < 25; $i++) {
        $category = new Category();
        $category->title = $faker->word;
        $category->save();
      }

      for ($i = 0; $i < 150; $i++) {
        $item = new Item();
        $item->title = $faker->word;
        $item->description = $faker->paragraph;
        $item->price = $faker->numberBetween(3000, 12000);

        $randomCategory = Category::query()->inRandomOrder()->first();
        $item->category_id = $randomCategory->id;
        $item->save();
      }

      for ($i = 0; $i < 50; $i++) {
        $order = new Order();
        $randomUser = User::query()->inRandomOrder()->first();
        $order->user_id = $randomUser->id;
        $order->status = 'pending';
        $order->address = $randomUser->address;
        $order->zip = $randomUser->zip;
        $order->city = $randomUser->city;
        $order->country = $randomUser->country;
        $order->save();

        for ($j = 0; $j < $faker->numberBetween(1, 5); $j++) {
          $orderItem = new OrderItem();
          $orderItem->order_id = $order->id;
          $randomItem = Item::query()->inRandomOrder()->first();

          $orderItem->item_id = $randomItem->id;
          $orderItem->quantity = $faker->numberBetween(1, 4);
          $orderItem->save();
        }
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

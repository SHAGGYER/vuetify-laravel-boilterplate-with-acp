<?php

namespace App\Http\Controllers;

use App\Admin;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAdministratorsController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:admin');
  }

  public function getDashboardData() {
    $items[] = ['title' => 'Admins', 'count' => Admin::count()];
    $items[] = ['title' => 'Users', 'count' => User::count()];
    return $items;
  }

  public function browse(Request $request) {
    $admins = Admin::query();

    if (isset($request->searchQuery)){
      $admins->where('name', 'like', '%'.$request->searchQuery.'%');
    }


    if (isset($request->paginate)) {
      $admins = $admins->paginate(10);

    } else {
      $admins = $admins->get();
    }

    return $admins;
  }

  public function update(Request $request) {
    $admin = Admin::find($request->id);
    $admin->name = $request->name;
    $admin->email = $request->email;
    if (isset($request->password)) {
      $admin->password = bcrypt($request->password);
    }
    $admin->save();
  }

  public function create(Request $request){
    $admin = new Admin();
    $admin->name = $request->name;
    $admin->email = $request->email;
    $admin->password = bcrypt($request->password);
    $admin->save();
    return $admin;
  }

  public function getById($id) {
    $admin = Admin::find($id);
    if(!isset($admin->id)) {
      return response()->json(['message' => 'Admin was not found'], 404);
    }

    return $admin;
  }

  public function delete($id) {
    $admin = Admin::find($id);
    $admin->delete();
  }
}

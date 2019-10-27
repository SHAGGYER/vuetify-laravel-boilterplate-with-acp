<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminUsersController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth:admin');
    }

    public function browse(Request $request) {
      $users = User::query();

      if (isset($request->searchQuery)){
        $users->where('name', 'like', '%'.$request->searchQuery.'%');
      }


      if (isset($request->paginate)) {
        $users = $users->paginate(10);

      } else {
        $users = $users->get();
      }

      return $users;
    }

    public function update(Request $request) {
      $user = User::find($request->id);
      $user->name = $request->name;
      $user->email = $request->email;
      if (isset($request->password)) {
        $user->password = bcrypt($request->password);
      }
      $user->save();
    }

    public function create(Request $request){
      $user = new User();
      $user->name = $request->name;
      $user->email = $request->email;
      $user->password = bcrypt($request->password);
      $user->save();
      return $user;
    }

    public function getById($id) {
      $user = User::find($id);
      if(!isset($user->id)) {
        return response()->json(['message' => 'User was not found'], 404);
      }

      return $user;
    }

    public function delete($id) {
      $user = User::find($id);
      $user->delete();
    }
}

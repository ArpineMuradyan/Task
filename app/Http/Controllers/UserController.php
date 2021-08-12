<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;

class UserController extends Controller
{
    public function getUsersInfo(){
      $count = User::all()->count();
      if($count<6) {
        $user =User::select("id", "name", "email")->get();
      } else {
        $user =User::select("id", "name", "email")->get()->random(5);
      }
      return response()->json([
            'user' => $user
        ], Response::HTTP_OK);
    }

    public function getUser(){
      $user = User::select("id", "name")->get();
      return response()->json([
            'user' => $user
        ], Response::HTTP_OK);
    }
}

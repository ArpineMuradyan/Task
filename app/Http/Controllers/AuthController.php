<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Validator;

class AuthController extends Controller
{
  public function register(Request $request) {
    $data=$request->all();
    $rules = [
      'name' => ['required'],
      'email' => ['required', 'email', 'unique:users'],
      'password' => ['required', 'min:6', 'confirmed']
    ];
    $validator = Validator::make($data, $rules);

    if ($validator->fails()) {
      return response()->json(
        [
          "success" => false,
          "errors" => $validator->messages(),
        ]);
    } else {
      $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password)
      ]);
      if($user){
        return response()->json(["success" => true]);
      }
    }
  }

  public function login(Request $request){
    $data=$request->all();
    $rules = [
      'email' => ['required', 'email'],
      'password' => ['required']
    ];
    $validator = Validator::make($data, $rules);

    if ($validator->fails()) {
      return response()->json(
        [
          "success" => false,
          "errors" => $validator->messages(),
        ]);
    } else {

      if(Auth::attempt($request->only('email', 'password'))){
        return response()->json([
          "user" => Auth::user(),
          "success" => true
        ]);
      }
      throw ValidationException::withMessages([
        'email' => ['The provided credentials are incorrect.']
      ]);
    }
  }

  public function logout(){
    if(Auth::logout()){
        return view('welcome');
    }

  }
}

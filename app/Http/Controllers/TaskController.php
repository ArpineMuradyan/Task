<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Tasks;
use Auth;
use Validator;

class TaskController extends Controller
{
    public function saveTask(Request $request){
      $data=$request->all();
      $rules = [
        'user' => ['required'],
        'description' => ['required']
      ];
      $validator = Validator::make($data, $rules);

      if ($validator->fails()) {
        return response()->json(
          [
            "success" => false,
            "errors" => $validator->messages(),
          ]);
      } else {

        Tasks::create([
          'user_id' => $request->user,
          'description' => $request->description,
          'status' => 0
        ]);
        $user = Auth::user();
        $tasks = Tasks::select('id', 'user_id', 'description', 'status')
          ->where("user_id", $user->id)->get();
        return response()->json([
            'tasks' => $tasks
        ], Response::HTTP_OK);
      }
    }

    public function getTask(){
      $user = Auth::user();
      $tasks = Tasks::select('id', 'user_id', 'description', 'status')
        ->where("user_id", $user->id)->get();
      return response()->json([
          'tasks' => $tasks
      ], Response::HTTP_OK);
    }

    public function changeStatus(Request $request){
      $task = Tasks::find($request->id);
      $task->status = $request->status;
      $task->save();
      $user = Auth::user();
      $tasks = Tasks::select('id', 'user_id', 'description', 'status')
        ->where("user_id", $user->id)->get();
      return response()->json([
          'tasks' => $tasks
      ], Response::HTTP_OK);
    }
}

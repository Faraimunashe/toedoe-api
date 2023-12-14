<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $tasks = Task::all();

            $response = [
                'message' => 'Success',
                'data' => $tasks
            ];

            return response()->json($response, 200);
        }catch(\Exception $e)
        {
            $response = [
                'message' => 'Exception error'
            ];

            return response()->json($response, 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $rules = [
                'name' => ['required', 'string'],
            ];

            $validator = Validator::make($request->all(), $rules);
            if($validator->fails())
            {
                $errors = $validator->errors();
                $response = [
                    'message' => 'Validation error',
                    'errors' => $errors->all()
                ];

                return response()->json($response, 400);
            }

            $task = new Task();
            $task->name = $request->name;
            $task->save();

            $response = [
                'message' => 'Successfully created a new task',
                'data' => $task
            ];

            return response()->json($response, 201);
        }catch(\Exception $e)
        {
            $response = [
                'message' => 'Exception error'
            ];

            return response()->json($response, 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $rules = [
                'name' => ['required', 'string'],
            ];

            $validator = Validator::make($request->all(), $rules);
            if($validator->fails())
            {
                $errors = $validator->errors();
                $response = [
                    'message' => 'Validation error',
                    'errors' => $errors->all()
                ];

                return response()->json($response, 400);
            }

            $task = Task::find($id);
            $task->name = $request->name;
            $task->save();

            $response = [
                'message' => 'Successfully updated task',
                'data' => $task
            ];

            return response()->json($response, 200);
        }catch(\Exception $e)
        {
            $response = [
                'message' => 'Exception error'
            ];

            return response()->json($response, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{

            $task = Task::find($id);
            if(is_null($task))
            {
                return response()->json(['message'=>'record not found'], 404);
            }
            $task->delete();

            $response = [
                'message' => 'Successfully deleted a task'
            ];

            return response()->json($response, 200);
        }catch(\Exception $e)
        {
            $response = [
                'message' => 'Exception error'
            ];

            return response()->json($response, 500);
        }
    }
}

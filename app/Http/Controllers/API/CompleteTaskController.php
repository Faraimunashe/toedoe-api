<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Task;

class CompleteTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $rules = [
                'is_completed' => ['required'],
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
            $task->is_completed = $request->is_completed;
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
        //
    }
}

<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $task = $request->user()->task;
            if (count($task) == 0) {
                return response()->json(["message" => "No task"],404);
            } else
                return response()->json(["data" => TaskResource::collection($task)],200);
        } catch (\Throwable $th) {
            return response()->json(["message" => $th->getMessage()],500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddTaskRequest $request)
    {
        try {
            $data = $request->validated();
            $data['user_id'] = $request->user()->id;
            $response = Task::create($data);
            return response()->json(["message" => "Task created succesfully", "data" => new TaskResource($response)], 200);
        } catch (\Throwable $th) {
            return response()->json(["message" => $th->getMessage()],500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $task = Task::find($id);
            return response()->json(["data" => new TaskResource($task)], 200);
        } catch (\Throwable $th) {
            return response()->json(["message" => $th->getMessage()],500);

        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, string $id)
    {
        try {
            $data = $request->validated();
            $data['user_id'] = auth()->user()->id;
            $task = Task::find($id);
            if (!$task) {
                return response()->json(["message" => "invalid task"], 404);
            } else {
                $task->fill($data);
                $response = $task->save();
                return response()->json(["message" => "Task Updated"], 200);
            }
        } catch (\Throwable $th) {
            return response()->json(["message" => $th->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $task = Task::find($id);
            if (!$task) {
                return response()->json(["message" => "invalid task"], 404);
            } else {
                Task::destroy($id);
                return response()->json(["message" => "Task deleted"], 200);
            }
        } catch (\Throwable $th) {
            return response()->json(["message" => $th->getMessage()], 500);
        }
    }
}

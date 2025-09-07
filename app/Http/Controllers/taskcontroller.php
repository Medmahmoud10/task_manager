<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all tasks from the database.
        $tasks = Task::with('categorie')->get();

        // Return JSON response for API
        return response()->json([
            'status' => 'success',
            'data' => $tasks
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data.
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|integer',
            'status' => 'required|in:pending,in_progress,completed',
            'profile_id' => 'nullable|exists:profiles,id',
            'categorie_id' => 'nullable|exists:categories,id',
            'user_id' => 'nullable|exists:users,id',
        ]);

        // Create a new task with the validated data.
        $task = Task::create($validatedData);

        // Return JSON response for API
        return response()->json([
            'status' => 'success',
            'message' => 'Task created successfully!',
            'data' => $task
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find the task by its ID.
        $task = Task::with('categorie')->find($id);

        if (!$task) {
            return response()->json([
                'status' => 'error',
                'message' => 'Task not found'
            ], 404);
        }

        // Return JSON response for API
        return response()->json([
            'status' => 'success',
            'data' => $task
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Find the task by its ID.
        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'status' => 'error',
                'message' => 'Task not found'
            ], 404);
        }

        // Validate the incoming request data.
        $validatedData = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'sometimes|required|integer',
            'status' => 'sometimes|required|in:pending,in_progress,completed',
            'profile_id' => 'nullable|exists:profiles,id',
            'categorie_id' => 'nullable|exists:categories,id',
            'user_id' => 'nullable|exists:users,id',
        ]);

        // Update the task with the validated data.
        $task->update($validatedData);

        // Return JSON response for API
        return response()->json([
            'status' => 'success',
            'message' => 'Task updated successfully!',
            'data' => $task
        ]);
    }

    /**
     * Update the status of a specific task.
     */
    public function updateStatus(Request $request, Task $task)
    {
        // Validate the incoming request data.
        $validatedData = $request->validate([
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        // Update the task's status with the validated data.
        $task->update($validatedData);

        // Return JSON response for API
        return response()->json([
            'status' => 'success',
            'message' => 'Task status updated successfully!',
            'data' => $task
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the task by its ID.
        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'status' => 'error',
                'message' => 'Task not found'
            ], 404);
        }

        // Delete the task
        $task->delete();

        // Return JSON response for API
        return response()->json([
            'status' => 'success',
            'message' => 'Task deleted successfully!'
        ]);
    }
}
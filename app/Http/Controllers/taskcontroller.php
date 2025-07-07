<?php

namespace App\Http\Controllers;

use App\Http\Requests\storetaskrequest;
use App\Http\Requests\updatetaskrequest;
use App\Models\categories;
use App\Models\task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class taskcontroller extends Controller
{


    public function addcategorietotask(Request $request, $task_id)
    {
        $task = task::find($task_id);
        $task->categories()->attach($request->categories_id);
        return response()->json(['message' => 'Categories added to task successfully'], 200);
    }



    public function GetCategorietoTask($task_id)
    {
        $categories = DB::table('categorie_task')
            ->where('task_id', $task_id)
            ->join('categories', 'categorie_task.categorie_id', '=', 'categories.id')
            ->select([
                'categories.id',
                'categories.name',
                'categories.created_at',
                'categories.updated_at',
                'categorie_task.task_id',
                'categorie_task.categorie_id'
            ])
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at,
                    'pivot' => [
                        'task_id' => $item->task_id,
                        'category_id' => $item->categorie_id
                    ]
                ];
            });

        return response()->json($categories);
    }

    public function getTaskCategories($task_id)
    {
        $task = \App\Models\task::with('categories')->find($task_id);

        // Return error if task doesn't exist
        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }

        // Return formatted categories
        return response()->json($task->categories);
    }



    // app/Http/Controllers/TaskController.php
    public function indexCategories(Task $task)
    {
        return response()->json(
            $task->categories->map(function ($category) use ($task) {
                return [
                    'id' => $category->id,
                    'name' => $category->name,
                    'created_at' => $category->created_at,
                    'updated_at' => $category->updated_at,
                    'pivot' => [
                        'task_id' => $task->id,
                        'category_id' => $category->id
                    ]
                ];
            })
        );
        return $task->categories;
    }




    // public function getProfileTasks($profileId)
    // {
    //     $tasks = Task::where('profile_id', $profileId)->get();
    //     return response()->json($tasks);
    // }

    // public function getTaskWithRelations($taskId)
    // {
    //     $task = Task::with(['profile', 'category'])->findOrFail($taskId);
    //     return response()->json($task);
    // }
    public function index(task $task)
    {
        $task = task::all();
        return response()->json($task, 200);
        $task->load(['categories' => function ($query) {
            $query->select('categories.id', 'name', 'created_at', 'updated_at');
        }]);

        return $task->categories;
    }

   

    /**
     * Update the category of a task.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $task_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateTaskCategory(Request $request, $task_id)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id'
        ]);

        $task = Task::findOrFail($task_id);
        $task->update(['category_id' => $validated['category_id']]);

        return response()->json($task);
    }

    public function store(storetaskrequest $request)
    {
        $task = task::create($request->validated());
        DB::table('categorie_task')->insert([
            'task_id' => $task->id,
            'categorie_id' => $request->categorie_id,
        ]);

        return response()->json($task, 201);
    }


    public function show(int $id, Request $request)
    {
        $task = Task::query();

        // Load relationships only if requested
        if ($request->has('with')) {
            $task->with(explode(',', $request->with));
        }

        $task = $task->find($id);
        return response()->json($task, 200);
    }


    public function update(updatetaskrequest $request, string $id)
    {

        $task = task::find($id);
        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }
        $task->update($request->validated());
        return response()->json($task, 200);
    }


    public function destroy(string $id)
    {
        $task = task::find($id);
        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }
        $task->delete();
        return response()->json(['message' => 'Task deleted successfully'], 200);
    }
};







//public function show(int $id)
    // {
    //     $task = task::find($id);
    //     return response()->json($task, 200);
    // }

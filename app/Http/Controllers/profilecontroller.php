<?php

namespace App\Http\Controllers;

use App\Http\Requests\profilerequestcontroller;
use App\Http\Requests\storetaskrequest;
use App\Http\Requests\updateprofilerequestcontroller;
use App\Models\profile;
use App\Models\task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class profilecontroller extends Controller
{


    public function getCategoryTasks($categorie_id)
    {
        $tasks = task::where('categorie_id', $categorie_id)->get();
        return response()->json($tasks);
    }



    public function storeTaskUnderProfile(storetaskrequest $request, $profileId)
{
     $task = Task::create($request->validated());
    
    return response()->json([
        'success' => true,
        'task' => $task->load('categorie') // Eager load category
    ], 201);
}



    public function index()
    {
        $profile = profile::all();
        return response()->json($profile, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storetaskrequest $request, profile $profile)
    {
        $task = $profile->tasks()->create($request->validated());

        return response()->json([
            'success' => true,
            'task' => [
                'id' => $task->id,
                'title' => $task->title,
                'priority' => $task->priority,
                'profile_id' => $task->profile_id,
                'category' => $task->category->name // Loads relationship
              ]
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $profile = profile::find($id);
        return response()->json($profile, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateprofilerequestcontroller $request, string $id)
    {
        $profile = profile::findOrFail($id);
        $profile->update($request->validated());
        return response()->json($profile, 200);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $profile = profile::findOrFail($id);
        $profile->delete();
        return response()->json(null, 204);
    }
}

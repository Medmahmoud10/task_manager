<?php

namespace App\Http\Controllers;

use App\Http\Requests\storetaskcontroller;
use App\Http\Requests\updatetaskcontroller;
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



    public function index()
    {
        $task = task::all();
        return response()->json($task,200);
    }

    
    public function store(storetaskcontroller $request)
    {
        $task = task::create($request->validated());
        DB::table('categorie_task')->insert([
            'task_id' => $task->id,
            'categorie_id' => $request->categorie_id,
        ]);

        return response()->json($task, 201);
    }

    
    public function show(int $id)
    {
        $task = task::find($id);
        return response()->json($task, 200);
    }

    
    public function update(updatetaskcontroller $request, string $id)
    {
        $task = task::findorFail($id);
        $task->update($request->validated());
        return response()->json($task, 200);
    }

    
    public function destroy(string $id)
    {
        $task = task::findOrFail($id);
        $task->delete();
        return response()->json(null, 204);
    
    }
}

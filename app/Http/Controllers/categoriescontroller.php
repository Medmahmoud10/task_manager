<?php

namespace App\Http\Controllers;
use App\Models\task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class categoriescontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($categorie_id)
    {
        $tasks = task::where('categorie_id', $categorie_id)->get();
        return response()->json($tasks);
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, $taskId)
    {
        DB::table('tasks')
            ->where('id', $taskId)
            ->update(['category_id' => $request->category_id]);

        return response()->json(['message' => 'Category updated']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

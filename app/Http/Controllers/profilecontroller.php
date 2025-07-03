<?php

namespace App\Http\Controllers;

use App\Http\Requests\profilerequestcontroller;
use App\Http\Requests\updateprofilerequestcontroller;
use App\Models\profile;
use Illuminate\Http\Request;

class profilecontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile=profile::all();
        return response()->json($profile, 200); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(profilerequestcontroller $request)
    {
        $profile = profile::create($request->all());
        return response()->json($profile, 201);
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
        $profile->update($request->all());
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

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestCategorie;
use App\Http\Requests\UpdateCategorieRequest;
use App\Http\Resources\Categories as ResourcesCategories;
use App\Models\categories;
use App\Http\Resources\CategoriesR as CategoriesResource;
use App\Models\task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /**
     * Display a listing of categories.
     * @param RequestCategorie $request The request containing filter parameters
     * @return \Illuminate\Http\JsonResponse
     * @route GET /api/categories
     * @response [
     *   {
     *     "id": 1,
     *     "name": "Work",
     *     "created_at": "2024-01-01T00:00:00.000000Z",
     *     "updated_at": "2024-01-01T00:00:00.000000Z"
     *   },
     *   {
     *     "id": 2, 
     *     "name": "Personal",
     *     "created_at": "2024-01-01T00:00:00.000000Z",
     *     "updated_at": "2024-01-01T00:00:00.000000Z"
     *   }
     * ]
     */
    // This function retrieves a list of categories with their related tasks
    // Parameters:
    //   - $request: RequestCategorie object containing optional name filter
    // Returns:
    //   - JSON response with:
    //     - status: success/error
    //     - data: array of categories with tasks
    //     - total: count of categories
    //   - 500 error response on failure
    public function index()
    {
        try {
            $categories = categories::all();
            return ResourcesCategories::collection($categories);
            $tasks = task::with('category')->get();  // eager load category relation    
            return response()->json($tasks);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch categories',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RequestCategorie $request)
    {
        // Validate request data using RequestCategorie validation rules
        try {
            // Create new category using validated data
            $category = categories::create($request->validated());

            // Return success response with created category
            return response()->json($category, 201);
        } catch (\Exception $e) {
            // Return error response if creation fails
            return response()->json([
                'error' => 'Failed to create category',
                'message' => $e->getMessage()
            ], 500);
        }
    }
    /**
     * Display the specified resource.
     */


    /**
     * Display the specified resource.
     * @param string $id The ID of the category to retrieve
     * @return \Illuminate\Http\JsonResponse
     * @route GET /api/categories/{id}
     * @response {
     *   "id": 1,
     *   "name": "Work",
     *   "created_at": "2024-01-01T00:00:00.000000Z",
     *   "updated_at": "2024-01-01T00:00:00.000000Z"
     * }
     */
    public function show(string $id)
    {
        try {
            $category = categories::findOrFail($id);
            return response()->json($category);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Category not found',
                'message' => $e->getMessage()
            ], 404);
        }
    }
    /**
     * Update the specified resource in storage.
     */
    /**
     * Update the specified resource in storage.
     * @param RequestCategorie $request The request containing category data
     * @param string $id The ID of the category to update
     * @return \Illuminate\Http\JsonResponse
     * @route PUT /api/categories/{id}
     * @response {
     *   "id": 1,
     *   "name": "Updated Work Category",
     *   "created_at": "2024-01-01T00:00:00.000000Z", 
     *   "updated_at": "2024-01-01T12:00:00.000000Z"
     * }
     */
    public function update(UpdateCategorieRequest $request, string $id)
    {
        try {
            $categorie = categories::findOrFail($id);
            $categorie->update($request->validated());

            return response()->json([
                'message' => 'Category updated successfully',
                'data' => $categorie
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to update category',
                'message' => $e->getMessage()
            ], 404);
        }
    }
    public function destroy(string $id)
    {
        $category = categories::findOrFail($id);
        $category->delete();
        return response()->json(['message' => 'Category deleted successfully']);
    }

    // public function tasks($categorie_id)
    // {
    //     $tasks = Task::where('categorie_id', $categorie_id)->get();
    //     return response()->json($tasks);
    // }
}

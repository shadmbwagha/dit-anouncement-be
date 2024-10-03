<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    // Create a new category
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string',
        ]);

        $category = Category::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return response()->json(['message' => 'Category created successfully!', 'category' => $category], 201);
    }

    // Retrieve all categories
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    // Update an existing category
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
        ]);

        $category->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return response()->json(['message' => 'Category updated successfully!', 'category' => $category], 200);
    }

    // Delete a category
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json(['message' => 'Category deleted successfully!'], 200);
    }
}
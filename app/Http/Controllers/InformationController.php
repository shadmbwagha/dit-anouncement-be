<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Information;


class InformationController extends Controller
{
    // Store new information
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'expiration_date' => 'nullable|date',
        ]);

        $information = Information::create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'expiration_date' => $request->expiration_date,
            'is_active' => true,
        ]);

        return response()->json(['message' => 'Information posted successfully!', 'information' => $information], 201);
    }

    // Retrieve all information
    public function index()
    {
        $information = Information::with('category')->get();

        return response()->json($information);
    }

    // Update an information record
    public function update(Request $request, $id)
    {
        $information = Information::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'expiration_date' => 'nullable|date',
            'is_active' => 'boolean',
        ]);

        $information->update([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'expiration_date' => $request->expiration_date,
            'is_active' => $request->is_active,
        ]);

        return response()->json(['message' => 'Information updated successfully!', 'information' => $information], 200);
    }

    // Delete an information record
    public function destroy($id)
    {
        $information = Information::findOrFail($id);
        $information->delete();

        return response()->json(['message' => 'Information deleted successfully!'], 200);
    }
}
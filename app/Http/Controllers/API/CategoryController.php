<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\ChildCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // Get all categories with subcategories and child categories
    public function index()
    {
        $categories = Category::with('subcategories.childCategories')->get();
        return response()->json($categories);
    }

    // Create a new category
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $category = Category::create([
            'name' => $request->name,
        ]);

        return response()->json($category, 201);
    }

    // Update a category
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $category = Category::findOrFail($id);
        $category->update([
            'name' => $request->name,
        ]);

        return response()->json($category);
    }

    // Delete a category
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json(['message' => 'Category deleted successfully']);
    }

    // Create a new subcategory
    public function storeSubcategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $subcategory = Subcategory::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
        ]);

        return response()->json($subcategory, 201);
    }

    // Update a subcategory
    public function updateSubcategory(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $subcategory = Subcategory::findOrFail($id);
        $subcategory->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
        ]);

        return response()->json($subcategory);
    }

    // Delete a subcategory
    public function destroySubcategory($id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $subcategory->delete();

        return response()->json(['message' => 'Subcategory deleted successfully']);
    }

    // Create a new child category
    public function storeChildCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'subcategory_id' => 'required|exists:subcategories,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $childCategory = ChildCategory::create([
            'name' => $request->name,
            'subcategory_id' => $request->subcategory_id,
        ]);

        return response()->json($childCategory, 201);
    }

    // Update a child category
    public function updateChildCategory(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'subcategory_id' => 'required|exists:subcategories,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $childCategory = ChildCategory::findOrFail($id);
        $childCategory->update([
            'name' => $request->name,
            'subcategory_id' => $request->subcategory_id,
        ]);

        return response()->json($childCategory);
    }

    // Delete a child category
    public function destroyChildCategory($id)
    {
        $childCategory = ChildCategory::findOrFail($id);
        $childCategory->delete();

        return response()->json(['message' => 'Child category deleted successfully']);
    }
}
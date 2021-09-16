<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = auth()->user()->categories;
 
        return response()->json([
            'success' => true,
            'data' => $categories
        ]);
    }
 
    public function show($id)
    {
        $category = auth()->user()->categories()->find($id);
 
        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found '
            ], 400);
        }
 
        return response()->json([
            'success' => true,
            'data' => $category->toArray()
        ], 400);
    }
 
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required'
        ]);
 
        $category = new Category();
        $category->name = $request->name;
        $category->slug = $request->slug;
 
        if (auth()->user()->categories()->save($category))
            return response()->json([
                'success' => true,
                'data' => $category->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Category not added'
            ], 500);
    }
 
    public function update(Request $request, $id)
    {
        $category = auth()->user()->categories()->find($id);
 
        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found'
            ], 400);
        }
 
        $updated = $category->fill($request->all())->save();
 
        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Category can not be updated'
            ], 500);
    }
 
    public function destroy($id)
    {
        $category = auth()->user()->categories()->find($id);
 
        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found'
            ], 400);
        }
 
        if ($category->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Category can not be deleted'
            ], 500);
        }
    }
}

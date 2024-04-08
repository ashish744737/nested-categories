<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Helper;

class CategoryController extends Controller
{
    public function createCategory(Request $request)
    {
        $categories = Category::where('parent_id', null)->orderby('name', 'asc')->get();
        if($request->method()=='GET')
        {
            return view('create-category', compact('categories'));
        }
        if($request->method()=='POST')
        {
            $validator = $request->validate([
                'name'      => 'required',
                'slug'      => 'required|unique:categories',
                'status'      => 'required',
                'parent_id' => 'nullable|numeric'
            ]);

            Category::create([
                'name' => $request->name,
                'slug' => $request->slug,
                'status' => $request->status,
                'parent_id' =>$request->parent_id
            ]);

            return redirect()->back()->with('success', 'Category has been created successfully.');
        }
    }
    public function allCategories()
    {
        $categories = Category::where('parent_id', null)->orderby('name', 'asc')->get();
        return view('all-category', compact('categories'));
    }

    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        if(count($category->subcategory))
        {
            $subcategories = $category->subcategory;
            foreach($subcategories as $cat)
            {
                $cat = Category::findOrFail($cat->id);
                $cat->parent_id = isset($category->parent_id)?$category->parent_id : null;
                $cat->save();
            }
        }
        $category->delete();
        return redirect()->back()->with('delete', 'Category has been deleted successfully.');
    }

 
    public function editCategory($id, Request $request)
    {
        $category = Category::findOrFail($id);
       
        $parents = Helper::getParentsAttribute($category);

        if($request->method()=='GET')
        {
            $categories = Category::where('parent_id', null)->where('id', '!=', $category->id)->orderby('name', 'asc')->get();
            return view('edit-category', compact('category', 'categories','parents'));
        }

        if($request->method()=='POST')
        {
            $validator = $request->validate([
                'name'     => 'required',
                'slug' => ['required', Rule::unique('categories')->ignore($category->id)],
                'status'     => 'required',
                'parent_id'=> 'nullable|numeric'
            ]);
            if($request->name != $category->name || $request->parent_id != $category->parent_id)
            {
                if(isset($request->parent_id))
                {
                    $checkDuplicate = Category::where('name', $request->name)->where('parent_id', $request->parent_id)->first();
                    if($checkDuplicate)
                    {
                        return redirect()->back()->with('error', 'Category already exist in this parent.');
                    }
                }
                else
                {
                    $checkDuplicate = Category::where('name', $request->name)->where('parent_id', null)->first();
                    if($checkDuplicate)
                    {
                        return redirect()->back()->with('error', 'Category already exist with this name.');
                    }
                }
            }

            $category->name = $request->name;
            $category->parent_id = $request->parent_id;
            $category->status = $request->status;
            $category->slug = $request->slug;
            $category->save();
            return redirect()->back()->with('success', 'Category has been updated successfully.');
        }
    }
}
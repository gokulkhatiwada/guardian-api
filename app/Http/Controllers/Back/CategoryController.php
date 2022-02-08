<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with(['createdBy'=>function($query){
            $query->select('id','name');
        },'updatedBy'=>function($query){
            $query->select('id','name');
        }])->get();

        return view('back.categories.index',compact('categories'));
    }

    public function store(Request $request)
    {
        Category::create([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name,'-')
        ]);

        return redirect()->route('category.index')->with('success','Category created successfully');
    }


    public function edit(string $slug)
    {
        $category = Category::where('slug',$slug)->first();
        if(!$category) abort(404);

        return view('back.categories.update',compact('category'));
    }

    public function update(Request $request, string $slug)
    {
        $category = Category::where('slug',$slug)->first();
        if(!$category) {
            return redirect()->back()->with('error','Category not found');
        }

        $category->update([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name,'-')
        ]);

        return redirect()->route('category.index')->with('success','Category updated successfully');
    }

    public function destroy(Request $request,string $slug)
    {
        $category = Category::where('slug',$slug)->first();
        if(!$category) {
            return redirect()->back()->with('error','Category not found');
        }

        $category->delete();

        return redirect()->route('category.index')->with('success','Category deleted');
    }
}
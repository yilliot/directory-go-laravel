<?php

namespace App\Http\Controllers\Office;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    function getList(Request $request)
    {
        $categories = Category::with('areas')->orderBy('order', 'asc')->get();

        return view('office.category.list', compact('categories'));
    }
    function postCreate(Request $request)
    {
        $max = Category::max('order');
        $category = new Category();
        $category->name = $request->name;
        $category->order = $max + 1;
        $category->save();

        return back()->with('success', 'Success');
    }
    function postEdit(Request $request)
    {
        if ($request->action === 'delete') {
            \DB::table('area_categories')
                ->where('category_id', $request->id)
                ->delete();
            Category::where('id', $request->id)
                ->delete();
        } else {
            $category = Category::find($request->id);
            $category->name = $request->name;
            $category->save();
        }

        return back()->with('success', 'Success');
    }
    function postOrder(Request $request)
    {
        $category = Category::find($request->id);
        $max = Category::max('order');

        if ($request->direction == 'up' && $category->order > 1) {
            $category->order -= 1;
            $categoryPrev = Category::where('order', $category->order)->first();
            $categoryPrev->order += 1;
            $categoryPrev->save();
            $category->save();
        }
        if ($request->direction == 'down' && $category->order < $max) {
            $category->order += 1;
            $categoryPrev = Category::where('order', $category->order)->first();
            $categoryPrev->order -= 1;
            $categoryPrev->save();
            $category->save();
        }

        return back()->with('success', 'Success');
    }
}

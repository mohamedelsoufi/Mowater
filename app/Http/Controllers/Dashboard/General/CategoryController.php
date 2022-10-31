<?php

namespace App\Http\Controllers\Dashboard\General;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Section;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        $sections = Section::all();
        return view('dashboard.general.categories.index', compact('categories', 'sections'));
    }


    public function create()
    {
        //
    }

    public function store(CategoryRequest $request)
    {
        try {
            Category::create($request->except(['_token']));
            return redirect()->route('categories.index')->with(['success' => __('message.created_successfully')]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => __('message.something_wrong') . $e->getMessage()]);
        }
    }


    public function show($id)
    {
        $show_category = Category::find($id);
        $show_category->makeVisible('name_en', 'name_ar');
        $sections = Section::all();
        $data = compact('show_category', 'sections');
        return response()->json(['status' => true, 'data' => $data]);
    }


    public function edit($id)
    {
        //
    }

    public function update(CategoryRequest $request, $id)
    {
        $category = Category::find($id);
        $update_category = $category->update($request->except(['_token']));
        if ($update_category) {
            return redirect()->route('categories.index')->with(['success' => __('message.updated_successfully')]);
        } else {
            return redirect()->route('categories.index')->with(['error' => __('message.something_wrong')]);
        }
    }


    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('categories.index')->with(['success' => __('message.deleted_successfully')]);

    }
}

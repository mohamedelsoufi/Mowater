<?php

namespace App\Http\Controllers\Dashboard\General;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategoryRequest;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index()
    {
        $sub_categories = SubCategory::all();
        $categories = Category::all();
        return view('dashboard.general.sub_categories.index', compact('sub_categories','categories'));
    }


    public function create()
    {
        //
    }

    public function store(SubCategoryRequest $request)
    {
        $sub_category = SubCategory::create($request->except(['_token']));
        if ($sub_category) {
            return redirect()->route('sub-categories.index')->with(['success'=>__('message.created_successfully')]);
        } else {

            return redirect()->back()->with(['error'=>__('message.something_wrong')]);
        }
    }


    public function show($id)
    {
        $show_category = SubCategory::find($id);
        $show_category->makeVisible('name_en', 'name_ar');
        $categories = Category::all();
        $data = compact('show_category','categories');
        return response()->json(['status' => true, 'data'=>$data]);
    }


    public function edit($id)
    {
        //
    }

    public function update(SubCategoryRequest $request, $id)
    {
        $sub_category = SubCategory::find($id);
        $update_category = $sub_category->update($request->except(['_token']));
        if ($update_category)
        {
            return redirect()->route('sub-categories.index')->with(['success'=>__('message.updated_successfully')]);
        }else{
            return redirect()->route('sub-categories.index')->with(['error'=> __('message.something_wrong')]);
        }
    }


    public function destroy($id)
    {
        $sub_category = SubCategory::find($id);
        $sub_category->delete();
        return redirect()->route('sub-categories.index')->with(['success'=> __('message.deleted_successfully')]);

    }
}

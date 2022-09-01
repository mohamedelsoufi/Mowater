<?php

namespace App\Http\Controllers\Dashboard\Organizations;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminSpecialNumberCategoryRequest;
use App\Http\Requests\SpecialNumberCategoryRequest;
use App\Models\SpecialNumberCategory;
use Illuminate\Http\Request;

class SpecialNumberCategoryController extends Controller
{
    public function index()
    {
        $special_number_categories = SpecialNumberCategory::latest('id')->get();
        return view('dashboard.organizations.special_numbers.special_number_categories.index', compact('special_number_categories'));
    }


    public function create()
    {
        //
    }

    public function store(AdminSpecialNumberCategoryRequest $request)
    {

//        if (!$request->has('active'))
//            $request->request->add(['active' => 0]);
//        else
//            $request->request->add(['active' => 1]);
        $special_number_category = SpecialNumberCategory::create([
            'name_en' => $request->numbers,
            'name_ar' => $request->numbers,
            'main_category' => $request->main_category,
            'active' => $request->active ? 1 : 0,
        ]);
        if ($special_number_category) {
            return redirect()->route('special-number-categories.index')->with(['success' => __('message.created_successfully')]);
        } else {

            return redirect()->back()->with(['error' => __('message.something_wrong')]);
        }
    }


    public function show($id)
    {
        $show_special_number_category = SpecialNumberCategory::find($id);
        $show_special_number_category->makeVisible('name_en', 'name_ar');
        $main_category = $show_special_number_category->getRawOriginal('main_category');
        $data = compact('show_special_number_category','main_category');
        return response()->json(['status' => true, 'data' => $data]);
    }


    public function get_categories_of_main_category($main_category)
    {
        $categories = SpecialNumberCategory::where('main_category', $main_category)->get();

        $data = compact('categories');
        return response()->json(['status' => true, 'data' => $data]);
    }


    public function edit($id)
    {
        //
    }

    public function update(AdminSpecialNumberCategoryRequest $request, $id)
    {
        $special_number_category = SpecialNumberCategory::find($id);
//        if (!$request->has('active'))
//            $request->request->add(['active' => 0]);
//        else
//            $request->request->add(['active' => 1]);
        $update_special_number_category = $special_number_category->update([
            'name_en' => $request->numbers,
            'name_ar' => $request->numbers,
            'main_category' => $request->main_category,
            'active' => $request->active ? 1 : 0,
        ]);
        if ($update_special_number_category) {
            return redirect()->route('special-number-categories.index')->with(['success' => __('message.updated_successfully')]);
        } else {
            return redirect()->route('special-number-categories.index')->with(['error' => __('message.something_wrong')]);
        }
    }


    public function destroy($id)
    {
        $special_number_category = SpecialNumberCategory::find($id);
        $special_number_category->delete();
        return redirect()->route('special-number-categories.index')->with(['success' => __('message.deleted_successfully')]);

    }
}

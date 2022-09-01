<?php

namespace App\Http\Controllers\Dashboard\Organizations;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminSpecialNumberRequest;
use App\Http\Requests\SpecialNumberRequest;
use App\Models\SpecialNumber;
use App\Models\SpecialNumberCategory;
use App\Models\SpecialNumberOrganization;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SpecialNumberController extends Controller
{

    public function index()
    {
        $special_numbers = SpecialNumber::latest('id')->get();
        $special_number_categories = SpecialNumberCategory::all();
        $special_number_organizations = SpecialNumberOrganization::all();
        $users = User::all();

        return view('dashboard.organizations.special_numbers.special_number.index',
            compact('special_numbers', 'special_number_categories', 'special_number_organizations', 'users'));
    }


    public function create()
    {
        //
    }


    public function store(AdminSpecialNumberRequest $request)
    {
        //        return $request;
        if (!$request->has('availability'))
            $request->request->add(['availability' => 0]);
        else
            $request->request->add(['availability' => 1]);


        $request_data = $request->except(['_token']);

        $special_number = SpecialNumber::create($request_data);

        if ($special_number) {
            return redirect()->route('special-numbers.index')->with(['success' => __('message.created_successfully')]);
        } else {

            return redirect()->back()->with(['error' => __('message.something_wrong')]);
        }
    }


    public function show($id)
    {
        $show_special_number = SpecialNumber::with(['user', 'special_number_category'])->find($id);
        $size = $show_special_number->getRawOriginal('size');
        $transfer_type = $show_special_number->getRawOriginal('transfer_type');
        $main_category = $show_special_number->special_number_category->getRawOriginal('main_category');
        $data = compact('show_special_number','main_category','size','transfer_type');
        return response()->json(['status' => true, 'data' => $data]);
    }


    public function edit($id)
    {
        //
    }


    public function update(AdminSpecialNumberRequest $request, $id)
    {
        $special_number = SpecialNumber::find($id);
        if (!$request->has('availability'))
            $request->request->add(['availability' => 0]);
        else
            $request->request->add(['availability' => 1]);

        $request_data = $request->except(['_token']);


        $special_number->update($request_data);


        if ($special_number) {
            return redirect()->route('special-numbers.index')->with(['success' => __('message.updated_successfully')]);
        } else {

            return redirect()->back()->with(['error' => __('message.something_wrong')]);
        }
    }


    public function destroy($id)
    {
        $special_number = SpecialNumber::find($id);

        $special_number->delete();
        return redirect()->route('special-numbers.index')->with(['success' => __('message.deleted_successfully')]);
    }
}

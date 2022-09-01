<?php

namespace App\Http\Controllers\Dashboard\Organizations;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminSpecialNumberOrganizationRequest;
use App\Http\Requests\SpecialNumberOrganizationRequest;
use App\Models\Country;
use App\Models\SpecialNumberOrganization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SpecialNumberOrganizationController extends Controller
{
    public function index()
    {
        $special_number_organizations = SpecialNumberOrganization::latest('id')->get();
        $countries = Country::all();
        return view('dashboard.organizations.special_numbers.special_number_organizations.index', compact('special_number_organizations', 'countries'));
    }


    public function create()
    {
        //
    }


    public function store(AdminSpecialNumberOrganizationRequest $request)
    {
//        return $request;
        if (!$request->has('active'))
            $request->request->add(['active' => 0]);
        else
            $request->request->add(['active' => 1]);

        if (!$request->has('reservation_active'))
            $request->request->add(['reservation_active' => 0]);
        else
            $request->request->add(['reservation_active' => 1]);

        if (!$request->has('delivery_active'))
            $request->request->add(['delivery_active' => 0]);
        else
            $request->request->add(['delivery_active' => 1]);

        $request_data = $request->except(['_token', 'logo']);

        if ($request->has('logo')) {
            $image = $request->logo->store('logos');
            $request_data['logo'] = $image;
        }

        $special_number_organization = SpecialNumberOrganization::create($request_data);

        if ($special_number_organization) {
            $special_number_organization->organization_users()->create([
                'user_name' => $request->user_name,
                'email' => $request->email,
                'password' => $request->password,
            ]);
            return redirect()->route('special-number-organizations.index')->with(['success' => __('message.created_successfully')]);
        } else {

            return redirect()->back()->with(['error' => __('message.something_wrong')]);
        }
    }


    public function show($id)
    {
        $show_special_number_organization = SpecialNumberOrganization::find($id);
        $show_special_number_organization->makeVisible('name_en', 'name_ar', 'description_en', 'description_ar');
        $users = $show_special_number_organization->organization_users()->get();

        $data = compact('show_special_number_organization', 'users');
        return response()->json(['status' => true, 'data' => $data]);
    }

    public function getUser($org_id, $user_id)
    {
        $show_special_number_organization = SpecialNumberOrganization::find($org_id);
        $user = $show_special_number_organization->organization_users()->find($user_id);

        $data = compact('user');
        return response()->json(['status' => true, 'data' => $data]);
    }


    public function edit($id)
    {
        //
    }


    public function update(AdminSpecialNumberOrganizationRequest $request, $id)
    {
//        return $request;
        $special_number_organization = SpecialNumberOrganization::find($id);
        if (!$request->has('active'))
            $request->request->add(['active' => 0]);
        else
            $request->request->add(['active' => 1]);

        if (!$request->has('reservation_active'))
            $request->request->add(['reservation_active' => 0]);
        else
            $request->request->add(['reservation_active' => 1]);

        if (!$request->has('delivery_active'))
            $request->request->add(['delivery_active' => 0]);
        else
            $request->request->add(['delivery_active' => 1]);

        $request_data = $request->except(['_token', 'logo', 'user_name', 'password', 'password_confirmation']);

        if ($request->has('logo')) {
            $image_path = public_path('uploads/');

            if (File::exists($image_path . $special_number_organization->getRawOriginal('logo'))) {
                File::delete($image_path . $special_number_organization->getRawOriginal('logo'));
            }

            $image = $request->logo->store('logos');
            $request_data['logo'] = $image;
        }

        $user = $special_number_organization->organization_users()->find($request->organization_user_id);
        if ($request->user_name) {

            $user->update([
                'user_name' => $request->user_name,
            ]);
        }
        if ($request->password) {

            $user->update([
                'password' => $request->password,
            ]);
        }

        $special_number_organization->update($request_data);


        if ($special_number_organization) {
            return redirect()->route('special-number-organizations.index')->with(['success' => __('message.updated_successfully')]);
        } else {

            return redirect()->back()->with(['error' => __('message.something_wrong')]);
        }
    }


    public function destroy($id)
    {
        $special_number_organization = SpecialNumberOrganization::find($id);

        $image_path = public_path('uploads/');
        if (File::exists($image_path . $special_number_organization->getRawOriginal('logo'))) {
            File::delete($image_path . $special_number_organization->getRawOriginal('logo'));
        }
        $special_number_organization->delete();
        return redirect()->route('special-number-organizations.index')->with(['success' => __('message.deleted_successfully')]);
    }
}

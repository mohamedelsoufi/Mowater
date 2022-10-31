<?php

namespace App\Http\Controllers\Dashboard\General;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\OrganizationUserCreationRequest;
use App\Models\Admin;
use App\Models\OrganizationUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    public function index()
    {
        try {
            $users = Admin::all();

            return view('dashboard.general.users.index', compact('users'));
        }catch (\Exception $e){
            return redirect()->back()->with(['error' => __('message.something_wrong')]);
        }
    }


//    public function create()
//    {
//        //
//    }


    public function store(AdminRequest $request)
    {
        try {

//            if (!$request->has('active'))
//                $request->request->add(['active' => 0]);
//            else
//                $request->request->add(['active' => 1]);

            $request_data = $request->except(['_token']);

            Admin::create($request_data);

            return redirect()->route('users.index')->with(['success' => __('message.created_successfully')]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => __('message.something_wrong')]);
        }
    }


    public function show($id)
    {
        $show_user = Admin::find($id);

        $data = compact('show_user');
        return response()->json(['status' => true, 'data' => $data]);
    }

    public function edit($id)
    {
        //
    }


    public function update(AdminRequest $request, $id)
    {

        try {
            $show_user = Admin::find($id);
//            if (!$request->has('active'))
//                $request->request->add(['active' => 0]);
//            else
//                $request->request->add(['active' => 1]);

            $request_data = $request->except(['_token', 'password', 'password_confirmation']);

            if ($request->has('password')) {
                $request_data['password'] = $request->password;
            }
            $show_user->update($request_data);

            return redirect()->route('users.index')->with(['success' => __('message.updated_successfully')]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => __('message.something_wrong').$e->getMessage()]);
        }
    }


    public function destroy($id)
    {
        try {
            $admin_user = Admin::find($id);
            $user = auth::guard('admin')->id();
            if ($user == $admin_user->id) {
                return redirect()->back()->with('error', __('message.active_session'));
            }$admin_user->delete();
            return redirect()->route('users.index')->with(['success' => __('message.updated_successfully')]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => __('message.something_wrong')]);
        }

    }

}

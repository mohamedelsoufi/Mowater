<?php

namespace App\Http\Controllers\Dashboard\Location;

use App\Http\Controllers\Controller;
use App\Http\Requests\AreaRequest;
use App\Models\Area;
use App\Models\City;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function index()
    {
        $areas = Area::all();
        $cities = City::all();
        return view('dashboard.location.areas.index', compact('areas','cities'));
    }


    public function create()
    {
        //
    }

    public function store(AreaRequest $request)
    {

        $area = Area::create($request->except(['_token']));
        if ($area) {
            return redirect()->route('areas.index')->with(['success'=>__('message.created_successfully')]);
        } else {

            return redirect()->back()->with(['error'=>__('message.something_wrong')]);
        }
    }


    public function show($id)
    {
        $show_area = Area::find($id);
        $show_area->makeVisible('name_en', 'name_ar');
//        $show_area->makeHidden('name');
        $cities = City::all();
        $data = compact('show_area','cities');
        return response()->json(['status' => true, 'data'=>$data]);
    }


    public function edit($id)
    {
        //
    }

    public function update(AreaRequest $request, $id)
    {
        $area = Area::find($id);
        $update_area = $area->update($request->except(['_token']));
        if ($update_area)
        {
            return redirect()->route('areas.index')->with(['success'=>__('message.updated_successfully')]);
        }else{
            return redirect()->route('areas.index')->with(['error'=> __('message.something_wrong')]);
        }
    }


    public function destroy($id)
    {
        $area = Area::find($id);
        $area->delete();
        return redirect()->route('areas.index')->with(['success'=> __('message.deleted_successfully')]);

    }

    public function get_areas_of_city($id){
        $areas = Area::where('city_id',$id)->get();
        $data = compact('areas');
        return response()->json(['status' => true, 'data'=>$data]);
    }
}

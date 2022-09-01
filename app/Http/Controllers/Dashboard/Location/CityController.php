<?php

namespace App\Http\Controllers\Dashboard\Location;

use App\Http\Controllers\Controller;
use App\Http\Requests\CityRequest;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::all();
        $countries = Country::all();
        return view('dashboard.location.cities.index', compact('cities','countries'));
    }


    public function create()
    {
        //
    }

    public function store(CityRequest $request)
    {

        $city = City::create($request->except(['_token']));
        if ($city) {
            return redirect()->route('cities.index')->with(['success'=>__('message.created_successfully')]);
        } else {

            return redirect()->back()->with(['error'=>__('message.something_wrong')]);
        }
    }


    public function show($id)
    {
        $show_city = City::find($id);
        $show_city->makeVisible('name_en', 'name_ar');
//        $show_city->makeHidden('name');
        $countries = Country::all();
        $data = compact('show_city','countries');
        return response()->json(['status' => true, 'data'=>$data]);
    }


    public function edit($id)
    {
        //
    }

    public function update(CityRequest $request, $id)
    {
        $city = City::find($id);
        $update_city = $city->update($request->except(['_token']));
        if ($update_city)
        {
            return redirect()->route('cities.index')->with(['success'=>__('message.updated_successfully')]);
        }else{
            return redirect()->route('cities.index')->with(['error'=> __('message.something_wrong')]);
        }
    }


    public function destroy($id)
    {
        $city = City::find($id);
        $city->delete();
        return redirect()->route('cities.index')->with(['success'=> __('message.deleted_successfully')]);

    }

    public function get_cities_of_country($id){
        $cities = City::where('country_id',$id)->get();
        $data = compact('cities');
        return response()->json(['status' => true, 'data'=>$data]);
    }
}

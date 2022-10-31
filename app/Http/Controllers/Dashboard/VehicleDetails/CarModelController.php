<?php

namespace App\Http\Controllers\Dashboard\VehicleDetails;

use App\Http\Controllers\Controller;
use App\Http\Requests\CarModelRequest;
use App\Models\Brand;
use App\Models\CarModel;
use Illuminate\Http\Request;

class CarModelController extends Controller
{
    public function index()
    {
        $car_models = CarModel::all();
        $brands = Brand::all();
        return view('dashboard.vehicle_details.car_models.index', compact('car_models','brands'));
    }


    public function create()
    {
       //
    }

    public function store(CarModelRequest $request)
    {

        if (!$request->has('active'))
            $request->request->add(['active' => 0]);
        else
            $request->request->add(['active' => 1]);
        $car_model = CarModel::create($request->except(['_token']));
        if ($car_model) {
            return redirect()->route('car-models.index')->with(['success'=>__('message.created_successfully')]);
        } else {

            return redirect()->back()->with(['error'=>__('message.something_wrong')]);
        }
    }


    public function show($id)
    {
        $show_car_models = CarModel::find($id);
        $show_car_models->makeVisible('name_en', 'name_ar');
//        $show_car_models->makeHidden('name');
        $brands = Brand::all();
        $data = compact('show_car_models','brands');
        return response()->json(['status' => true, 'data'=>$data]);
    }


    public function edit($id)
    {
        //
    }

    public function update(CarModelRequest $request, $id)
    {
        $car_model = CarModel::find($id);
        if (!$request->has('active'))
            $request->request->add(['active' => 0]);
        else
            $request->request->add(['active' => 1]);
        $update_car_model = $car_model->update($request->except(['_token']));
        if ($update_car_model)
        {
            return redirect()->route('car-models.index')->with(['success'=>__('message.updated_successfully')]);
        }else{
            return redirect()->route('car-models.index')->with(['error'=> __('message.something_wrong')]);
        }
    }


    public function destroy($id)
    {
        $car_model = CarModel::find($id);
        $car_model->delete();
        return redirect()->route('car-models.index')->with(['success'=> __('message.deleted_successfully')]);

    }

    public function get_models_of_brand($id){
        $car_models = CarModel::where('brand_id',$id)->get();
        $data = compact('car_models');
        return response()->json(['status' => true, 'data'=>$data]);
    }
}

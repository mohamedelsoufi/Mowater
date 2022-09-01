<?php

namespace App\Http\Controllers\Dashboard\VehicleDetails;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainVehicleRequest;
use App\Models\Brand;
use App\Models\CarClass;
use App\Models\CarModel;
use App\Models\MainVehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class MainVehicleController extends Controller
{

    public function index()
    {
        $main_vehicles = MainVehicle::all();
        $brands = Brand::all();
        $car_classes = CarClass::all();
        $car_models = CarModel::all();
        return view('dashboard.vehicle_details.main_vehicles.index',compact('main_vehicles','brands','car_models','car_classes'));
    }


    public function create()
    {
        //
    }


    public function store(MainVehicleRequest $request)
    {
        if (!$request->has('active'))
            $request->request->add(['active' => 0]);
        else
            $request->request->add(['active' => 1]);

        $main_vehicle = MainVehicle::create($request->except(['_token']));
        if ($main_vehicle)
        {
            return redirect()->route('main-vehicles.index')->with(['success'=>__('message.created_successfully')]);
        }else{
            return redirect()->route('main-vehicles.index')->with(['error'=> __('message.something_wrong')]);
        }
    }


    public function show($id)
    {
        $show_main_vehicle = MainVehicle::with('brand','car_model','car_class')->find($id);

        $data = compact('show_main_vehicle');

        return response()->json(['status' => true, 'data'=>$data]);
    }


    public function edit($id)
    {
        //
    }


    public function update(MainVehicleRequest $request, $id)
    {

        $main_vehicle = MainVehicle::find($id);
        if (!$request->has('active'))
            $request->request->add(['active' => 0]);
        else
            $request->request->add(['active' => 1]);

        $update_main_vehicle = $main_vehicle->update($request->except(['_token']));
        if ($update_main_vehicle)
        {
            return redirect()->route('main-vehicles.index')->with(['success'=>__('message.updated_successfully')]);
        }else{
            return redirect()->route('main-vehicles.index')->with(['error'=> __('message.something_wrong')]);
        }

    }


    public function destroy($id)
    {
        $main_vehicle = MainVehicle::find($id);
        $main_vehicle->delete();
        return redirect()->route('main-vehicles.index')->with(['success'=> __('message.deleted_successfully')]);

    }
}

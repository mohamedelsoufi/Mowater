<?php

namespace App\Http\Controllers\Dashboard\VehicleDetails;

use App\Http\Controllers\Controller;
use App\Http\Requests\CarClassRequest;
use App\Models\CarClass;
use Illuminate\Http\Request;

class CarClassController extends Controller
{
    public function index()
    {
        $car_classes = CarClass::all();
        return view('dashboard.vehicle_details.car_classes.index', compact('car_classes'));
    }


    public function create()
    {
        //
    }

    public function store(CarClassRequest $request)
    {

        if (!$request->has('active'))
            $request->request->add(['active' => 0]);
        else
            $request->request->add(['active' => 1]);
        $car_class = CarClass::create($request->except(['_token']));
        if ($car_class) {
            return redirect()->route('car-classes.index')->with(['success'=>__('message.created_successfully')]);
        } else {

            return redirect()->back()->with(['error'=>__('message.something_wrong')]);
        }
    }


    public function show($id)
    {
        $show_car_class = CarClass::find($id);
        $show_car_class->makeVisible('name_en', 'name_ar');
        $data = compact('show_car_class');
        return response()->json(['status' => true, 'data'=>$data]);
    }


    public function edit($id)
    {
        //
    }

    public function update(CarClassRequest $request, $id)
    {
        $car_class = CarClass::find($id);
        if (!$request->has('active'))
            $request->request->add(['active' => 0]);
        else
            $request->request->add(['active' => 1]);
        $update_car_class = $car_class->update($request->except(['_token']));
        if ($update_car_class)
        {
            return redirect()->route('car-classes.index')->with(['success'=>__('message.updated_successfully')]);
        }else{
            return redirect()->route('car-classes.index')->with(['error'=> __('message.something_wrong')]);
        }
    }


    public function destroy($id)
    {
        $car_class = CarClass::find($id);
        $car_class->delete();
        return redirect()->route('car-classes.index')->with(['success'=> __('message.deleted_successfully')]);

    }
}

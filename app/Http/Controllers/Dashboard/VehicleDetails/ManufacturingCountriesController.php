<?php

namespace App\Http\Controllers\Dashboard\VehicleDetails;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManufactureCountryRequest;
use App\Models\ManufactureCountry;
use Illuminate\Http\Request;

class ManufacturingCountriesController extends Controller
{

    public function index()
    {
        $manufacture_countries = ManufactureCountry::all();
        return view('dashboard.vehicle_details.manufacture_countries.index', compact('manufacture_countries'));
    }


    public function create()
    {
        //
    }

    public function store(ManufactureCountryRequest $request)
    {

        if (!$request->has('active'))
            $request->request->add(['active' => 0]);
        else
            $request->request->add(['active' => 1]);
        $manufacture_country = ManufactureCountry::create($request->except(['_token']));
        if ($manufacture_country) {
            return redirect()->route('manufacture-countries.index')->with(['success'=>__('message.created_successfully')]);
        } else {

            return redirect()->back()->with(['error'=>__('message.something_wrong')]);
        }
    }


    public function show($id)
    {
        $show_manufacture_country = ManufactureCountry::find($id);
        $show_manufacture_country->makeVisible('name_en', 'name_ar');
        $data = compact('show_manufacture_country');
        return response()->json(['status' => true, 'data'=>$data]);
    }


    public function edit($id)
    {
        //
    }

    public function update(ManufactureCountryRequest $request, $id)
    {
        $manufacture_country = ManufactureCountry::find($id);
        if (!$request->has('active'))
            $request->request->add(['active' => 0]);
        else
            $request->request->add(['active' => 1]);
        $update_manufacture_country = $manufacture_country->update($request->except(['_token']));
        if ($update_manufacture_country)
        {
            return redirect()->route('manufacture-countries.index')->with(['success'=>__('message.updated_successfully')]);
        }else{
            return redirect()->route('manufacture-countries.index')->with(['error'=> __('message.something_wrong')]);
        }
    }


    public function destroy($id)
    {
        $manufacture_country = ManufactureCountry::find($id);
        $manufacture_country->delete();
        return redirect()->route('manufacture-countries.index')->with(['success'=> __('message.deleted_successfully')]);

    }
}

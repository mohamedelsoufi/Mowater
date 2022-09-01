<?php

namespace App\Http\Controllers\Dashboard\VehicleDetails;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\ManufactureCountry;
use Illuminate\Http\Request;
use App\Models\Brand;

class BrandsController extends Controller
{

    public function index()
    {
        $brands = Brand::all();
        $countries = ManufactureCountry::all();
        return view('dashboard.vehicle_details.brands.index', compact('brands','countries'));
    }


    public function create()
    {
        //
    }

    public function store(BrandRequest $request)
    {

        if (!$request->has('active'))
            $request->request->add(['active' => 0]);
        else
            $request->request->add(['active' => 1]);
        $brand = Brand::create($request->except(['_token']));
        if ($brand) {
           return redirect()->route('brands.index')->with(['success'=>__('message.created_successfully')]);
        } else {

            return redirect()->back()->with(['error'=>__('message.something_wrong')]);
        }
    }


    public function show($id)
    {
        $show_brand = Brand::find($id);
        $show_brand->makeVisible('name_en', 'name_ar');
//        $show_brand->makeHidden('name');
        $manufacture_countries = ManufactureCountry::all();
        $data = compact('show_brand','manufacture_countries');
        return response()->json(['status' => true, 'data'=>$data]);
    }


    public function edit($id)
    {
        //
    }

    public function update(BrandRequest $request, $id)
    {
        $brand = Brand::find($id);
        if (!$request->has('active'))
            $request->request->add(['active' => 0]);
        else
            $request->request->add(['active' => 1]);
        $update_brand = $brand->update($request->except(['_token']));
        if ($update_brand)
        {
            return redirect()->route('brands.index')->with(['success'=>__('message.updated_successfully')]);
        }else{
            return redirect()->route('brands.index')->with(['error'=> __('message.something_wrong')]);
        }
    }


    public function destroy($id)
    {
        $brand = Brand::find($id);
        $brand->delete();
        return redirect()->route('brands.index')->with(['success'=> __('message.deleted_successfully')]);

    }
}

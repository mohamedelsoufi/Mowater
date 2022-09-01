<?php

namespace App\Http\Controllers\Dashboard\Location;

use App\Http\Controllers\Controller;
use App\Http\Requests\CountryRequest;
use App\Models\Country;
use App\Models\Currency;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        $currencies = Currency::all();
        return view('dashboard.location.countries.index', compact('countries','currencies'));
    }


    public function create()
    {
        //
    }

    public function store(CountryRequest $request)
    {
//        return $request;
        $country = Country::create($request->except(['_token']));
        $image = $country->refresh();
        $image->uploadImage();

        if ($country) {
            return redirect()->route('countries.index')->with(['success'=>__('message.created_successfully')]);
        } else {

            return redirect()->back()->with(['error'=>__('message.something_wrong')]);
        }
    }


    public function show($id)
    {
        $show_country = Country::find($id);
        $show_country->makeVisible('name_en', 'name_ar');
        $data = compact('show_country');
        return response()->json(['status' => true, 'data'=>$data]);
    }


    public function edit($id)
    {
        //
    }

    public function update(CountryRequest $request, $id)
    {
        $country = Country::find($id);

        $update_country = $country->update($request->except(['_token']));
        $country->updateImage();
        if ($update_country)
        {
            return redirect()->route('countries.index')->with(['success'=>__('message.updated_successfully')]);
        }else{
            return redirect()->route('countries.index')->with(['error'=> __('message.something_wrong')]);
        }
    }


    public function destroy($id)
    {
        $country = Country::find($id);
        $country->deleteImage();
        $country->delete();
        return redirect()->route('countries.index')->with(['success'=> __('message.deleted_successfully')]);

    }
}

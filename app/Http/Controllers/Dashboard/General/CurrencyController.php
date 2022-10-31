<?php

namespace App\Http\Controllers\Dashboard\General;

use App\Http\Controllers\Controller;
use App\Http\Requests\CurrencyRequest;
use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{

    public function index()
    {
        $currencies = Currency::all();
        return view('dashboard.general.currencies.index', compact('currencies'));
    }


    public function create()
    {
        //
    }

    public function store(CurrencyRequest $request)
    {
        $currency = Currency::create($request->except(['_token']));
        if ($currency) {
            return redirect()->route('currencies.index')->with(['success'=>__('message.created_successfully')]);
        } else {

            return redirect()->back()->with(['error'=>__('message.something_wrong')]);
        }
    }


    public function show($id)
    {
        $show_currency = Currency::find($id);
        $show_currency->makeVisible('name_en','name_ar');
        $data = compact('show_currency');
        return response()->json(['status' => true, 'data'=>$data]);
    }


    public function edit($id)
    {
        //
    }

    public function update(CurrencyRequest $request, $id)
    {
        $currency = Currency::find($id);

        $update_currency = $currency->update($request->except(['_token']));
        if ($update_currency)
        {
            return redirect()->route('currencies.index')->with(['success'=>__('message.updated_successfully')]);
        }else{
            return redirect()->route('currencies.index')->with(['error'=> __('message.something_wrong')]);
        }
    }


    public function destroy($id)
    {
        $currency = Currency::find($id);
        $currency->delete();
        return redirect()->route('currencies.index')->with(['success'=> __('message.deleted_successfully')]);

    }
}

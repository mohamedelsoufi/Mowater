<?php

namespace App\Http\Controllers\Dashboard\General;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentMethodRequest;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    public function index()
    {
        $payment_methods = PaymentMethod::all();
        return view('dashboard.general.payment_methods.index', compact('payment_methods'));
    }


    public function create()
    {
        //
    }

    public function store(PaymentMethodRequest $request)
    {
        $payment_method = PaymentMethod::create($request->except(['_token']));
        if ($payment_method) {
            return redirect()->route('payment-methods.index')->with(['success'=>__('message.created_successfully')]);
        } else {

            return redirect()->back()->with(['error'=>__('message.something_wrong')]);
        }
    }


    public function show($id)
    {
        $show_payment_method = PaymentMethod::find($id);
        $show_payment_method->makeVisible('name_en', 'name_ar');
        $data = compact('show_payment_method');
        return response()->json(['status' => true, 'data'=>$data]);
    }


    public function edit($id)
    {
        //
    }

    public function update(PaymentMethodRequest $request, $id)
    {
        $payment_method = PaymentMethod::find($id);

        $update_payment_method = $payment_method->update($request->except(['_token']));
        if ($update_payment_method)
        {
            return redirect()->route('payment-methods.index')->with(['success'=>__('message.updated_successfully')]);
        }else{
            return redirect()->route('payment-methods.index')->with(['error'=> __('message.something_wrong')]);
        }
    }


    public function destroy($id)
    {
        $payment_method = PaymentMethod::find($id);
        $payment_method->delete();
        return redirect()->route('payment-methods.index')->with(['success'=> __('message.deleted_successfully')]);

    }
}

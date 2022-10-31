<?php

namespace App\Http\Controllers\Dashboard\General;

use App\Http\Controllers\Controller;
use App\Http\Requests\DiscountCardRequest;
use App\Models\DiscountCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DiscountCardController extends Controller
{
    public function index()
    {
        $discount_cards = DiscountCard::all();
        return view('dashboard.general.discount_cards.index', compact('discount_cards'));
    }


    public function create()
    {
        //
    }

    public function store(DiscountCardRequest $request)
    {

        if (!$request->has('active'))
            $request->request->add(['active' => 0]);
        else
            $request->request->add(['active' => 1]);

        $request_data = $request->except(['_token', 'image']);

        if ($request->has('image')) {
            $image = $request->image->store('discount_cards');
            $request_data['image'] = $image;
        }

        $discount_card = DiscountCard::create($request_data);
        if ($discount_card) {
            return redirect()->route('discount-cards.index')->with(['success' => __('message.created_successfully')]);
        } else {

            return redirect()->back()->with(['error' => __('message.something_wrong')]);
        }
    }


    public function show($id)
    {
        $show_discount_card = DiscountCard::find($id);
        $show_discount_card->makeVisible(['title_en', 'title_ar', 'description_en', 'description_ar']);
        $data = compact('show_discount_card');
        return response()->json(['status' => true, 'data' => $data]);
    }


    public function edit($id)
    {
        //
    }

    public function update(DiscountCardRequest $request, $id)
    {
        $discount_card = DiscountCard::find($id);

        if (!$request->has('active'))
            $request->request->add(['active' => 0]);
        else
            $request->request->add(['active' => 1]);

        $request_data = $request->except(['_token', 'image']);

        if ($request->has('image')) {
            $image_path = public_path('uploads/');

            if (File::exists($image_path . $discount_card->getRawOriginal('image'))) {
                File::delete($image_path . $discount_card->getRawOriginal('image'));
            }

            $image = $request->image->store('discount_cards');
            $request_data['image'] = $image;
        }



        $update_discount_card = $discount_card->update($request_data);
        if ($update_discount_card) {
            return redirect()->route('discount-cards.index')->with(['success' => __('message.updated_successfully')]);
        } else {
            return redirect()->route('discount-cards.index')->with(['error' => __('message.something_wrong')]);
        }
    }


    public function destroy($id)
    {
        $discount_card = DiscountCard::find($id);
        $image_path = public_path('uploads/');
        if (File::exists($image_path . $discount_card->getRawOriginal('image'))) {
            File::delete($image_path . $discount_card->getRawOriginal('image'));
        }
        $discount_card->delete();
        return redirect()->route('discount-cards.index')->with(['success' => __('message.deleted_successfully')]);

    }
}

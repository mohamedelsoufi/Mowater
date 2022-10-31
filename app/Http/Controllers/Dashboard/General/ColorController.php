<?php

namespace App\Http\Controllers\Dashboard\General;

use App\Http\Controllers\Controller;
use App\Http\Requests\ColorRequest;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        $colors = Color::all();
        return view('dashboard.general.colors.index', compact('colors'));
    }


    public function create()
    {
        //
    }

    public function store(ColorRequest $request)
    {
        $color = Color::create($request->except(['_token']));
        if ($color) {
            return redirect()->route('colors.index')->with(['success'=>__('message.created_successfully')]);
        } else {

            return redirect()->back()->with(['error'=>__('message.something_wrong')]);
        }
    }


    public function show($id)
    {
        $show_color = Color::find($id);
        $show_color->makeVisible('color_name','color_name_ar');
        $data = compact('show_color');
        return response()->json(['status' => true, 'data'=>$data]);
    }


    public function edit($id)
    {
        //
    }

    public function update(ColorRequest $request, $id)
    {
        $color = Color::find($id);

        $update_color = $color->update($request->except(['_token']));
        if ($update_color)
        {
            return redirect()->route('colors.index')->with(['success'=>__('message.updated_successfully')]);
        }else{
            return redirect()->route('colors.index')->with(['error'=> __('message.something_wrong')]);
        }
    }


    public function destroy($id)
    {
        $color = Color::find($id);
        $color->delete();
        return redirect()->route('colors.index')->with(['success'=> __('message.deleted_successfully')]);

    }
}

<?php

namespace App\Http\Controllers\Dashboard\General;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Models\Section;
use App\Models\Slider;
use Illuminate\Http\Request;

class AppSliderController extends Controller
{
    public function index()
    {
        $app_sliders = Slider::where('type','!=','section')->with('files')->get();
        $sections = Section::all();
        return view('dashboard.general.app_sliders.index', compact('app_sliders', 'sections'));
    }


    public function show($id)
    {
        $app_slider = Slider::with('files')->find($id);
        $sections = Section::all();
        return view('dashboard.general.app_sliders.show', compact('app_slider', 'sections'));
    }

    public function update(SliderRequest $request, $id)
    {
        $slider = Slider::with('files')->find($id);

        $deleted_files = $request->has('deleted_images') ? $request->deleted_images : [];
        $updated_files = $request->has('slider_file') ? $request->slider_file : [];

        $count_deleted = count($deleted_files);
        $counter_updated = count($updated_files);
        $count_sliders = $slider->files->count();

        $total = ($counter_updated + $count_sliders ) - $count_deleted;


        if ($total > 6) {
            return redirect()->back()->with(['error' => __('message.something_wrong')]);

        } else {
            $slider->updateImage();
            return redirect()->back()->with(['success' => __('message.updated_successfully')]);
        }

    }

}

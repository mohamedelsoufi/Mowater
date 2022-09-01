<?php

namespace App\Http\Controllers\Dashboard\General;

use App\Http\Controllers\Controller;
use App\Http\Requests\SectionRequest;
use App\Models\DrivingTrainer;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::where('section_id', null)->get();
        $sub_sections = Section::where('section_id', '!=', null)->get();

        return view('dashboard.general.sections.index', compact('sections', 'sub_sections'));
    }


    public function create()
    {

    }

    public function store(SectionRequest $request)
    {

    }


    public function show($id)
    {
        $show_section = Section::find($id);
        $show_section->makeVisible('name_en', 'name_ar', 'reservation_cost_type', 'reservation_cost');
        $data = compact('show_section');
        return response()->json(['status' => true, 'data' => $data]);
    }


    public function edit($id)
    {
        //
    }

    public function update(SectionRequest $request, $id)
    {
        $section = Section::find($id);
        if ($section['ref_name'] == "DrivingTrainer") {
            foreach (DrivingTrainer::all() as $trainer) {
                $trainer->update(['hour_price' => $request->reservation_cost]);
            }
        }
        $update_section = $section->update($request->except(['_token', 'ref_name']));

        //$section = Section::find($id);
        $section->updateImage();
        if ($update_section) {
            return redirect()->route('sections.index')->with(['success' => __('message.updated_successfully')]);
        } else {
            return redirect()->route('sections.index')->with(['error' => __('message.something_wrong')]);
        }
    }


    public function destroy($id)
    {
        $section = Section::find($id);
        $section->delete();
        return redirect()->route('sections.index')->with(['success' => __('message.deleted_successfully')]);

    }
}

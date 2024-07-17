<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\WorkingHour;

class WorkingHourController extends Controller
{
    public function index() {
        $perPage = 10;
        $data['hours'] = WorkingHour::paginate($perPage);
        return view('working-hour.index', $data);

    }

    public function create() {
        return view('working-hour.create');
    } 

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'working_code' => 'required',
            'working_name' => 'required',
            'early_entry' => 'required',
            'entry_time' => 'required',
            'end_entry' => 'required',
            'home_time' => 'required'
        ]);

        if($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $work = WorkingHour::create($request->all());

        return redirect()->route('workingHour')->with('success', 'Working hour saved successfully!');
    }

    public function edit($id) {
        $data['works'] = WorkingHour::find($id);
        return view('working-hour.edit', $data);
    }

    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'working_code' => 'nullable|max:4',
            'working_name' => 'nullable',
            'early_entry' => 'nullable',
            'entry_time' => 'nullable',
            'end_entry' => 'nullable',
            'home_time' => 'nullable'
        ]);

        if($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $workingHour = WorkingHour::find($id);

        if (!$workingHour) {
            return redirect()->back()->with('error', 'Record not found.');
        }

        $workingHour->update($validator->validated());

        return redirect()->route('workingHour')->with('success', 'Working hour updated successfully!'); 
    }

    public function delete($id) {
        $work = workingHour::find($id);
        if (!$work) {
            return redirect()->back()->with('error', 'Working Hour not found.');
        }

        $work->delete();
        return redirect()->back()->with('success', 'Working hour deleted successfully.');
    }
}


<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OfficeLocation;
use Illuminate\Support\Facades\Validator;

class OfficeLocationController extends Controller
{
    public function index() {
        $perPage = 10;
        $data['offices'] = OfficeLocation::paginate($perPage);
        return view('office.index', $data);
    }

    public function store(Request $request) {
        $data = [
            'location' => $request->location,
            'radius' => $request->radius
        ];

        $office = OfficeLocation::create($data);
        return redirect()->back()->with('success', 'Data Added Succesfully');
    }

    public function edit($id) {
        $data['offices'] = OfficeLocation::find($id);
        return view('office.edit',$data);
    }

    public function update(Request $request, $id){
    
        $validator = Validator::make($request->all(), [
            'location' => 'nullable',
            'radius' => 'nullable'
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $officeLocation = OfficeLocation::find($id);

        if (!$officeLocation) {
            return redirect()->back()->with('error', 'Data not found');
        }
    
        // Update data
        $officeLocation->location = $request->input('location');
        $officeLocation->radius = $request->input('radius');
        $officeLocation->save();
    
        return redirect()->route('office')->with('success', 'Office location updated successfully');
    }

    public function delete($id) {
        $office = OfficeLocation::find($id);
        if (!$office) {
            return redirect()->back()->with('error', 'Office data not found.');
        }
    
        $office->delete();
        
        return redirect()->back()->with('success', 'Office location data deleted successfully.');
    }
}

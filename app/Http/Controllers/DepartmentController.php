<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Department;

class DepartmentController extends Controller
{
    public function index() {
        $perPage = 10;
        $data['departments'] = Department::paginate($perPage);
        return view('department.index', $data);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'code' => 'required|max:4',
            'name' => 'required'
        ]);

        if($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }
        $data = [
            'code' => $request->code,
            'name' => $request->name
        ];

        $department = Department::create($data);
        return redirect()->back()->with('success', 'Data Berhasil Disimpan');
    }

    public function update(Request $request){
        $validatedData = $request->validate([
            'id' => 'required|integer|exists:departments,id',
            'code' => 'required|string|max:3',
            'name' => 'required|string|max:255',
        ]);

        $department = Department::findOrFail($validatedData['id']);
        $department->update([
            'code' => $validatedData['code'],
            'name' => $validatedData['name'],
        ]);

        return redirect()->back()->with('success', 'Department updated successfully');
    }

    public function delete($id) {
        $department = Department::find($id);
        if (!$department) {
            return redirect()->back()->with('error', 'Department not found.');
        }
    
        $department->delete();
        
        return redirect()->back()->with('success', 'Department deleted successfully.');
    }
}

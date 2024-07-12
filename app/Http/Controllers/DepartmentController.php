<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function index() {
        $perPage = 10;
        $data['departments'] = Department::paginate($perPage);
        return view('department.index', $data);
    }

    public function store(Request $request) {
        $data = [
            'code' => $request->code,
            'name' => $request->name
        ];

        $department = Department::create($data);
        return redirect()->back();
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

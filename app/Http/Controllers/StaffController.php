<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\Department;

class StaffController extends Controller
{
    public function index() {
        $perPage = 10;
        
        $data['departments'] = Department::all();
        $data['staffs'] = Staff::with('department')->paginate($perPage); 
        return view('staff.index', $data);
    }

    public function store(Request $request) {
        $data = [
            'name' => $request->name,
            'phone' => $request->phone,
            'position' => $request->position,
            'id_department' => $request->department
        ];

        $staff = Staff::Create($data);
        return redirect()->back()->with('success', 'Data Berhasil Disimpan!');
    }

    public function update(Request $request){
        $validatedData = $request->validate([
            'id' => 'required|integer|exists:staff,id',
            'name' => 'required|string',
            'phone' => 'required|string',
            'position' => 'required|string',
            'department' => 'required|integer|exists:departments,id'
        ]);
    
        $department = Staff::findOrFail($validatedData['id']);
        $department->update([
            'name' => $validatedData['name'],
            'phone' => $validatedData['phone'],
            'position' => $validatedData['position'],
            'id_department' => $validatedData['department']
        ]);

        return redirect()->back()->with('success', 'Staff updated successfully');
    }

    public function delete($id) {
        $staff = Staff::find($id);
        if (!$staff) {
            return redirect()->back()->with('error', 'Staff not found.');
        }
    
        $staff->delete();
        
        return redirect()->back()->with('success', 'Staff deleted successfully.');
    }
}

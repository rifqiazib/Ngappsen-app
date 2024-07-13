<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Leave;

class LeaveController extends Controller
{
    public function index() {
        $perPage = 10;
        $data['leaves'] = Leave::with(['user', 'user.staff', 'user.staff.department'])->paginate($perPage);

        return view('leave.index', $data);
    }

    public function create() {
        $id_user = Auth::user()->id;
        $data['leaves'] = Leave::where('id_user', $id_user)->get();
        return view('leave.create', $data);
    }

    public function store(Request $request) {
        $data = [
            'id_user' => Auth::user()->id,
            'date_start' => $request->date_start,
            'date_end' => $request->date_end,
            'explanation' => $request->explanation,
            'status' => $request->status
        ];

        $leave = Leave::create($data);
        return view('dashboard.index');
    }

    public function approval(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer|exists:leaves,id',
            'status_approved' => 'required|in:0,1,2', 
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $validatedData = $validator->validated();

        $leave = Leave::findOrFail($validatedData['id']);
        
        $leave->update([
            'status_approved' => $validatedData['status_approved'],
        ]);
    
        return redirect()->back()->with('success', 'Status updated successfully');
    
    }
}

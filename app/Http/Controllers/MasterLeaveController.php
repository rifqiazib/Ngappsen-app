<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\MasterLeave;

class MasterLeaveController extends Controller
{
    public function index() {
        $perPage = 10;
        $data['masterLeaves'] = MasterLeave::paginate(10);
        return view('master-leave.index', $data);
    }

    public function create() {
        return view('master-leave.create');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'code' => 'required|max:4',
            'name' => 'required',
            'days' => 'required' 
        ]);

        if($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $data = [
            'code' => $request->code,
            'name'=> $request->name,
            'days' => $request->days
        ];
        try {
            $masterLeave = MasterLeave::create($data);
            return redirect()->route('masterLeave')->with('success', 'Data Berhasil Disimpan');
        } catch (\Throwable $th) {
            return redirect()->route('masterLeave')->with('errors', 'Data Gagal Disimpan');
        }
    }

    public function edit($id) {
        $data['leave'] = MasterLeave::find($id);
        return view('master-leave.edit', $data);
    }

    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'code' => 'required|max:4',
            'name' => 'required',
            'days' => 'required'
        ]);

        if($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $leave = MasterLeave::find($id);

        if(!$leave) {
            return redirect()->back()->withInput()->withErrors('errors', 'Data Not Found');
        }

        $data = [
            'code' => $request->code,
            'name' => $request->name,
            'days' => $request->days
        ];
        try {
            //code...
            $leave->update($data);
            return redirect()->route('masterLeave')->with('success', 'Data updated successfully');
        } catch (\Throwable $th) {
            return "gagal";
        }
    }

    public function delete($id) {
        $leave = MasterLeave::find($id);
        
        if(!$leave) {
            return redirec()->back()->with('errors', 'Data not found');
        }

        try {
            $leave->delete();
            return redirect()->back()->with('success', 'Data deleted succesfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('errors', 'Failed to delete data');
        }
    }
}

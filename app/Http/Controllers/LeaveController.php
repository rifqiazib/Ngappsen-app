<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Leave;

class LeaveController extends Controller
{
    public function index() {
        $id_user = Auth::user()->id;
        $data['leaves'] = Leave::where('id_user', $id_user)->get();
        return view('leave.index', $data);
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
}

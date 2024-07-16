<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Attedance;
use App\Models\Leave;

class HistoryController extends Controller
{
    public function index() {
        $id_user = Auth::user()->id;
        $data['attedances'] = Attedance::where('id_user', $id_user)->get();
        $data['leaves'] = Leave::where('id_user', $id_user)->get();
        return view('history.index', $data);
    }
}

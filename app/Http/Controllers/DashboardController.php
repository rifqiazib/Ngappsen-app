<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index() {
        $date = date("Y-m-d");
        $user = Auth::user()->id;
        $attedance = DB::table('attedances')->where('id_user', $user)->where('date', $date)->first();
        return view('dashboard.index', ['attedance' => $attedance]);
    }
}

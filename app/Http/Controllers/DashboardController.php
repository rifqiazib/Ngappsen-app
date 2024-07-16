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
        $data['attedance'] = DB::table('attedances')->where('id_user', $user)->where('date', $date)->first();

        $subQueryUser = DB::table('attedances')
        ->join('staff_working_hours', 'attedances.id_user', '=', 'staff_working_hours.id_user')
        ->join('working_hours', 'staff_working_hours.id_working_hour', '=', 'working_hours.id')
        ->where('attedances.id_user', $user)
        ->selectRaw('attedances.id_user, IF(attedances.entry_time > working_hours.end_entry, 1, 0) as is_late')
        ->groupBy('attedances.id_user', 'attedances.entry_time', 'working_hours.end_entry');

        $data['recapAttedanceUser'] = DB::table(DB::raw("({$subQueryUser->toSql()}) as sub"))
        ->mergeBindings($subQueryUser)
        ->selectRaw('
            COUNT(DISTINCT sub.id_user) as total_attedance, 
            SUM(sub.is_late) as total_late')
        ->first();

        $data['recapLeaveUser'] = DB::table('leaves')
        ->selectRaw('
        COUNT(id_user) as total_leave,
        SUM(CASE WHEN status = "i" AND status_approved = 1 THEN 1 ELSE 0 END) as total_permit,
        SUM(CASE WHEN status = "s" AND status_approved = 1 THEN 1 ELSE 0 END) as total_sick')
        ->whereDate('date_start', $date)
        ->where('id_user', $user)
        ->first(); 

        $subQuery = DB::table('attedances')
        ->join('staff_working_hours', 'attedances.id_user', '=', 'staff_working_hours.id_user')
        ->join('working_hours', 'staff_working_hours.id_working_hour', '=', 'working_hours.id')
        ->where('attedances.date', $date)
        ->selectRaw('attedances.id_user, IF(attedances.entry_time > working_hours.end_entry, 1, 0) as is_late')
        ->groupBy('attedances.id_user', 'attedances.entry_time', 'working_hours.end_entry');

        // Menghitung total kehadiran dan total keterlambatan
        $data['recapAttedance'] = DB::table(DB::raw("({$subQuery->toSql()}) as sub"))
        ->mergeBindings($subQuery)
        ->selectRaw('
            COUNT(DISTINCT sub.id_user) as total_attedance, 
            SUM(sub.is_late) as total_late
        ')
        ->first();

        $data['recapLeave'] = DB::table('leaves')
        ->selectRaw('
        COUNT(id_user) as total_leave,
        SUM(CASE WHEN status = "i" AND status_approved = 1 THEN 1 ELSE 0 END) as total_permit,
        SUM(CASE WHEN status = "s" AND status_approved = 1 THEN 1 ELSE 0 END) as total_sick')
        ->whereDate('date_start', $date)
        ->first(); 

        return view('dashboard.index', $data);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

use App\Helpers\DayHelper;
use App\Models\Attedance;
use App\Models\OfficeLocation;
use App\Models\StaffWorkingHour;

class AttedanceController extends Controller
{
    public function index(Request $request) {
        $perPage = 10;
        
        $filterStart =  $request->start ? Carbon::createFromFormat('m/d/Y', $request->start)->format('Y-m-d') : null;
        $filterEnd = $request->end ? Carbon::createFromFormat('m/d/Y', $request->end)->format('Y-m-d') : null;    
        // return $filterEnd;
        
        $data['attedances'] = Attedance::with('user')
        ->when($filterStart && $filterEnd, function ($query) use ($filterStart, $filterEnd) {
            return $query->whereBetween('date', [$filterStart, $filterEnd]);
        })->paginate($perPage);

        // return $data['attedances'];

        $data['filterStart'] = $request->start;
        $data['filterEnd'] = $request->end;
                
        return view('attedance.index', $data);
    }

    public function create() {
        $date = date("Y-m-d");
        $id_user = Auth::user()->id;
        $today = Carbon::now()->isoFormat('dddd');
        $daysId = translateDayToIndonesian($today);
        $data['workingHours'] = StaffWorkingHour::where('id_user', $id_user)->where('days', $daysId)->with('workingHour')->get();
        $data['officeLocation'] = DB::table('office_locations')->where('id', 2)->first();
        $data['check'] = DB::table('attedances')->where('date', $date)->where('id_user', $id_user)->count();
        
        return view('attedance.create', $data);
    }

    public function store (Request $request) {
       $id_user = Auth::user()->id;
       $officeLocation = DB::table('office_locations')->where('id', 2)->first();
       $office = explode(',', $officeLocation->location);

       $date = date("Y-m-d");
       $entry_time = date("H:i:s");
       $location = $request->location;
       $user_location = explode(',', $location);
       $lat_user = $user_location[0];
       $long_user = $user_location[1];
       $lat_office = $office[0];
       $long_office = $office[1];
       $distances = $this->distance($lat_office, $long_office, $lat_user, $long_user);
       $radius = round($distances["meters"]);

       $today = Carbon::now()->isoFormat('dddd');
       $currentTime = Carbon::now();
       $currentHour = $currentTime->format('H:i:s');
       $daysId = translateDayToIndonesian($today);
       $workingHours = StaffWorkingHour::where('id_user', $id_user)->where('days', $daysId)->with('workingHour')->first();
       $earlyEntryTime = $workingHours->workingHour->early_entry;
       $endEntry = $workingHours->workingHour->end_entry;
       
       $check = DB::table('attedances')->where('date', $date)->where('id_user', $id_user)->count();
       if($radius > $officeLocation->radius) {
        return "error|Maaf Anda Berada Di Luar Radius|";
       } else {
           if($check > 0) {
                $data = [
                    'home_time' => $entry_time,
                    'home_location'=> $location
                ];
                $update = DB::table('attedances')->where('date', $date)->where('id_user', $id_user)->update($data);
                if ($update) {
                    return "success|Terimakasih! Hati - Hati Di Jalan|out";
                } else {
                    return "error|Absen gagal, Silahkan hubungi tim IT|out";
                }
           } else {
            if($entry_time < $earlyEntryTime) {
                return "error|Absen gagal, Belum waktunya Absen|out";
            } elseif($entry_time > $endEntry){
                $data = [
                    'id_user' => $id_user,
                    'date' => $date,
                    'entry_time' => $entry_time,
                    'entry_location' => $location
                ];
                $save = DB::table('attedances')->insert($data);
                if ($save) {
                    return "success|Absen berhasil, Anda terlambat|out";
                } else {
                    return "error|Absen gagal, Silahkan hubungi tim IT|out";
                }   
            } else {
                $data = [
                    'id_user' => $id_user,
                    'date' => $date,
                    'entry_time' => $entry_time,
                    'entry_location' => $location
                ];
                $save = DB::table('attedances')->insert($data);
                if ($save) {
                    return "success|Terimakasih! Selamat Bekerja|in";
                } else {
                    return "error|Absen gagal, Silahkan hubungi tim IT|out";
                }   
            }
           }
       }
    }
   
    function distance($lat1, $lon1, $lat2, $lon2){
        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $feet = $miles * 5280;
        $yards = $feet / 3;
        $kilometers = $miles * 1.609344;
        $meters = $kilometers * 1000;
        return compact('meters');
    }
}

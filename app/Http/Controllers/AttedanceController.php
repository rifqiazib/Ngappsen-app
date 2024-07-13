<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Attedance;
use App\Models\OfficeLocation;

class AttedanceController extends Controller
{
    public function index() {
        $data['attedances'] = Attedance::with('user')->get();
        
        return view('attedance.index', $data);
    }

    public function create() {
        $date = date("Y-m-d");
        $id_user = Auth::user()->id;
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

    //Menghitung Jarak
   
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

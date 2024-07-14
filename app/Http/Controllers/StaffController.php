<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Models\Staff;
use App\Models\User;
use App\Models\Department;
use App\Models\WorkingHour;
use App\Models\StaffWorkingHour;




class StaffController extends Controller
{
    public function index() {
        $perPage = 10;
        
        $data['departments'] = Department::all();
        $data['staffs'] = Staff::with('department')->paginate($perPage); 
        return view('staff.index', $data);
    }

    public function create() {
        $data['departments'] = Department::all();
        return view('staff.create', $data);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'department' => 'required|integer',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Gunakan DB transaction untuk memastikan keamanan operasi database
        DB::beginTransaction();

        try {
            // Buat data User terlebih dahulu
            $userData = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ];

            $user = User::create($userData);

            // Buat data Staff dengan ID User yang baru dibuat
            $staffData = [
                'name' => $request->name,
                'phone' => $request->phone,
                'position' => $request->position,
                'id_department' => $request->department,
                'id_user' => $user->id,
            ];

            $staff = Staff::create($staffData);

            // Commit transaksi jika kedua operasi berhasil
            DB::commit();

            return redirect()->route('staff')->with('success', 'Data Berhasil Disimpan!');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();

            return redirect()->back()->with('error', 'Gagal menyimpan data. Silakan coba lagi.');
        }
    }

    public function edit($id) {
        $staff = Staff::find($id);
        $departments = Department::all();
    
        if ($staff && $staff->user) {
            $user = $staff->user;
            return view('staff.edit', compact('staff', 'departments', 'user'));
        }
    
        return redirect()->back()->with('error', 'Staff not found or user not associated.');
    }

    public function update(Request $request, $id){
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'department' => 'required|integer',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            // Unique validation checks except current ID
        ]);

        // Gunakan DB transaction untuk memastikan keamanan operasi database
        DB::beginTransaction();

        try {
            // Update data User
            $user = User::find($id);
            if (!$user) {
                throw new \Exception('User not found');
            }
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();

            // Update data Staff
            $staff = Staff::where('id_user', $id)->first();
            if (!$staff) {
                throw new \Exception('Staff not found');
            }
            $staff->name = $request->name;
            $staff->phone = $request->phone;
            $staff->position = $request->position;
            $staff->id_department = $request->department;
            $staff->save();

            // Commit transaksi jika kedua operasi berhasil
            DB::commit();

            return redirect()->back()->with('success', 'Data Berhasil Diupdate!');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();

            return redirect()->back()->with('error', 'Gagal mengupdate data. Silakan coba lagi.');
        }
    
    }

    public function delete($id){
        // Gunakan DB transaction untuk memastikan keamanan operasi database
        DB::beginTransaction();

        try {
            // Cari data staff berdasarkan id
            $staff = Staff::find($id);
            
            if (!$staff) {
                return redirect()->back()->with('error', 'Staff not found.');
            }

            // Hapus user terkait jika ada
            $user = User::find($staff->id_user);
            if ($user) {
                $user->delete();
            }

            // Hapus data staff
            $staff->delete();

            // Commit transaksi jika operasi berhasil
            DB::commit();

            return redirect()->route('staff.index')->with('success', 'Staff deleted successfully.');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();

            return redirect()->back()->with('error', 'Failed to delete staff. Please try again.');
        }
    }

    public function config($id) {
        $data['days'] = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu'];
        $data['hours'] = WorkingHour::all();
        $data['staff'] = Staff::find($id);
        $data['countHour'] = StaffWorkingHour::where('id_user', $id)->count();

        $data['staffWorkingHours'] = StaffWorkingHour::where('id_user', $id)->get();
       
        if($data['countHour'] > 0) {
            return view('staff.config-edit', $data);

        } else {
            return view('staff.config', $data);
        }
    }

    public function configStore(Request $request) {
        
        $request->validate([
            'id_user' => 'required',
            'days' => 'required|array', // days harus berupa array
            'days.*' => 'in:senin,selasa,rabu,kamis,jumat,sabtu,minggu', // setiap nilai days harus sesuai dengan hari yang diizinkan
            'id_working_hour' => 'required|array', // id_working_hour harus berupa array
            'id_working_hour.*' => 'required|exists:working_hours,id', // setiap id_working_hour harus valid sesuai dengan data working_hours
        ]);
    
        try {
            // Mulai transaksi database jika diperlukan
            DB::beginTransaction();
    
            foreach ($request->days as $index => $day) {
                $workingHourId = $request->id_working_hour[$index];
    
                // Simpan atau update data sesuai kebutuhan Anda
                // Contoh penyimpanan:
                $config = new StaffWorkingHour(); // Ganti dengan model dan tabel yang sesuai
                $config->id_user = $request->id_user;
                $config->days = $day;
                $config->id_working_hour = $workingHourId;
                $config->save();
            }
    
            // Commit transaksi jika tidak ada masalah
            DB::commit();
    
            // Redirect atau response sukses
            return redirect()->back()->with('success', 'Data konfigurasi berhasil disimpan.');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();
            dd($e->getMessage());
    
            // Redirect atau response error
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data konfigurasi.');
        }
    }

    public function configUpdate(Request $request, $id) {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'days' => 'required|array',
            'days.*' => 'in:senin,selasa,rabu,kamis,jumat,sabtu,minggu',
            'id_working_hour' => 'required|array',
            'id_working_hour.*' => 'required|exists:working_hours,id',
        ]);
    
        try {
            // Mulai transaksi database
            DB::beginTransaction();
    
            // Hapus entri StaffWorkingHour yang ada untuk user dan hari tertentu
            StaffWorkingHour::where('id_user', $id)->delete();
    
            // Iterasi melalui hari dan jam kerja yang dipilih
            foreach ($request->days as $index => $day) {
                $workingHourId = $request->id_working_hour[$index];
    
                // Buat entri baru atau update yang sudah ada
                $config = new StaffWorkingHour();
                $config->id_user = $request->id_user;
                $config->days = $day;
                $config->id_working_hour = $workingHourId;
                $config->save();
            }
    
            // Commit transaksi jika tidak ada masalah
            DB::commit();
    
            // Redirect atau response sukses
            return redirect()->route('staff.config')->with('success', 'Data konfigurasi berhasil diperbarui.');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();
    
            // Redirect atau response error
            return redirect()->route('staff.config', ['id' => $id])->with('error', 'Terjadi kesalahan saat memperbarui data konfigurasi.');
        }
    }
}

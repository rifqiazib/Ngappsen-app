<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Models\Staff;
use App\Models\User;
use App\Models\Department;




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
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\User;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    public function index() {
        $perPage = 10;
        $data['roles'] = Role::paginate($perPage);
        $data['users'] = User::paginate($perPage);
        return view('user.index', $data);
    }

    public function createRole() {
        return view('user.create-role');
    }

    public function storeRole(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // Create the role using Spatie's Role model
            $role = Role::create(['name' => $request->input('name')]);
            return redirect()->route('User')->with('success', 'Data Berhasil Disimpan');
        } catch (QueryException $e) {
            return redirect()->back()->with('errors', 'Database error: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->back()->with('errors', 'An error occurred: ' . $e->getMessage());
        }
    } 

    public function giveRole($id) {
        $data['user'] = User::find($id);
        $data['roles'] = Role::all();
        return view('user.give-role', $data);

    }

    public function storeGiveRole(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'role' => 'required'
        ]);
        
        if($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        try {
            $user = User::find($id);
            $role = $request->input('role');
            $user->assignRole($role);
            return redirect()->route('user')->with('success', 'Role Berhasil Diberikan');
        } catch (\Exception $e) {
            return redirect()->route('user')->with('errors', 'An error occurred: ' . $e->getMessage());
        }

    }
}

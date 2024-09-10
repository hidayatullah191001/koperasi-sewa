<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Helpers\MyHelper;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        $users = User::all();
        return view('pages.superadmin.user-management.index', [
            'roles' => $roles,
            'users' => $users,
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validation = Validator::make($request->all(), [
                'name' => 'required|string|',
                'email' => 'required|string|email|unique:users',
                'role_id' => 'required',
            ],[
                'role_id.required' => 'The role field is required.',
            ]);
    
            if ($validation->fails()) {
                $errors = $validation->errors();
                return redirect()->route('superadmin-user-management')
                    ->withErrors($errors)
                    ->withInput();
            }
    
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => 'password',
                'role_id' => $request->role_id,
                'is_active' => 'yes',
                'photo_profile' => 'default.png',
            ];
    
            User::create($data);
    
            return redirect()->route('superadmin-user-management')->with('success', 'Data user successfully created');
        } catch (Exception $e) {
            return redirect()->route('superadmin-user-management')->with('error', $e);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validation = Validator::make($request->all(), [
                'name' => 'required|string|',
                'email' =>  ['required', 'email', 'string', Rule::unique('users')->ignore($id)],
                'role_id' => 'required',
            ],[
                'role_id.required' => 'The role field is required.',
            ]);
    
            if ($validation->fails()) {
                $errors = $validation->errors();
                return redirect()->route('superadmin-user-management')
                    ->withErrors($errors)
                    ->withInput();
            }
    
            $user = User::findOrFail($id);
    
            if($request->is_active == true){
                $active = 'yes';
            }else{
                $active = 'no';
            }
    
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => 'password',
                'role_id' => $request->role_id,
                'is_active' => $active,
            ];
    
            $user->update($data);
    
            return redirect()->route('superadmin-user-management')->with('success', 'Data user successfully updated');
        } catch (Exception $e) {
            return redirect()->route('superadmin-user-management')->with('error', $e);
        }
    }

    public function destroy(Request $request, $id)
    {
        $user = User::findOrFail($id);
        Storage::delete([$user->photo_profile]);
        $user->delete();

        if($user->email == Auth::user()->email){
            session()->flush();
            return redirect()->route('login')->with('success', 'Your account successfully deleted');
        }else{
            return redirect()->route('superadmin-user-management')->with('success', 'Data user successfully deleted');
        }
    }
}

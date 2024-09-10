<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('pages.setting.profile', [
            'title' => 'Setting Profile',
            'user' => $user,
        ]);
    }

    public function changePassword(Request $request)
    {
        return view('pages.setting.password', [
            'title' => 'Setting Account Password',
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();

        $validasi = Validator::make($request->all(), [
            'name' => 'string|required',
        ]);

        if ($validasi->fails()) {
            return redirect()->route('setting-profile')->withErrors($validasi)->withInput();
        }

        $imagePath = 'default.png';
        if ($request->hasFile('image')) {
            if ($user->photo_profile != 'default.png') {
                Storage::delete('avatars', $user->image);
                $imagePath = $request->file('image')->store('avatars', 'public');
            }else{
                $imagePath = $request->file('image')->store('avatars', 'public');
            }
        }

        $update = [
            'name' => $request->input('name'),
            'photo_profile' => $imagePath,
        ];

        $user->update($update);

        return redirect()->route('setting-profile')->with('success', 'Profile successfully updated');
    }

    public function updatePassword(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'password' => ['required', 'string', 'min:8'],
            'confirm_password' => ['required', 'string', 'same:password'],
        ]);
        if ($validasi->fails()) {
            return redirect()->route('setting-password')->withErrors($validasi)->withInput();
        }
        $user = User::find(Auth::user()->id);
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'Password updated successfully.');
    }
}

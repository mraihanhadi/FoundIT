<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        if ($user->role === 'admin') {
            return view('admin.profileAdmin', compact('user'));
        }
        return view('user.profileUser', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        if ($user->role === 'admin') {
            return view('admin.editprofileAdmin', compact('user'));
        }
        return view('user.editprofileuser', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email'    => 'required|email|max:255|unique:users,email,' . $user->id,
            'no_telp'  => 'nullable|string|max:20',
            'foto'     => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->no_telp = $request->no_telp;

        if ($request->filled('password')) {
            $user->password = \Illuminate\Support\Facades\Hash::make($request->password);
        }

        if ($request->hasFile('foto')) {
            if ($user->foto && Storage::disk('public')->exists($user->foto)) {
                Storage::disk('public')->delete($user->foto);
            }
            $user->foto = $request->file('foto')->store('profiles', 'public');
        }

        $user->save();

        if ($user->role === 'admin') {
            return redirect()->route('admin.profil')->with('success', 'Profil berhasil diperbarui!');
        }

        return redirect()->route('user.profil')->with('success', 'Profil berhasil diperbarui!');
    }
}
